<?php
include_once '../config.php';
// if(empty($_SESSION['uid'])){
//  header('location:'.SITEURL);
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher-Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>tailwebs</h1>
        <nav>
            <a href="">Home</a>
            <a href="<?= SITEURL . 'logout' ?>">Logout</a>
        </nav>
    </header>
    <div class="container">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Mark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <style>
                        tr td input {
                            border: none;
                            padding: 8px;
                            border-color: white !important;
                        }

                        tr td input:read-only {
                            background-color: #f5f5f5;
                            border: 1px solid #ccc;
                            color: #666;
                        }
                    </style>
                    <?php
                    global $User;
                    $result = $User->fetch();
                    if ($result) {
                        foreach ($result as $key => $row) {
                            ?>

                            <tr>
                                <td><span class="initial-circle">
                                        <?php echo ucfirst(substr($row['name'], -1)); ?>
                                    </span><input readonly type="text" value="<?= $row['name'] ?>" id="name<?= $row['id'] ?>" name="sname"
                                        onkeyup="update(this,<?= $row['id'] ?>)">
                                </td>
                                <td><input type="text" readonly value="<?= $row['subject'] ?>" id="subject<?= $row['id'] ?>" name="ssubject"
                                        onkeyup="update(this,<?= $row['id'] ?>)"></td>
                                <td><input type="text" readonly value="<?= $row['marks'] ?>" id="marks<?= $row['id'] ?>" name="smarks"
                                        onkeyup="update(this,<?= $row['id'] ?>)"></td>
                                <td>
                                    <div class="action-button" onclick="toggleDropdown(this)"><i
                                            class="fa-solid fa-caret-down"></i></div>
                                    <div class="dropdown-content">
                                        <a href="#" onclick="edit(<?= $row['id'] ?>)">Edit</a>
                                        <a href="#" onclick="deletestu(<?= $row['id'] ?>)">Delete</a>
                                    </div>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button class="add-button" onclick="openModal()">Add</button>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="addstudent">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject">
                </div>
                <div class="form-group">
                    <label for="mark">Mark</label>
                    <input type="number" id="marks" name="marks">
                </div>
                <button type="submit" class="add-button">Add</button>
            </form>

        </div>
    </div>
    <script src="../assets/js/script.js"></script>
    <script>

        // function borderNone(element) {
        //     alert(element);
        //     var elm = document.getElementById(element);
        //     elm.style.border = 'none';
        // }

        function toggleDropdown(element) {
            var dropdownContent = element.nextElementSibling;
            var allDropdowns = document.querySelectorAll('.dropdown-content');
            allDropdowns.forEach(function (dropdown) {
                if (dropdown !== dropdownContent) {
                    dropdown.style.display = 'none';
                }
            });
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        }

        function openModal() {
            document.getElementById('myModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        window.onclick = function (event) {
            var modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }


    </script>
</body>

</html>