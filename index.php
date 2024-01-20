<?php
include_once "arrayfile.php";
include_once "funMain.php";
?>



<div>
    <p><?=print_r(getPartsFromFullname('Степанова Наталья Степановна'));?></p>
    <p><?=getFullnameFromParts('Степанова', 'Наталья', 'Степановна');?></p>
    <p><?=getShortName('Степанова Наталья Степановна');?></p>
    <p><?=getGenderFromName('Пащенко Владимир Александрович');?></p>
    <p><?=getGenderDescription($example_persons_array);?></p>
    <p><?=getPerfectPartner("Степанова", "Наталья", "Степановна", $example_persons_array);?></p>
</div>
