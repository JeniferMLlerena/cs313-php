<?

require('dbConnect.php');
$db = get_db();

$course_id = htmlspecialchars($_GET['id']);
$query = 'SELECT c.code, c.name, n.id AS note_id, n.content
          FROM note n
          JOIN course c ON n.course_id = c.id
          WHERE c.id = :course_id';

$stmt = $db->prepare($query);
$stms->bindValue(':course_id', $course_id, PDO::PARAM_INT);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);

$course_name = $notes[0]['name'];
$course_code = $notes[0]['code'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Notes</title>
  </head>
  <body>
    <h1>Noters for: <?php echo "$course_code = $course_name" ?></h1>
  </body>
</html>
