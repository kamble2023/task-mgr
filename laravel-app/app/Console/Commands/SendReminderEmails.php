<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\ReminderEmailDigest;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //get all reminder tasks
        $reminders = Task::query()
        ->where('end_date','<=',now()->format('Y-m-d'))
        ->get();
       // dd($reminder); exit;
       //Get tasks
       $data = [];
       foreach($reminders as $reminder){
        //$data[$reminder->id][] = $reminder->toArray();
        $this->sendEmailToUser($reminders);
       }

    //    foreach($data as $userId => $reminders){
    //     $this->sendEmailToUser($userId, $reminders);
    // }
      
       
    //    $userArray = [];
    //    foreach($users as $user){
    //     $userArray[$user->id] = $user->toArray();
    //    }
    //    foreach($userArray as $user){
    //     foreach($data as $userId => $reminders){
    //         $this->sendEmailToUser($userId, $reminders);
    //     }
    //    }
       //Send email to user

      
    }

    private function sendEmailToUser($reminders){

        //Get Users 
        $users = User::get();
        foreach($users as $user){
            Mail::to($user)->send(new ReminderEmailDigest($reminders));     
        }
       
    }
}
