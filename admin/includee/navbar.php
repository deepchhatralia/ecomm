<link rel="stylesheet" href="../../css/style.css">

<style>
    * {
        font-family: sans-serif;
    }

    #navbar .hamburger {
        color: #fff;
        font-size: 1.2rem;
    }
</style>

<body>
    <nav class="navbar navbar-dark bg-gray-800" id="navbar">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand">GDRS</a>
            <a class="btn hamburger" data-bs-toggle="offcanvas" href="#sidebar">☰</a>
            <!-- <a href="" class="navbar-brand admin-logout-btn">Logout</a> -->
        </div>
    </nav>

    <script src="../../jquery.js"></script>

    <script>
        $(document).ready(() => {
            $('.admin-logout-btn').click((e) => {
                e.preventDefault();
                if (confirm("Logout ???")) {
                    window.location.href = 'http://localhost/ecomm/admin/logout.php';
                }
            });
        });
    </script>
</body>