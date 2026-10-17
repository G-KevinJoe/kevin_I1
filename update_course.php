<?php
include 'db.php';

// the 
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $course_name = $_POST["course_name"];
    $description = $_POST["description"];
    $duration = $_POST["duration"];
    $image = $_POST["image"];
    $user_id = $_POST["id"];

    $sql = $conn->prepare("UPDATE courses SET course_name=?, description=?, duration=?, image=? WHERE id=?");
    $sql->bind_param("ssisi", $course_name, $description, $duration, $image, $id);

    if ($sql->execute()) {
        header("Location: home.php");
        exit();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM courses WHERE id=$id");
    $row = $result->fetch_assoc();
} else {
    header("Location: home.php");
    exit();
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Update Course</title>
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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Hello <?php echo htmlspecialchars($_SESSION['name']); ?></a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="insert_course.php">Insert Course</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container my-5">
                <h1 class="mb-4">Update Course</h1>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" />
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo htmlspecialchars($row['course_name']); ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($row['description']); ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="<?php echo htmlspecialchars($row['duration']); ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($row['image']); ?>" />
                    </div>
                    <button type="submit" class="btn btn-primary">Update Course</button>
                </form>
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
