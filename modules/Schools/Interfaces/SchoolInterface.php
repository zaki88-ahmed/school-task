<?php
namespace modules\Schools\Interfaces;


interface SchoolInterface {

    public function createSchool($request);


    public function allSchools();
    public function schoolDetails($request);
    public function updateSchool($request);

    public function softDeleteSchool($request);
    public function restoreSchool($request);

}
