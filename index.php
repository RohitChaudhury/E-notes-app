<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Data tables libraries -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script> -->






    <title>e-notes||smart solution for your everyday notes</title>
    <style>
        .navbar-nav>li {
            padding-left: 45px;
            padding-right: 45px;
            position: sticky;
        }

        .container-fluid {
            position: sticky;
            z-index: 2;
        }

        .form_control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            margin-right: 307px;
            position: relative;
            left: 300px;

        }

        @media (min-width: 1200px) {
            .container {
                max-width: 550px;
                position: relative;
                right: 8px;
                top: 81px;
            }
        }

        h2 {

            position: relative;
            bottom: 40px;
        }

        body {
            background-image: url(https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80);
            background-size: cover;
            background-repeat: no-repeat;
        }

        #myTable {
            background-color: white;
            align-content: center;
            width: 60vw;
            position: relative;
            left: 22vw;
            top: 18vh;

        }

        footer {
            display: flex;
            width: 100vw;
            justify-content: center;
            position: relative;
            top: 33vh;
            background-color: #343a40;
            height: 20vh;
            color: #fff;
            align-items: center;

        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark badge-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-note</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Support</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form_control" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <!-- Success alert -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        echo ('<div class="alert alert-success" role="alert">
      Success!!Your Note: ' . $title . ' has been created in the page-list successfully.
  </div>');
    }
    ?>




    <div class="container">
        <h2>Add a Note</h2>
        <form action="index.php" method='post'>
            <div class=" form-group">
                <label for="exampleInputEmail1">Note Title
                </label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name='title' placeholder="Eg. Title....">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small> -->
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Add description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='desc'></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <!-- table structure -->
    <table class="table" id="myTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sl.no</th>
                <th scope="col">Note Title</th>
                <th scope="col">Description
                </th>
                <th scope="col">Date-Time Created
                </th>
                <th scope="col"> Actions</th>
            </tr>
        </thead>


        <!--Php programme to fetch data from the database -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $title = $_POST['title'];
            $desc = $_POST['desc'];

            $server = "localhost";
            $user = "root";
            $pass = "root";
            $db_name = "E-notes";

            $conn = mysqli_connect($server, $user, $pass, $db_name);
            if (!$conn) {
                echo ("Sorry! Failed to connect with the server<br>");
            }
            $sql_insert = "INSERT INTO `_notes` ( `Title`, `description`, `t_stamp`) VALUES ('$title', '$desc', CURRENT_TIMESTAMP);";
            $insert_data = mysqli_query($conn, $sql_insert);


            $sql = ("SELECT * FROM `_notes`");
            $table = mysqli_query($conn, $sql);
            //Fetching data:
            $rows = mysqli_num_rows($table);
            $i = 1;
            $sl_no = 1;
            while ($i <= $rows) {
                $records = mysqli_fetch_assoc($table);
                echo "<tr>";
                echo '<td>' . $sl_no . "</td>";
                echo '<td>' . $records['Title'] . "</td>";
                echo '<td>' . $records['description'] . "</td>";
                echo '<td>' . $records['t_stamp'] . "</td>";
                echo '<td>' . "<a href= '/edit'>Edit</a>   <a href= '/del'>&nbsp&nbsp&nbsp&nbspDelete</a>" . "</td>";
                echo "</tr>";
                $i++;
                $sl_no++;

            }



        } else { //connecting with the database:
            $server = "localhost";
            $user = "root";
            $pass = "root";
            $db_name = "E-notes";

            $conn = mysqli_connect($server, $user, $pass, $db_name);
            if (!$conn) {
                echo ("Sorry! Failed to connect with the server<br>");
            }
            $sql = ("SELECT * FROM `_notes`");
            $table = mysqli_query($conn, $sql);


            //Fetching data:
            $rows = mysqli_num_rows($table);
            $i = 1;
            $sl_no = 1;
            while ($i <= $rows) {
                $records = mysqli_fetch_assoc($table);
                echo "<tr>";
                echo '<td>' . $sl_no . "</td>";
                echo '<td>' . $records['Title'] . "</td>";
                echo '<td>' . $records['description'] . "</td>";
                echo '<td>' . $records['t_stamp'] . "</td>";
                echo '<td>' . "<a href= '/edit'>Edit</a><a href= '/del'>&nbsp&nbsp&nbsp&nbspDelete</a>" . "</td>";
                echo "</tr>";
                $i++;
                $sl_no++;
            }
        }

        ?>
    </table>













    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <!-- <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script> -->


</body>
<footer>
    Copyright&copy Project of Rohit chaudhury
</footer>

</html>