<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test_CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Test_CRUD</h1>

        <!-- Form -->
        <form id="userForm">
            <!-- Email -->
            <div class="mb-2">
                <label for="inputEmail" class="form-label">Alamat email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="inputPassword" class="form-label">Kata sandi</label>
                <input type="password" class="form-control" id="inputPassword" name="password" required>
            </div>

            <!-- Submit Button -->
            <div class="d-flex flex-column justify-content-center">
                <button type="button" id="submitBtn" class="btn btn-primary">Masuk</button>
            </div>
        </form>

        <!-- User List -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="userTable">
            <!-- Rows will be populated dynamically -->
        </tbody>
    </table>

        <!-- Response Message -->
        <div id="responseMessage" class="mt-4"></div>
    </div>

    <!-- JavaScript -->
    <script>
        $(document).ready(function () {
            // Fetch users and populate the table (simplified example)
            function fetchUsers() {
                $.ajax({
                    url: "fetch.php", // Backend script to fetch users
                    type: "GET",
                    success: function (response) {
                        $("#userTable").html(response); // Populate the table
                    },
                    error: function () {
                        alert("Failed to fetch users.");
                    }
                });
            }

            fetchUsers(); // Load users when the page loads

            // Handle form submission for creating a user
        $("#createUserForm").submit(function (event) {
            event.preventDefault(); // Prevent default form submission behavior

            const email = $("#emailInput").val(); // Get email input value
            const password = $("#passwordInput").val(); // Get password input value

            $.ajax({
                url: "handler.php", // Backend script to handle form submission
                type: "POST",
                data: {
                    email: email,
                    password: password
                },
                success: function (response) {
                    alert(response); // Display response message
                    $("#createUserForm")[0].reset(); // Reset the form
                    fetchUsers(); // Refresh the user list
                },
                error: function () {
                    alert("Failed to create user.");
                }
            });
        });

            // Handle Delete button click
            $(document).on("click", ".deleteBtn", function () {
                const userEmail = $(this).data("email"); // Get the user ID from the button

                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: "delete.php",
                        type: "POST",
                        data: { action: "delete", email: userEmail },
                        success: function (response) {
                            alert(response); // Display response message
                            fetchUsers(); // Refresh the user list
                        },
                        error: function () {
                            alert("Failed to delete the user.");
                        }
                    });
                }
            });
        });
        
    </script>
</body>

</html>