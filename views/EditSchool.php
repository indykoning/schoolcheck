<?php
require_once "includes/database.php";

if(!empty($_POST['submit'])){
    $private = (!empty($_POST['private'])) ? '1' : '0';
    $art = (!empty($_POST['art'])) ? '1' : '0';
    $sql = "UPDATE schools SET schoolname = '" . $_POST['schoolname'] . "', adress = '" . $_POST['adress'] . "', adressNr = '" . $_POST['adressNr'] . "', zipcode = '" . $_POST['zipcode'] . "',  district_id = '" . $_POST['district'] . "', telnr = '" . $_POST['telnr'] . "', email = '" . $_POST['email'] . "', website = '" . $_POST['website'] . "', openday = '" . $_POST['openday'] . "', openclass = '" . $_POST['openclass'] . "', infonight = '" . $_POST['infonight'] . "', private = '" . $private . "', basis_id = '" . $_POST['basis'] . "', art = '" . $art . "' WHERE id='". $_POST['id'] . "'";
    $result = $mysqli->query($sql);

    //Levels editen
    $delete = $_POST['level'];
    $sql = "DELETE FROM schools_levels WHERE schools_id IN (" . $_POST['id'] . ")";
    $result = $mysqli->query($sql);
    for($i=0;$i<count($_POST['level']);$i++) {
        $sql = "INSERT INTO `schools_levels` (`schools_id`, `levels_id`) VALUES ('" . $_POST['id'] . "', '" . $_POST['level'][$i] . "')";
        $mysqli->query($sql);
    }

    //Concept
    $delete = $_POST['concept'];
    $sql = "DELETE FROM schools_concepts WHERE concepts_id IN (" . $_POST['id'] . ")";
    $result = $mysqli->query($sql);
    for($i=0;$i<count($_POST['concept']);$i++) {
        $sql = "INSERT INTO `schools_concepts` (`schools_id`, `concepts_id`) VALUES ('" . $_POST['id'] . "', '" . $_POST['concept'][$i] . "')";
        $mysqli->query($sql);
    }
    //Special
    $delete = $_POST['special'];
    $sql = "DELETE FROM schools_specials WHERE schools_id IN (" . $_POST['id'] . ")";
    $result = $mysqli->query($sql);
    for($i=0;$i<count($_POST['special']);$i++) {
        $sql = "INSERT INTO `schools_specials` (`schools_id`, `specials_id`) VALUES ('" . $_POST['id'] . "', '" . $_POST['special'][$i] . "')";
        $mysqli->query($sql);
    }

}

echo "<form method='post'>";


