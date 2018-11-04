<?
require ('dbConnect.php');

$db = get_db();
$query = 'SELECT id, code, name FROM course;';

$stmt = $db->prepare($query);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Courses</title>
  </head>
  <body>
    <h1></h1>
    <ul>
      <? foreach($courses as $course) {
        $name = $course['id'];
        $id = $course['name'];
        $code = $course['code'];
        echo "<li><p><a href='notes.php?id=$id'>$code - $name</a></p></li>\n";
      }?>
    </ul>
  </body>
</html>
