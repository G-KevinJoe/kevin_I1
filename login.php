<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
     
        if (password_verify($password, $user['password'])) {
            
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['course_name'] = $user['course_name'];

            header('Location: home.php');
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }


    $stmt->close();
    $conn->close();
}
?>


<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Student Course Management System</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
        
        </header>
        <main>
            <div class="container">
                <h1 class="text-center my-4">Student Course Management System</h1>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h2>Login</h2>
                            </div>
                            <div class="card-body">
                                <form action="login.php" method="POST">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                    <button type="button" class="btn btn-primary w-100 mt-2" onclick="window.location.href='register.php'">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
