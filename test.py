import sys
import mysql.connector
import requests
import json
import pytz
import locale
from datetime import datetime


mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="ecommerce"
)

mycursor = mydb.cursor()

mycursor.execute("SELECT * FROM cart WHERE `userlogin_userid`="+sys.argv[1])

myresult = mycursor.fetchall()


# # 1000.161e1181695dd516bbe90017dd1efbc6.71d323b6a977dac9d7f3f02fee50e851

class InvoiceGenerator:
    """ API Object for Invoice-Generator tool - https://invoice-generator.com/ """

    URL = "https://invoice-generator.com"
    DATE_FORMAT = "%d %b %Y"
    LOCALE = "fr_FR"
    TIMEZONE = "Europe/Paris"
    # Below are the default template parameters that can be changed (see https://github.com/Invoiced/invoice-generator-api/)
    TEMPLATE_PARAMETERS = [
        "header",
        "to_title",
        "ship_to_title",
        "invoice_number_title",
        "date_title",
        "payment_terms_title",
        "due_date_title",
        "purchase_order_title",
        "quantity_header",
        "item_header",
        "unit_cost_header",
        "amount_header",
        "subtotal_title",
        "discounts_title",
        "tax_title",
        "shipping_title",
        "total_title",
        "amount_paid_title",
        "balance_title",
        "terms_title",
        "notes_title",
    ]

    def __init__(self, to,
                sender="Deep Chhatralia",
                currency="INR",
                discounts=0,
                logo=None,
                ship_to=None,
                number=None,
                payments_terms=None,
                due_date=None,
                notes=None,
                terms=None,
                date=datetime.now(tz=pytz.timezone(TIMEZONE)),
                tax=None,
                shipping=0,
                amount_paid=0,
                ):
        """ Object constructor """
        self.logo = "GDRS"
        self.sender = sender
        self.to = to
        self.ship_to = ship_to
        self.number = number
        self.currency = currency
        self.custom_fields = []
        self.date = date
        self.payment_terms = payments_terms
        self.due_date = due_date
        self.items = []
        self.fields = {"tax": "%", "discounts": False, "shipping": False}
        self.discounts = discounts
        self.tax = tax
        self.shipping = shipping
        self.amount_paid = amount_paid
        self.notes = notes
        self.terms = terms
        self.template = {}

    def _to_json(self):
        """
        Parsing the object as JSON string
        Please note we need also to replace the key sender to from, as per expected in the API but incompatible with from keyword inherent to Python
        We are formatting here the correct dates
        We are also resetting the two list of Objects items and custom_fields so that it can be JSON serializable
        Finally, we are handling template customization with its dict
        """
        locale.setlocale(locale.LC_ALL, InvoiceGenerator.LOCALE)
        object_dict = self.__dict__
        object_dict['from'] = object_dict.get('sender')
        object_dict['date'] = self.date.strftime(InvoiceGenerator.DATE_FORMAT)
        if object_dict['due_date'] is not None:
            object_dict['due_date'] = self.due_date.strftime(InvoiceGenerator.DATE_FORMAT)
        object_dict.pop('sender')
        for index, item in enumerate(object_dict['items']):
            object_dict['items'][index] = item.__dict__
        for index, custom_field in enumerate(object_dict['custom_fields']):
            object_dict['custom_fields'][index] = custom_field.__dict__
        for template_parameter, value in self.template.items():
            object_dict[template_parameter] = value
        object_dict.pop('template')
        return json.dumps(object_dict)

    def add_custom_field(self, name=None, value=None):
        """ Add a custom field to the invoice """
        self.custom_fields.append(CustomField(
            name=name,
            value=value
        ))

    def add_item(self, name=None, quantity=0, unit_cost=0.0, description=None):
        """ Add item to the invoice """
        self.items.append(Item(
            name=name,
            quantity=quantity,
            unit_cost=unit_cost,
            description=description
        ))

    def download(self, file_path):
        """ Directly send the request and store the file on path """
        json_string = self._to_json()
        response = requests.post(InvoiceGenerator.URL, json=json.loads(json_string), stream=True, headers={'Accept-Language': 'en-US'})
        # print(response.content)
        if response.status_code == 200:
            if(open(file_path, 'wb').write(response.content)):
                return True
            return False
        else:
            # raise Exception(f"Invoice download request returned the following message:{response.json()} Response code = {response.status_code} ")
            print("Invoice download request returned the following message : {0}".format(response.json()))


    def set_template_text(self, template_parameter, value):
        """ If you want to change a default value for customising your invoice template, call this method """
        if template_parameter in InvoiceGenerator.TEMPLATE_PARAMETERS:
            self.template[template_parameter] = value
        else:
            raise ValueError("The parameter {} is not a valid template parameter. See docs.".format(template_parameter))

    def toggle_subtotal(self, tax="%", discounts=False, shipping=False):
        """ Toggle lines of subtotal """
        self.fields = {
            "tax": tax,
            "discounts": discounts,
            "shipping": shipping
        }


class Item:
    """ Item object for an invoice """

    def __init__(self, name, quantity, unit_cost, description=""):
        """ Object constructor """
        self.name = name
        self.quantity = quantity
        self.unit_cost = unit_cost
        self.description = description


class CustomField:
    """ Custom Field object for an invoice """

    def __init__(self, name, value):
        """ Object constructor """
        self.name = name
        self.value = value

ig=InvoiceGenerator(to="Janvi Vijay",ship_to="Bank colony")

mycursor.execute("SELECT * FROM userlogin WHERE userid={0}".format(sys.argv[1]))
myresult3=mycursor.fetchone()
userName = myresult3[4]+" "+myresult3[5]

mycursor.execute("SELECT * FROM area JOIN city ON area.city_idcity=city.idcity JOIN state ON city.state_idstate=state.idstate WHERE area.idarea={0}".format(myresult3[13]))
myresult4=mycursor.fetchone()
address =myresult4[1]+" "+myresult4[4]+" "+myresult4[7]

ig.to=userName
ig.ship_to=address

for x in myresult:
    cartQty = x[0]
    productId = x[2]
    
    mycursor.execute("SELECT * FROM productt WHERE `product_id`={0}".format(productId))
    myresult2 = mycursor.fetchone()

    
    productName = myresult2[1]
    productPrice = myresult2[4]


    ig.add_item(name=productName,quantity=cartQty,unit_cost=productPrice)


ig.toggle_subtotal("2")

# from pathlib import Path
# downloads_path = str(Path.home() / "Downloads")

if(ig.download(r"C:\xampp\htdocs\ecomm\testing.pdf")):
    print("downloaded")
else:
    print("try again")