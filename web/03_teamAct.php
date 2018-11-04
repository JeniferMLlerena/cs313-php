<?
// Associative array containing all majors.
  $major;
	$majors = array(
      "CS"  => "Computer Science",
      "WDD" => "Web Design and Development",
      "CIT" => "Computer Information Technology",
      "CE"  => "Computer Engineering");
// Iterate through majors and store display name
  $displayMajor = $majors[$major];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Team Activity - 03</title>
</head>

<body>
  <h2>Welcome to this wonderful form!</h2>

  <form method="POST" action="03_form.php">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br/>

    <label for="email">Email: </label>
    <input type="text" id="email" name="email"><br/>

    <!--<h3>Major</h3>
    <label for="ComputerScience">Computer Science</label>
    <input type="radio" id="ComputerScience" name="major" value="Computer Science"><br/>

    <label for="Web Design">Web Design and Development</label>
    <input type="radio" id="Web Design" name="major" value="Web Design"><br/>

    <label for="CIT">CIT</label>
    <input type="radio" id="CIT" name="major" value="CIT"><br/>

    <label for="Computer Engineering">Computer Engineering</label>
    <input type="radio" id="Computer Engineering" name="major" value="Computer Engineering"><br/>-->
    <label for="Major">Major: </label><br/>
    <?php // Build list of majors - radio buttons ?>
    <?php foreach ($majors as $code => $name): ?>
      <div class="radio">
        <input  type="radio"
                name="Major"
                id="<?php echo $code; ?>"
                value="<?php echo $code; ?>" required
                <?php if(isset($major) && $code == $major) { echo ' checked'; } ?>>
        <label class="control-label" for="<?php echo $code; ?>"><?php echo $name ?></label>
      </div>
    <?php endforeach ?><br/>

    <label for="comments">Comments:</label><br/>
    <textarea type="text" id="comments" name="comments" rows="4" cols="50"></textarea><br/>

    <input type="submit">
  </form>
</body>
</html>
