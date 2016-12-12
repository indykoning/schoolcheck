<?php

if(!empty($_POST['schoolname'])){
    $files = $_FILES['files'];
    $target_dir = "fotos/";
    $target_file = $target_dir . basename($files["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($files["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
        if(move_uploaded_file($files["tmp_name"], $target_file)){
        $uploadOk=1;
            $foto = basename( $files["name"]);
        }else{
            $uploadOk=0;

        }
    } else {
        echo basename( $files['name']) . " is geen foto.<br>";
        $uploadOk = 0;
    }

    if($uploadOk){
    $private = (!empty($_POST['private'])) ? '1' : '0';
    $art = (!empty($_POST['art'])) ? '1' : '0';
$sql = "INSERT INTO `schools` ( `schoolname`, `adress`, `adressNr`, `zipcode`, `district_id`, `telnr`, `email`, `website`, `openday`, `openclass`, `infonight`, `private`, `basis_id`, `art`, `foto`) VALUES ('" . $_POST['schoolname'] . "', '" . $_POST['adress'] . "','" . $_POST['adressnr'] . "','" . $_POST['zipcode'] . "','" . $_POST['district'] . "','" . $_POST['telnr'] . "','" . $_POST['email'] . "','" . $_POST['website'] . "','" . $_POST['openday'] . "','" . $_POST['openclass'] . "','" . $_POST['infonight'] . "','" . $private . "','" . $_POST['basis'] . "','" . $art . "','" . $foto ."')";
$mysqli->query($sql);

$row['id'] = $mysqli->insert_id;
//$sql = "SELECT `id` FROM `schools` WHERE schoolname='" . $_POST['schoolname'] ."'";
//$result = $mysqli->query($sql);
//$row = $result->fetch_assoc();
if(!empty($_POST['level'])){
for($i=0;$i<count($_POST['level']);$i++){
    $sql = "INSERT INTO `schools_levels` (`schools_id`, `levels_id`) VALUES ('" . $row['id'] . "', '". $_POST['level'][$i] . "')";
    $mysqli->query($sql);
}
}
    if(!empty($_POST['concept'])) {
        for ($i = 0; $i < count($_POST['concept']); $i++) {
            $sql = "INSERT INTO `schools_concepts` (`schools_id`, `concepts_id`) VALUES ('" . $row['id'] . "', '" . $_POST['concept'][$i] . "')";
            $mysqli->query($sql);
        }
    }
    if(!empty($_POST['concept'])){
for($i=0;$i<count($_POST['special']);$i++){
    $sql = "INSERT INTO `schools_specials` (`schools_id`, `specials_id`) VALUES ('" . $row['id'] . "', '". $_POST['special'][$i] . "')";
    $mysqli->query($sql);
}}
    if(!mysqli_error($mysqli)){
        echo '<h1 style="color: lime">Upload Successfull</h1>';
    }else{
        echo '<h1 style="color: red">Upload Failed</h1>';
        //var_dump(mysqli_error($mysqli));
    }
}else{
        echo '<h1 style="color: red">Upload Failed during upload of image</h1>';
    }}

    ?>
    <form enctype="multipart/form-data" method="post">
        <table>
            <tr><td>School name</td><td><input required type="text" name="schoolname"></td></tr>
            <tr><td>adress</td><td><input required type="text" name="adress"></td></tr>
            <tr><td>adress Number</td><td><input required type="number" name="adressnr"></td></tr>
            <tr><td>zipcode</td><td><input required type="text" name="zipcode"></td></tr>
            <tr><td>district</td><td><select id="district_list" name="district"><?php
                        $sql = "SELECT * FROM districts";
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        ?></select></td></tr>
            <tr><td>Phone number</td><td><input required type="number" maxlength="11" name="telnr"></td></tr>
            <tr><td>e-mail</td><td><input type="email" name="email"></td></tr>
            <tr><td>website</td><td><input type="text" name="website"></td></tr>
            <tr><td>openday</td><td><input type="text" name="openday"></td></tr>
            <tr><td>openclass</td><td><input type="text" name="openclass"></td></tr>
            <tr><td>infonight</td><td><input type="text" name="infonight"></td></tr>
            <tr><td>private</td><td><input type="checkbox" name="private"></td></tr>
            <tr><td>level</td><td>
                    <div style="max-height: 150px; overflow-y: auto">
 <?php
                        $sql = 'SELECT * FROM levels';
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo '<input name="level[]" type="checkbox" id="level' . $row['id'] . '" value="' . $row['id'] . '"><label for="level' . $row['id'] . '">' . $row['level'] . '</label><br>';
                        }
                        ?>
                    </div>
                </td></tr>
            <tr><td>concept</td><td><select id="concept" name="concept[]"><?php
                        $sql = 'SELECT * FROM concepts';
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['concept'] . '</option>';
                        }
                        ?></select></td></tr>
            <tr><td>special</td><td><div style="max-height: 150px; overflow-y: auto"><?php
                        $sql = 'SELECT * FROM specials';
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo '<input name="special[]" type="checkbox" id="special' . $row['id'] . '" value="' . $row['id'] . '"><label for="special' . $row['id'] . '">' . $row['special'] . '</label><br>';
                        }
                        ?>
                    </div></td></tr>
            <tr><td>basis</td><td><select name="basis"><?php
                        $sql = 'SELECT * FROM basis';
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['basis'] . '</option>';
                        }

                        ?></select></td></tr>
            <tr><td>art</td><td><input type="checkbox" name="art"></td></tr>
            <tr><td>foto</td><td><input type="file" accept="image/*" name="files"></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td><input value="voeg toe" type="submit"></td></tr>

        </table>
    </form>
    <style>
        table{
            border-collapse:collapse;
        }
        td{
            border: 1px groove black;
        }
    </style>
