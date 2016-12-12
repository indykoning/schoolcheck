<?php
require_once "includes/database.php";


if(!empty($_POST['delete'])) {
    $delete = $_POST['delete'];
    $deleteSelected = implode(",",$delete);
    $sql = "DELETE FROM schools WHERE id IN ($deleteSelected)";
    $result = $mysqli->query($sql);

    $sql = "DELETE FROM schools_concepts WHERE schools_id IN ($deleteSelected)";
    $result = $mysqli->query($sql);

    $sql = "DELETE FROM schools_levels WHERE schools_id IN ($deleteSelected)";
    $result = $mysqli->query($sql);

    $sql = "DELETE FROM schools_specials WHERE schools_id IN ($deleteSelected)";
    $result = $mysqli->query($sql);
    var_dump(mysqli_error($mysqli));

}
echo "<a href='newSchool'>Add new school</a>";
//Scholen kiezen die je wilt editen
$sql = "SELECT id,schoolname,adress,website FROM schools";
$result = $mysqli->query($sql);
if(empty($_POST['edit'])) {
    echo "<form method='post'>";
    echo "<table>";
    echo "<td width='300px' style='border: 1px solid black; background-color: #d7d7d7'>Schoolname</td>
<td width='200px' style='border: 1px solid black; background-color: #d7d7d7'>Adress</td>
<td width='200px' style='border: 1px solid black; background-color: #d7d7d7'>Website</td>
<td width='100px' style='border: 1px solid black; background-color: #d7d7d7'>Verwijderen</td>
<td width='100px' style='border: 1px solid black; background-color: #d7d7d7'>Edit</td>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['schoolname'] . "</td>";
        echo "<td>" . $row['adress'] . "</td>";
        echo "<td>" . $row['website'] . "</td>";
        echo "<td><input type='checkbox' value='" . $row['id']. " ' name='delete[]''></td>";
        echo "<td><a href='EditSchool?id=" . $row['id'] .  "'>Editschool</a> </td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<input type='submit' value='Verwijder alle geselecteerde vakken' >";
    echo "</form>";
}
echo "    <style>
        table{
            border-collapse:collapse;
        }
        td{
            border: 1px groove black;
        }
    </style>";
?>