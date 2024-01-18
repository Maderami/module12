<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];
function getPartsFromFullname($snl) {
    $Name = explode(' ', $snl);
    $SNL = [
        'last_name' => $Name[0],
        'name' => $Name[1],
        'second_name' => $Name[2],
    ];
    return $SNL;
};
function getFullnameFromParts($surname, $name, $patronomyc){
    $fullname =  $surname ." " .$name ." " .$patronomyc;
    return $fullname;
};
function getShortName($person){
    $seporated = getPartsFromFullname($person);
    $shortName = $seporated["name"] . ' ' . mb_substr($seporated["last_name"],0,1). ".";
    return $shortName;
};
function getGenderFromName($fullName){
    $fullN = getPartsFromFullname($fullName);
    $genderPerson = 0;

    if((mb_substr($fullN['last_name'], -2,2) == 'ая' || mb_substr($fullN['last_name'], -1,1) == 'я' ) || (mb_substr($fullN['name'], -1,1) == 'а' || mb_substr($fullN['name'], -1,1) == 'я' || mb_substr($fullN['name'], -1,1) == 'ь' ) || mb_substr($fullN['second_name'], -2,2) == 'на'){
        $genderPerson = -1;
    }elseif((mb_substr($fullN['last_name'], -1,1) == 'н' || mb_substr($fullN['last_name'], -1,1) == 'к' || mb_substr($fullN['last_name'], -2,2) == 'ой'  || mb_substr($fullN['last_name'], -2,2) == 'ов' || mb_substr($fullN['last_name'], -1,1) == 'о' ) || (mb_substr($fullN['name'], -1,1) == 'а' || mb_substr($fullN['name'], -1,1) == 'я' || mb_substr($fullN['name'], -1,1) == 'ь' ) || mb_substr($fullN['second_name'], -2,2) == 'ич') {
        $genderPerson = 1;
    }else{
        $genderPerson = 0;
    }

    if($genderPerson === -1){
        return 'Женщина';
    }elseif ($genderPerson === 1){
        return 'Мужчина';
    }else{
        return 'Не возможно определить пол';
    }

}

function getGenderDescription($arraygender){}
function getPerfectPartner($lastname, $name, $secondname, $arrayExample){}
?>



<div>
    <p><?=print_r(getPartsFromFullname('Степанова Наталья Степановна'));?></p>
    <p><?=getFullnameFromParts('Степанова', 'Наталья', 'Степановна');?></p>
    <p><?=getShortName('Степанова Наталья Степановна');?></p>
    <p><?=getGenderFromName('Пащенко Владимир Александрович');?></p>

</div>
