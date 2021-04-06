<?php

namespace App\Mail;

use App\Models\Album;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Stats extends Mailable
{
    use Queueable, SerializesModels;
    public $albums;
    public $playlists;
    public $tracks;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($albums, $playlists, $tracks)
    {
        $this->albums = $albums;
        $this->playlists = $playlists;
        $this->tracks = intval((($tracks)/1000)/60);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Some Stats")
                    ->view('email.stats');
    }
}