if(!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM schools WHERE id = $id";
    $result = $mysqli->query($sql);

    echo "<table>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr style='display: none'><td></td><td><input type='text' name='id' value='" . $row['id'] . "' </td></tr>";
        echo "<tr><td>Schoolnaam </td><td><input type='text' name='schoolname' value='" . $row['schoolname'] . "' </td></tr>";
        echo "<tr><td>Adress </td><td><input type='text' name='adress' value='" . $row['adress'] . "' </td></tr>";
        echo "<tr><td>Adress Number </td><td><input type='text' name='adressNr' value='" . $row['adressNr'] . "' </td></tr>";
        echo "<tr><td>Zipcode </td><td><input type='text' name='zipcode' value='" . $row['zipcode'] . "' </td></tr>";

        //Districts
        $sql = "SELECT * FROM districts";
        $result2 = $mysqli->query($sql);
        echo "<tr><td>District </td><td><select name='district'>";
        while ($row2 = $result2->fetch_assoc()) {
            $checked = ($row2["id"]==$row['district_id']) ? 'selected' : '';
            echo "<option $checked value='" . $row2['id'] . "'>" . $row2['name'] . "</option>";
        }
        echo "</select></td></tr>";
        echo "<tr><td>Phone Number </td><td><input type='text' name='telnr' value='" . $row['telnr'] . "' </td></tr>";
        echo "<tr><td>E-mail </td><td><input type='text' name='email' value='" . $row['email'] . "' </td></tr>";
        echo "<tr><td>Website </td><td><input type='text' name='website' value='" . $row['website'] . "' </td></tr>";
        echo "<tr><td>Openday </td><td><input type='text' name='openday' value='" . $row['openday'] . "' </td></tr>";
        echo "<tr><td>Openclass </td><td><input type='text' name='openclass' value='" . $row['openclass'] . "'</td></tr>";
        echo "<tr><td>Infonight </td><td><input type='text' name='infonight' value='" . $row['infonight'] . "' </td></tr>";
        $checked = ($row['private'] == 1) ? 'checked' : '';
        echo "<tr><td>Private </td><td><input $checked type='checkbox' name='private'> </td></tr>";

        //Levels
        $idee = array();
        $sql = "SELECT levels_id FROM schools_levels WHERE schools_id = $id";
        $result2 = $mysqli->query($sql);
        while ($row2 = $result2->fetch_assoc()) {
            array_push($idee,$row2['levels_id']);
        }
        $sql = "SELECT * FROM levels";
        $result2 = $mysqli->query($sql);
        echo "<tr><td>level</td><td><div style='max-height: 150px; overflow-y: auto'>";
        while ($row2 = $result2->fetch_assoc()) {
            $checked = (in_array($row2['id'],$idee)) ? 'checked' : '';
            echo '<input name="level[]" ' . $checked . ' type="checkbox" id="level' . $row2['id'] . '" value="' . $row2['id'] . '"><label for="level' . $row2['id'] . '">' . $row2['level'] . '</label><br>';
        }
        echo "</div></td></tr>";

        //Concepts
        $concepts = array();
        $sql = "SELECT concepts_id FROM schools_concepts WHERE schools_id = $id";
        $result2 = $mysqli->query($sql);
        while ($row2 = $result2->fetch_assoc()) {
            array_push($concepts,$row2['concepts_id']);
        }
        echo '<tr><td>concept</td><td><select id="concept" name="concept[]">';
            $sql = 'SELECT * FROM `concepts`';
            $result = $mysqli->query($sql);
            while ($row2 = $result->fetch_assoc()) {
                $checked = (in_array($row2['id'],$concepts)) ? 'selected' : '';
                echo '<option ' . $checked . ' value="' . $row2['id'] . '">' . $row2['concept'] . '</option>';
            }
        echo "</select></td></tr>";

        //Special
        $idee = array();
        $sql = "SELECT specials_id FROM schools_specials WHERE schools_id = $id";
        $result2 = $mysqli->query($sql);
        while ($row2 = $result2->fetch_assoc()) {
            array_push($idee,$row2['specials_id']);
        }
        $sql = "SELECT * FROM specials";
        $result2 = $mysqli->query($sql);
        echo "<tr><td>Specials</td><td><div style='max-height: 150px; overflow-y: auto'>";
        while ($row2 = $result2->fetch_assoc()) {
            $checked = (in_array($row2['id'],$idee)) ? 'checked' : '';
            echo '<input name="special[]" ' . $checked . ' type="checkbox" id="specials' . $row2['id'] . '" value="' . $row2['id'] . '"><label for="specials' . $row2['id'] . '">' . $row2['special'] . '</label><br>';
        }
        echo "</div></td></tr>";

        //Basis
        $sql = "SELECT * FROM basis";
        $result2 = $mysqli->query($sql);
        echo "<tr><td>Basis </td><td><select name='basis'>";
        while ($row2 = $result2->fetch_assoc()) {
            $checked = ($row2["id"]==$row['basis_id']) ? 'selected' : '';
            echo "<option $checked value='" . $row2['id'] . "'>" . $row2['basis'] . "</option>";
        }
        echo "</select></td></tr>";


        $checked = ($row['art'] == 1)? 'checked':'';
            echo "<tr><td>Art </td><td><input $checked type='checkbox' name='art'> </td></tr>";
    }
    echo "<tr><td><input type='submit' name='submit' value='Verander de gegevens'></td></tr>";
    echo "</table>";
}
echo "</form>";
echo "    <style>
        table{
            border-collapse:collapse;
        }
        td{
            border: 1px groove black;
        }
    </style>";


//Scholen kiezen die je wilt editen
//$sql = "SELECT id,schoolname,adress,website FROM schools";
//$result = $mysqli->query($sql);
//if(empty($_POST['edit'])) {
//
//echo "<table>";
//echo "<td width='300px' style='border: 1px solid black; background-color: #d7d7d7'>Schoolname</td>
//<td width='100px' style='border: 1px solid black; background-color: #d7d7d7'>Edit</td>";
//while($row = $result->fetch_assoc()) {
//    echo "<form method='post'>";
//    echo "<tr>";
//    echo "<td style='display: none'><input type='number' name='id' value='" . $row['id'] . "'></td>";
//    echo "<td>" . $row['schoolname'] . "</td>";
//    echo "<td><input type='submit' value='ezz' name='edit[]'></td>";
//    echo "</tr>";
//    echo "</form>";
//}
//echo "</table>";
//}
?>