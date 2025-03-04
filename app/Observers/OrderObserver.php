<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        // Firebase credentials and setup
        $firebaseCredentialsPath = public_path('json/fir.json');
        $factory = (new Factory)->withServiceAccount($firebaseCredentialsPath);
        $messaging = $factory->createMessaging();

        // Create the notification
        $notification = Notification::create(
            "Order Status",
            "Your order has been $order->status",
        );

        // Create the CloudMessage
        $message = CloudMessage::new()
            ->withNotification($notification)
            ->withData($request->data ?? []);

        // Send the notification to multiple tokens
        $messaging->sendMulticast($message, $tokens);
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
