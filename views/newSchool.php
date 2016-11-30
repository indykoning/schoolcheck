<?php if(!empty($_POST)){

}else{
    require_once "includes/database.php";
    ?>
    <form action="_self" method="post">
        <table>
            <tr><td><label>School name</label></td><td><input type="text" name="schoolname"></td></tr>
            <tr><td><label>address</label></td><td><input type="text" name="adress"></td></tr>
            <tr><td><label>address Number</label></td><td><input type="number" name="addressnr"></td></tr>
            <tr><td><label>zipcode</label></td><td><input type="text" name="zipcode"></td></tr>
            <tr><td><label>district</label></td><td><option name="district"><?php
            
                        ?></option></td></tr>
            <tr><td><label></label></td><td><input type="submit"></td></tr>

        </table>
    </form>
<?php
}