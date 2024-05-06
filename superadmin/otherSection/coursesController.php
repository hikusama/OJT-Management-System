<?php

declare(strict_types=1);


function is_course_registered(object $pdo, string $course){
    if (getcourse($pdo,$course)) {
        return true;
    }else{
        return false;
    }
}
function is_dpt_registered(object $pdo, string $dpt){
    if (getdpt($pdo,$dpt)) {
        return true;
    }else{
        return false;
    }
}
function is_deptacrm_registered(object $pdo, string $acrn){
    if (getdptacrm($pdo,$acrn)) {
        return true;
    }else{
        return false;
    }
}
function is_crsacrm_registered(object $pdo, string $acrn){
    if (getcrsacrm($pdo,$acrn)) {
        return true;
    }else{
        return false;
    }
}


function is_field_empty(string $crs, string $dpt,string $crsacrm, string $dptacrm){


    if (
        empty($crs) ||
        empty($dpt) ||
        empty($dptacrm) ||
        empty($crsacrm) 
    ) {
        return true;
    }else{
        return false;
    }
}