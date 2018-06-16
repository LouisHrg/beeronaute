<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Bar;
use App\Event;
use App\User;
use App\Subscription;

class FakeSubscriptions extends Seeder
{

    public function run()
    {   
        $faker = Faker::create();
        
        foreach (range(1,500) as $index) {

        $event = Event::where('id','>',0)->inRandomOrder()->first();
        $user = User::role('user')->inRandomOrder()->first();

        if(Subscription::where('user_id',$user->id)->where('event',$event->id)->first()){
            continue;
        }

        DB::table('subscriptions')->insert([
            'type' => 1,
            'user_id' => $user->id,
            'event' => $event->id,

        ]);

        }

    }

}
