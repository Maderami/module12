<?php
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

function getGenderDescription($arraygender){
    for($index = 0; $index < count($arraygender); $index++){
        $genderall[$index] = getGenderFromName($arraygender[$index]['fullname']);
    }
    $countMale = array_filter($genderall, function ($genderm){return $genderm == "Мужчина";});
    $countFemale = array_filter($genderall, function ($genderf){return $genderf == "Женщина";});
    $withoutSex = array_filter($genderall, function ($genderws){return $genderws == "Не возможно определить пол";});
    $resMale = count($countMale)/count($arraygender) * 100;
    $resFemale = count($countFemale)/count($arraygender) * 100;
    $resUndefined = count($withoutSex)/count($arraygender) * 100;
    return 'Гендерный состав аудитории: <hr>' .
        'Мужчины - ' . round($resMale, 2). '%<br>' .
        'Женщины - ' . round($resFemale, 2) . '%<br>' .
        'Не удалось определить - ' . round($resUndefined, 2) . '%<br>';
}


function getPerfectPartner($lastname, $name, $secondname, $arraymain){
    $fullname = getFullnameFromParts($lastname, $name, $secondname);
    $genderOne = getGenderFromName($fullname);
    $randPartner = rand(0, count($arraymain)-1);
    $partner = $arraymain[$randPartner]['fullname'];
    $partnerGender = getGenderFromName($partner);
    $genderFlag = false;
    if(($partnerGender == $genderOne) || $partnerGender == 'Не возможно определить пол'){

        while ($genderFlag){
            if ($partnerGender != $genderOne && $partnerGender != 'Не возможно определить пол'){
                $genderFlag = true;
                $randomFit = rand(5000, 10000)/100;
                return getShortName($fullname) . '  +  ' . getShortName($partner) . 'Подят друг другу на:  ' . $randomFit . ' %';
            }
        }
        $randPartner = rand(0, count($arraymain)-1);
        $personTwo = $arraymain[$randPartner]['fullname'];
        $partnerGender = getGenderFromName($personTwo);
        return 'Обноите страницу для повторного переопределения данных';
    }else{
        $randomFit = rand(5000, 10000)/100;
        return getShortName($fullname) . '  +  ' . getShortName($partner) . 'Подходят друг другу на:  ' . $randomFit . ' %';
    }
}