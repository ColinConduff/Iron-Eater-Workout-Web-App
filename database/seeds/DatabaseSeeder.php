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
use App\Plan;
use App\PlanWorkout;
use App\PlanExercise;
use App\PlanDate;
use App\PlanSet;

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
            'password' => bcrypt('userTest'),
            'height_inches' => 70
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
            'failed' => false
        ]);

        $sessionSet2 = SessionSet::create([
            'session_id' => $session1->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet3 = SessionSet::create([
            'session_id' => $session1->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet4 = SessionSet::create([
            'session_id' => $session2->id,
            'number_of_reps' => 8,
            'weight_lifted' => 95,
            'one_rep_max' => 100,
            'failed' => false
        ]);

        $sessionSet5 = SessionSet::create([
            'session_id' => $session2->id,
            'number_of_reps' => 8,
            'weight_lifted' => 95,
            'one_rep_max' => 100,
            'failed' => false
        ]);

        $sessionSet6 = SessionSet::create([
            'session_id' => $session2->id,
            'number_of_reps' => 8,
            'weight_lifted' => 95,
            'one_rep_max' => 100,
            'failed' => false
        ]);

        $sessionSet7 = SessionSet::create([
            'session_id' => $session3->id,
            'number_of_reps' => 8,
            'weight_lifted' => 65,
            'one_rep_max' => 80,
            'failed' => false
        ]);

        $sessionSet8 = SessionSet::create([
            'session_id' => $session3->id,
            'number_of_reps' => 8,
            'weight_lifted' => 65,
            'one_rep_max' => 80,
            'failed' => false
        ]);

        $sessionSet9 = SessionSet::create([
            'session_id' => $session3->id,
            'number_of_reps' => 8,
            'weight_lifted' => 65,
            'one_rep_max' => 80,
            'failed' => false
        ]);

        $sessionSet10 = SessionSet::create([
            'session_id' => $session4->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet11 = SessionSet::create([
            'session_id' => $session4->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet12 = SessionSet::create([
            'session_id' => $session4->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet13 = SessionSet::create([
            'session_id' => $session5->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet14 = SessionSet::create([
            'session_id' => $session5->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet15 = SessionSet::create([
            'session_id' => $session5->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet16 = SessionSet::create([
            'session_id' => $session6->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet17 = SessionSet::create([
            'session_id' => $session6->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $sessionSet18 = SessionSet::create([
            'session_id' => $session6->id,
            'number_of_reps' => 8,
            'weight_lifted' => 180,
            'one_rep_max' => 190,
            'failed' => false
        ]);

        $plan1 = Plan::create([
            'user_id' => $userTest->id,
            'title' => '5/3/1',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addWeeks(4)
        ]);

        $planWorkout1 = PlanWorkout::create([
            'plan_id' => $plan1->id,
            'workout_id' => $workout1->id
        ]);

        $planWorkout2 = PlanWorkout::create([
            'plan_id' => $plan1->id,
            'workout_id' => $workout2->id
        ]);

        $planWorkout3 = PlanWorkout::create([
            'plan_id' => $plan1->id,
            'workout_id' => $workout3->id
        ]);

        $planDate1 = PlanDate::create([
            'plan_workout_id' => $planWorkout1->id,
            'planned_date' => Carbon::tomorrow()
        ]);

        $planDate2 = PlanDate::create([
            'plan_workout_id' => $planWorkout1->id,
            'planned_date' => Carbon::tomorrow()->addDays(5)
        ]);

        $planDate3 = PlanDate::create([
            'plan_workout_id' => $planWorkout2->id,
            'planned_date' => Carbon::tomorrow()->addDay()
        ]);

        $planDate4 = PlanDate::create([
            'plan_workout_id' => $planWorkout2->id,
            'planned_date' => Carbon::tomorrow()->addDays(6)
        ]);

        $planExercise1 = PlanExercise::create([
            'plan_workout_id' => $planWorkout1->id,
            'exercise_id' => $exercise1->id,
            'weight_to_add_for_success' => 5,
            'weight_to_sub_for_fail' => 5
        ]);

        $planExercise2 = PlanExercise::create([
            'plan_workout_id' => $planWorkout1->id,
            'exercise_id' => $exercise2->id,
            'weight_to_add_for_success' => 5,
            'weight_to_sub_for_fail' => 5
        ]);

        $planSet1 = PlanSet::create([
            'plan_exercise_id' => $planExercise1->id,
            'expected_reps' => 10,
            'expected_weight' => 100
        ]);

        $planSet2 = PlanSet::create([
            'plan_exercise_id' => $planExercise1->id,
            'expected_reps' => 10,
            'expected_weight' => 100
        ]);
    }
}
