<?php
//US timezone
date_default_timezone_set('america/los_angeles');

//get next and prev
if (isset($_GET['ym'])){
    $ym = $_GET['ym'];
}
else{
    // this month
    $ym = date('Y-m');
}

//format check
$timestamp = strtotime($ym . '-01');
if($timestamp === false){
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

//today
$today = date('Y-m-j', time());

//h3 title
$html_title = date('F Y', $timestamp);

//create next and prev month
$prev = date('Y-m', mktime(0, 0 , 0, date('m', $timestamp)-1,1,date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0 , 0, date('m', $timestamp)+1,1,date('Y', $timestamp)));

//number of days in the month
$day_count = date('t', $timestamp);

//0:sun 1: mon 2:tue etc

$str = date('w', mktime(0, 0 , 0, date('m', $timestamp),1,date('Y', $timestamp)));


//create calendar
$weeks = array();
$week = '';

$week .= str_repeat('<td></td>', $str);

for ($day = 1; $day <= $day_count; $day++, $str++) {
    $date = $ym. '-' . $day;
    
    if($today == $date){
        $week .= '<td class="today">'. $day;
    }else{
        $week .= '<td>' . $day;
    }
    
    //end of the week or end of the month
    if($str % 7 == 6 || $day == $day_count){
        if ($day == $day_count){
            //add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
    $weeks[] = '<tr>' . $week . '</tr>';
        
    //prepare for the new week
    $week = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" type="text/css" href="index-style.css">

    <title>Ivan’s Homepage</title>
</head>

<body>
    <div id="intro-container">
        <h1 id="myname">Ivan Lopez</h1>
        <img src="mymug.png" alt="My picture" width="300" height="300">
        <p>Hello, my name is Ivan Lopez. I am a recent graduate at <span class="important"> University of the Pacific</span>. I served for 11 years in the <span class="important"> Marine Corps</span> before transitioning to academia. I have a beautiful wife and daughter whom I love dearly.</p>
        <p>My major is Computer Science and my concentration is Software Engineering/Development. I am aspiring to be a Full Stacks Developer (FSD). </p>
    </div>
    <div id="center">

        <div class="list-container">
            <h3 class="form-headers">List of Courses</h3>
            <ol>
                <?php
            $myfile = fopen("courses.txt", "r") or die("Unable to open file!");
            while(!feof($myfile)){
                echo "<li>" . fgets($myfile) . "</li>";
            }
                
            fclose($myfile);
            ?>
            </ol>
        </div>
        <div class="list-container">
            <h4 class="form-headers">Projects and Research done</h4>
            <ul>
                <li>Lipase Food Journal, my senior project. This application helps pancreatitis patients track their food consumption and based on a few selections it gives them a recommendation as to how much insulin and lipase pills to take.</li>
                <li>Bike LEAD application for the Stockton Police Department, built in my internship. This app helps track vagrants that are stopped by the police officers and if they have committed any infractions. </li>
                <li>Traffic survey application for the Stockton Police Department, built in my internship. This application helps track demographic information about arrests conducted.</li>
                <li>Boozy Frog, from COMP 55. This is a very similar game to Frogger, but with a fun twist. “Boozy” collects bottles of liquor and coins.</li>
                <li>Spaced Out, from COMP 129. This application is a teaching app that helps users learn the Computer Science topic of recursion.</li>
                <li>Nailed It!, from COMP 129. This is an application that helps recent grads and job seekers in the field of Computer Science to prepare for coding interviews.</li>
            </ul>
        </div>
    </div>

    <div id=interest-container>
        <h5 class="styled-header">Interests and Hobbies</h5>
        <p>My interest include playing video games, shooting guns, doing thrill rides like bungee jumping and sky diving. I like to work out when I can, not so much lately when I was in college. I also like to spend a lot of time with my wife and daughter. I like to take them to travel and vacation in new places.</p>
        <h3 class="styled-header">Something Interesting</h3>
        <p>I went on a combat deployment in 2006-2007 to Ramadi, Iraq. </p>

    </div>
    <!--Lab 4 stuff-->
    <div class="calendar">
        <h3 class="form-headers"><a href="?ym=<?php echo $prev; ?>">&#x2190;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&#x2192;</a></h3>
        <br>
        <table>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            <?php 
                    foreach ($weeks as $week){
                        echo $week;
                    }
                ?>

        </table>
    </div>
    <div class="files-container">
        <h3 class="form-headers">Files in this directory</h3>
        <ul>
            <?php
            $handler = opendir("./");
            while($filename = readdir($handler)){
                echo "<li>" . $filename . "</li>";
            }
            ?>
        </ul>
    </div>
    <!--Lab 5: Forms-->
    <div class="form-container">
        <h3 class="form-headers">Short Survey</h3>
        <form action="action.php" method="post">
            <table class="form">
                <tr>
                    <td><label>Visitor, what is your name?</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="name"></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td><label>Did you enjoy my site?</label></td>
                </tr>
                <tr>
                    <td><select name="yn">
                            <option hidden value="">Choose</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td><label>How would you rate this site?</label></td>
                </tr>
                <tr>
                    <td>
                        <select name="rating" required>
                            <option hidden value="">Choose</option>
                            <?php 
                    $questionfile = fopen("questions.txt", "r") or die("Unable to open file!");
                    while(!feof($questionfile)):; $line = fgets($questionfile);?>
                            <option value="<?php echo $line;?>"><?php echo $line;?></option>
                            <?php
                    endwhile;
                    fclose($questionfile);
                    ?>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <label>Would you like to provide additional feedback?</label>
            <textarea name="additional" placeholder="Type feedback here.."></textarea>
            <br>
            <br>
            <input id="button" type="submit" value="Click to submit form">
        </form>
    </div>

</body>

</html>
