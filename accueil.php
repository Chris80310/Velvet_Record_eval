<!-- <div class="row">
        <div class="col-lg-8 col-sm-12">
        </div>
    </div> -->
    

<!-- HEADER : -->
<?php 
    if (file_exists("header.php") ) 
    {
        include("header.php");
    }
?>

<!-- ACCEUIL :  -->
<?php 
    if (file_exists("discs.php") ) 
    {
        include("discs.php");
    }
?>

<!-- FOOTER : -->
<?php
    if (file_exists("footer.php") ) 
    {
        include("footer.php");
    } 
?>