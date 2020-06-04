<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" type="text/css" href="index-style.css">

    <title>Action Form</title>
</head>

<body>
    <div>
        <h2 class="styled-header">Hello, <?php echo $_POST["name"] . "!";?> Thanks for filling out the form! </h2>
    </div>
    <div>
        <?php 
        if ($_POST["yn"] == ""){
            echo "<p>It looks like you did not answer Yes or No on the question, 'Did you enjoy my site?'</p>";
        }
        if ($_POST["yn"] == "Yes"){
            echo "<p>I am so glad you enjoyed my website!</p>";
        }
        if ($_POST["yn"] == "No"){
            echo "<p>I am sorry you did not enojoy my site. I hope to improve my web development skills with this class!</p>";
        }
        ?>
    </div>
    <div>
        <h2>You have rated this site as:</h2>
        <?php 
        echo $_POST["rating"] . "<br> <p>Thank you for the feedback!</p>";
        ?>
    </div>
    
    <div>
        <?php
            if ($_POST["additional"]!=""){
                echo "<h2>Additional feedback provided:</h2>";
                echo $_POST["additional"];
            }
        ?>
    </div>
    <div>
        <button id="button" onclick="window.location.href='index.php'">Return to site</button>
    </div>

</body>

</html>
