<?php

declare(strict_types=1);


function is_course_registered(object $pdo, string $course){
    if (getcourse($pdo,$course)) {
        return true;
    }else{
        return false;
    }
}
function is_dptId_registered(object $pdo, int $dept_id){
    if (getdptId($pdo,$dept_id)) {
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





function is_dept_field_empty(string $dpt,string $dptacrm){

    if (
        empty($dpt) ||
        empty($dptacrm)
    ) {
        return true;
    }else{
        return false;
    }
}
function is_crs_field_empty(int $dept_id,string $crs,string $crsacrm){


    if (
        empty($dept_id) ||
        empty($crs) ||
        empty($crsacrm) 
    ) {
        return true;
    }else{
        return false;
    }
}