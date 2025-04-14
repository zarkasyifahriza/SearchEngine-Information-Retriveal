<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#search").click(function(){
                var cari = $("#cari").val();
                var rank = $("#rank").val();
                
                $.ajax({
                    url: '/search?q=' + encodeURIComponent(cari) + '&rank=' + encodeURIComponent(rank),
                    dataType: "json"
                })
                .done(function(data) {
                    $('#content').html(data.join('')); // Menggabungkan array menjadi string HTML
                })
                .fail(function() {
                    alert("Please insert your command");
                });
            });
        });
    </script>
    <style>
        html, body {
            height: 100%; /* Ensure the body takes up the full height of the viewport */
        }

        body {
            display: flex;
            flex-direction: column; /* Arrange the content vertically */
            min-height: 100%; /* Make sure body takes up the full height */
        }

        main {
            flex: 1; /* This will make sure the main content expands to take available space */
        }

        footer {
            margin-top: auto; /* Push the footer to the bottom */
        }
    </style>
</head>
<body>
    <main>
        <div class="container my-5">
            <div class="search-container">
                <h1 class="display-4">Book Search</h1>
                <div class="creator-info mb-4">
                    Dibuat oleh <strong>ZARKASYI FAHRIZA</strong> (NIM: <strong>220411100001</strong>)
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="search-box">
                                <form action="#" method="GET" onsubmit="return false">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search the Book" name="q" id="cari">
                                        <select class="form-select" name="rank" id="rank">
                                            <option value="6">6</option>
                                            <option value="12">12</option>
                                            <option value="24">24</option>
                                        </select>
                                        <button class="btn btn-primary" id="search">
                                            <i class="fas fa-search"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container my-5">
        <div class="row" id="content">
            <!-- Kartu akan di-generate di sini -->
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3 bg-dark text-white">
            © 2025 Book Search. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
