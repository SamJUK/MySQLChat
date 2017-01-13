<div id="error">
    <h1>You are already logged in!</h1>
    <h2>Current User: <strong> <?php echo $_SESSION['username'] ?> </strong> </h2>
    <span>Please logout if you want to log in as a different user</span>
    <a href="?logout" class="button">Logout</a>
    <a href="index.php" class="button">Go Home</a>
</div>