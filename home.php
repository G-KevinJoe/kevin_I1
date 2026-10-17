<?php
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_name = $_POST["course_name"];
    $description = $_POST["description"];
    $duration = $_POST["duration"];
    $image = $_POST["image"];
    $user_id = $_POST["user_id"];
    $sql = $conn->prepare("insert into courses(course_name, description, duration, user_id) values (?,?,?,?,?)");
    $sql->bind_param("ssss", $course_name, $description, $duration, $user_id);
    if ($sql->execute()) {
        header("Location: home.php");
        exit();
    }
}
$result = $conn->query("select * from courses");
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Home</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
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
                                <a class="nav-link" href="pdf_download.php">PDF Download</a>
                            </li>
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
                <h1 class="mb-4">Show Course</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Description</th>
                            <th>Duration</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($row['duration']); ?></td>
                                <td><?php echo htmlspecialchars($row['image']); ?></td>
                                <td>
                                    <?php if (!empty($row['image'])): ?>
                                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Course Image" style="max-width: 100px; max-height: 100px;" />
                                    <?php else: ?>
                                        <img src="path/to/placeholder-image.jpg" alt="Course Image" style="max-width: 100px; max-height: 1000px;" />
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="update_course.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a>
                                    <a href="delete_course.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
        </main>
        <footer>
        </footer>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
