<?php
    if ($_POST){ 
		# Establish connection to MySQL 
		$db = mysqli_connect('localhost', 'webuser', '') or DIE(mysql_error());
			
		# Establish connection to database lab2 
		$db->select_db('minilab') or DIE("Unable to select database" . mysql_error());
		
		# Start query 
		$query= "select s.sid, sname, c.cid, fid, grade
					 from student s, course c, enroll e
						where s.sid = e.sid
						  and c.cid = e.cid";
		
		# Continue query with user entered data if necessary
		if (($_POST['sid'] != "") && ($_POST['sid'] != " ")){
			# cid criteria selected 
			$query = $query . " and s.sid = '{$_POST['sid']}'";
		}
		$query = $query . ";";
	
		$result = $db->query($query) or DIE("Unable to read data" . mysql_error());
		
		# Display results to screen
		echo("<h2> Student Information </h2> <br/>");
		while($row = $result->fetch_assoc()){
			echo ("<li>");
			echo ($row['sid'] . " ");
			echo ($row['sname'] . " ");
			echo ($row['cid'] . " ");
			echo ($row['fid'] . " ");
			echo ($row['grade'] . " ");
			echo ("</li>");
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
    <link href="mini.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="verticalmenu.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript"></script>     
</head>

<body>
	<div id="wrapper">
        <div id="header">
            This is in the header area
        </div>
        <div id="navbar">
            <ul id="menu">
               <li><a href="mini.html">Home</a></li>
               <li><a href="contact.html">Contact Us</a></li>
               <li><a href="search.html">Search</a></li>
            </ul>
       </div>
        <div id="sidebar">
			<ul>
              <li><a href="searchS.php">By Student</a></li>
              <li><a href="searchC.php">By Course</a></li>
              <li><a href="searchF.php">By Faculty</a></li>
            </ul> 
        </div>
        <div id="content">
            <form method="POST" action="" onsubmit="return validate(this);" id="studentsearch">
                     <div>
                        <label for="sid" class="boldtxt">Student ID:</label>
                        <input type="text" size="50" name="sid" id="sid" value=""/>
                    </div>
            
                    <div>
                        <label for="results" class="boldtxt">Results:</label>
                        <textarea rows="5" cols="50" name="results" id="results"></textarea>
                    </div>
                    <input class="center" type="submit" name="submit" id="submit" value="Submit"  />
	           </form>
        </div>
        <div id="footer">
            This is in the footer area
        </div>
        
	</div>
</body>
</html>