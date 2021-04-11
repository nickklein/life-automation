<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Repositories\DeviceRepository;

class Notify extends Mailable
{
    use Queueable, SerializesModels;

    protected $deviceName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($deviceName)
    {
        $this->deviceName = $deviceName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.notify')
                ->subject('Motion Triggered')
                ->with([
                    'deviceName' => $this->deviceName,
                    'dateTime' => date('Y-m-d H:i:s'),
                ]);
    }
}
