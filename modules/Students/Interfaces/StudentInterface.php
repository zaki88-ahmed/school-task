<?php
namespace modules\Students\Interfaces;


interface StudentInterface {

    public function createStudent($request);


    public function allStudents();
    public function orderStudents();
    public function studentDetails($request);
    public function updateStudent($request);

    public function softDeleteStudent($request);
    public function restoreStudent($request);
//    public function verify($request, $id);

}
