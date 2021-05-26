<?php


namespace App\Controller\Admin;


use JetBrains\PhpStorm\NoReturn;
use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    /**
     * @return Response
     */
    #[NoReturn] #[Route('/admin/notification', name: 'notification_admin')]
    public function index(): Response
    {
        $server_key = 'AAAAKxGjGlE:APA91bGXnSnAaPc_NcwSXyikEuqUZwVwZqvwNChpwl0gQ7tK2c6NLULg92bzfPguHlwJAsYxZ0iWY-Wn2nmrUiaULYNp-BSbkIfNtybZUTrUrLnn_eTj4YsBkwZgLkW3AWK_t1tHfcHi';
        $client = new Client();
        $client->setApiKey($server_key);

        $message = new Message();
        $message->setPriority('high');
        $message->addRecipient(new Device('ed0FzEbgQeamtR8sz5FNED:APA91bG4kvxC7Zyrd_ETKrD2T7X5bXfYBUMJ4PZMrN2rD1Yis-Xd2PrFsu14h8ROkv_J5SI-Pt8A4eWg9bF8aLXj684Wh7KdUYkEsu1jtnk6IfrzdB0QxBWyWYJyK_BFClX_OHT2AjGG'));
        $message
            ->setNotification(new Notification('test symfony','test'))
            ->setData(['key'=>'184979495505','subject'=>'hello']);
        $response = $client->send($message);
        dd($response);

        return $this->render('admin/notification.html.twig');
    }

}