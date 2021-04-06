<?php

namespace App\Jobs;

use App\Mail\Stats;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Exception;

class StatsToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $albums;
    protected $playlists;
    protected $tracks;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($albums, $playlists, $tracks)
    {
        $this->albums = $albums;
        $this->playlists = $playlists;
        $this->tracks = $tracks;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        foreach($users as $user){
            if($user->email){
                Mail::to($user->email)->send(new Stats($this->albums, $this->playlists, $this->tracks));
            }
            else{
                throw new Exception("User {$user->id} is missing an email");
            } 
        }
    }
}
