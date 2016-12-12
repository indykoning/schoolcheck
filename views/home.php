<?php
$sql = "SELECT schools.*, districts.name as district, basis.basis FROM schools
 JOIN districts ON schools.district_id=districts.id 
 JOIN basis ON schools.basis_id=basis.id
";
$result = $mysqli->query($sql);

while($row = $result->fetch_assoc()){
    echo "<table>";
    echo "<tr><td>schoolname</td><td>". $row['schoolname'] . "</td></tr>";
    echo "<tr><td>adress</td><td>". $row['adress'] . " " . $row['adressNr'] . "</td></tr>";
    echo "<tr><td>zipcode</td><td>". $row['zipcode'] . "</td></tr>";
    echo "<tr><td>district</td><td>". $row['district'] . "</td></tr>";
    echo "<tr><td>telnr</td><td>". $row['telnr'] . "</td></tr>";
    echo "<tr><td>email</td><td>". $row['email'] . "</td></tr>";
    echo "<tr><td>website</td><td>". $row['website'] . "</td></tr>";
    echo "<tr><td>openday</td><td>". $row['openday'] . "</td></tr>";
    echo "<tr><td>openclass</td><td>". $row['openclass'] . "</td></tr>";
    echo "<tr><td>infonight</td><td>". $row['infonight'] . "</td></tr>";
    $private = ($row['private']) ? 'Yes' : 'No';
    echo "<tr><td>private</td><td>". $private . "</td></tr>";
    echo "<tr><td>level</td><td>";
    $sql = "SELECT levels.level FROM levels INNER JOIN schools_levels ON schools_levels.levels_id=levels.id WHERE schools_id = ". $row['id'];
    $result2 = $mysqli->query($sql);
    while($row2 = $result2->fetch_assoc()){
        echo $row2['level'] . ", ";
    }
    echo "</td></tr>";
    echo "<tr><td>concept</td><td>";
        $sql = "SELECT concepts.concept FROM concepts INNER JOIN schools_concepts ON schools_concepts.concepts_id=concepts.id WHERE schools_id = ". $row['id'];
    $result2 = $mysqli->query($sql);
    while($row2 = $result2->fetch_assoc()){
        echo $row2['concept'] . ", ";
    }
    echo "</td></tr>";
    echo "<tr><td>special</td><td>";
    $sql = "SELECT specials.special FROM specials INNER JOIN schools_specials ON schools_specials.specials_id=specials.id WHERE schools_id = ". $row['id'];
    $result2 = $mysqli->query($sql);
    while($row2 = $result2->fetch_assoc()){
        echo $row2['special'] . ", ";
    }
    echo  "</td></tr>";
    $art = ($row['art']) ? 'Yes' : 'No';
    echo "<tr><td>basis</td><td>". $row['basis'] . "</td></tr>";
    echo "<tr><td>art</td><td>". $art . "</td></tr>";
    echo "</table><br><br>";

}
?>
<style>
    table{
        border-collapse:collapse;
    }
    td{
        border: 1px groove black;
    }
</style>
