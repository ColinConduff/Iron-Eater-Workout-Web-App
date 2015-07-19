<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\User;
use App\Routine;
use App\Workout;
use App\Exercise;
use App\Session;
use App\SessionSet;
use App\SessionPlan;
use App\SessionPlanDate;
use App\SessionSetPlan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();

        $userTest = User::create([
            'name' => 'userTest',
            'email' => 'userTest@gmail.com',
            'password' => bcrypt('userTest')
        ]);

        $workout1 = Workout::create([
            'user_id' => $userTest->id,
            'title' => 'Push',
            'note' => 'This is a note'
        ]);

        $workout2 = Workout::create([
            'user_id' => $userTest->id,
            'title' => 'Pull',
            'note' => 'This is a note'
        ]);

        $workout3 = Workout::create([
            'user_id' => $userTest->id,
            'title' => 'Legs',
            'note' => 'This is a note'
        ]);

        $exercise1 = Exercise::create([
            'user_id' => $userTest->id,
            'title' => 'Barbell Bench Press',
            'max_one_rep_max' => 190,
            'type' => 'Weighted',
            'category' => 'Chest'
        ]);

        $exercise2 = Exercise::create([
            'user_id' => $userTest->id,
            'title' => 'Overhead Press',
            'max_one_rep_max' => 100,
            'type' => 'Weighted',
            'category' => 'Shoulders'
        ]);

        $exercise3 = Exercise::create([
            'user_id' => $userTest->id,
            'title' => 'One Arm Row',
            'max_one_rep_max' => 75,
            'type' => 'Weighted',
            'category' => 'Back'
        ]);

        $exercise4 = Exercise::create([
            'user_id' => $userTest->id,
            'title' => 'Pulldown',
            'max_one_rep_max' => 200,
            'type' => 'Weighted',
            'category' => 'Back'
        ]);

        $exercise5 = Exercise::create([
            'user_id' => $userTest->id,
            'title' => 'Squats',
            'max_one_rep_max' => 225,
            'type' => 'Weighted',
            'category' => 'Legs'
        ]);

        $exercise6 = Exercise::create([
            'user_id' => $userTest->id,
            'title' => 'Deadlifts',
            'max_one_rep_max' => 200,
            'type' => 'Weighted',
            'category' => 'Legs'
        ]);

        $session1 = Session::create([
            'user_id' => $userTest->id,
            'workout_id' => $workout1->id,
            'exercise_id' => $exercise1->id,
            'session_date' => Carbon::now()
        ]);

        $session2 = Session::create([
            'user_id' => $userTest->id,
            'workout_id' => $workout1->id,
            'exercise_id' => $exercise2->id,
            'session_date' => Carbon::now()
        ]);

        $session3 = Session::create([
            'user_id' => $userTest->id,
            'workout_id' => $workout2->id,
            'exercise_id' => $exercise3->id,
            'session_date' => Carbon::now()
        ]);

        $session4 = Session::create([
            'user_id' => $userTest->id,
            'workout_id' => $workout2->id,
            'exercise_id' => $exercise4->id,
            'session_date' => Carbon::now()
        ]);

        $session5 = Session::create([
            'user_id' => $userTest->id,
            'workout_id' => $workout3->id,
            'exercise_id' => $exercise5->id,
            'session_date' => Carbon::now()
        ]);

        $session6 = Session::create([
            'user_id' => $userTest->id,
            'workout_id' => $workout3->id,
            'exercise_id' => $exercise6->id,
            'session_date' => Carbon::now()
        ]);

        $sessionSet1 = SessionSet::create([
            'session_id' => $session1->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet2 = SessionSet::create([
            'session_id' => $session1->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet3 = SessionSet::create([
            'session_id' => $session1->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet4 = SessionSet::create([
            'session_id' => $session2->id,
            'number_of_reps' => 8,
            'weight_lifted' => 95,
            'one_rep_max' => 100,
        ]);

        $sessionSet5 = SessionSet::create([
            'session_id' => $session2->id,
            'number_of_reps' => 8,
            'weight_lifted' => 95,
            'one_rep_max' => 100,
        ]);

        $sessionSet6 = SessionSet::create([
            'session_id' => $session2->id,
            'number_of_reps' => 8,
            'weight_lifted' => 95,
            'one_rep_max' => 100,
        ]);

        $sessionSet7 = SessionSet::create([
            'session_id' => $session3->id,
            'number_of_reps' => 8,
            'weight_lifted' => 65,
            'one_rep_max' => 80,
        ]);

        $sessionSet8 = SessionSet::create([
            'session_id' => $session3->id,
            'number_of_reps' => 8,
            'weight_lifted' => 65,
            'one_rep_max' => 80,
        ]);

        $sessionSet9 = SessionSet::create([
            'session_id' => $session3->id,
            'number_of_reps' => 8,
            'weight_lifted' => 65,
            'one_rep_max' => 80,
        ]);

        $sessionSet10 = SessionSet::create([
            'session_id' => $session4->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet11 = SessionSet::create([
            'session_id' => $session4->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet12 = SessionSet::create([
            'session_id' => $session4->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet13 = SessionSet::create([
            'session_id' => $session5->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet14 = SessionSet::create([
            'session_id' => $session5->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet15 = SessionSet::create([
            'session_id' => $session5->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet16 = SessionSet::create([
            'session_id' => $session6->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet17 = SessionSet::create([
            'session_id' => $session6->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);

        $sessionSet18 = SessionSet::create([
            'session_id' => $session6->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
        ]);
    }
}
