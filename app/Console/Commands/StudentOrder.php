<?php

namespace App\Console\Commands;

use App\Mail\ContactResponseMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use modules\Admins\Models\Admin;
use modules\Schools\Models\School;
use modules\Students\Models\Student;

class StudentOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is get students order by school';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $name = $this->ask('What is your name?');
//        $mail = $this->ask('What is your email address ?');
//
//        $this->info('user name is ' . $name . ' and user mail is ' . $mail);
//
//        Artisan::call('mysql -uroot -p');
//        Artisan::call('use school-task;');
//        Artisan::call(`select * from students ordered by school_id asc;`);


//        $this->table(
//            ['id', 'name', 'status', 'order', 'school_id'],
//            Student::all(['id', 'name', 'status', 'order', 'school_id'])->toArray()
//        );

        $studentTable = $this->table(
            ['id', 'name', 'status', 'order', 'school_id'],
            Student::orderBy('school_id','ASC')->get(['id', 'name', 'status', 'order', 'school_id'])->toArray()
        );

        $admin = Admin::first();
        $schools = School::orderBy('id', 'DESC')->with('students')->get();
        $students = Student::orderBy('id', 'DESC')->with('schools')->get();
//        $reOrderedStudents = SchoolResource:: collection($schools);


        Mail::to($admin->email)->send(
            new ContactResponseMail($admin, $schools)
        );

        $this->info('Mail Sent Successfully');
    }
}
