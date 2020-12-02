<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        html,
        body {
            height: -webkit-fill-available;
        }

        body {
            display: flex;
            flex-flow: column wrap;
            margin: auto;
            background-color: #e4e4e4;
        }

        .alert {
            box-shadow: 0 0 5px black;
            position: absolute;
            bottom: 0;
            left: 10px;
            right: 10px;
            text-align: center;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-flow: column;
            width: 15%;
            margin: auto;
            place-content: center;
            box-shadow: 0 0 5px black;
            border: 2px solid;
            padding: 20px;
            background-color: white;
        }

        label {
            margin: 0;
        }

        input {
            margin: 0 10px 10px 10px;
        }

        input[type="submit"] {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <form action="./submitUser.php" method="post" autocomplete="false">
        <label for="user">Username:</label>
        <input type="text" required name="user">
        <label for="pass">Password:</label>
        <input type="password" required name="pass">
        <input type="submit" value="Submit" name="submit">
    </form>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success')
            echo "<div class='alert alert-success'<strong>S'ha insertat correctament</strong></div>";
        else if ($_GET['status'] == 'error')
            echo "<div class='alert alert-danger'><strong>No s'ha introduit correctament</strong></div>";
        echo "<script>setTimeout(() => {document.getElementsByClassName('alert')[0].style.display = 'none'}, 4000);</script>";
    }
    ?>
</body>

</html>