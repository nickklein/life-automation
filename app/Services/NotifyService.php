<?php

namespace App\Services;

use App\User;
use App\Models\Devices;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notify;
use App\Repositories\DeviceRepository;

class NotifyService
{
    public function sendToUser(array $fields, int $userId)
    {
        // Get Users email and phone number
        $user = User::find($userId);

        $device = (new DeviceRepository)->first($userId, $fields['device_id']);

        $this->sendEmail($user->email, $device->device_name);
    }

    private function sendEmail(string $email, string $deviceName)
    {
        Mail::to($email)
            ->send(new Notify($deviceName));
    }

    private function sendSMS(int $phone)
    {

    }
}