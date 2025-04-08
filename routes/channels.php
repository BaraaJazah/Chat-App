<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userId}', function ($user, $userId) {

    // انا (مستخدم 1) بدي ابعث رسالة المستخدم 2.

    // $userId = 2 هو الشخص يلي مسموحله يستمع للقناة

    // السيرفر يبث حدث على  قناة.2 (يعني يرسل رسالة الى قناة 2 يلي هي خاصة بالمستخدم 2)

    // $user->id هو المستخدم يلي رح يحاول يعمل اشراك بالقناة
    // اذا كانوا متوافقين رح يقبل الاشتراك والا فمارح يقبل

    // فقط المستخدم 2 يمكن الاستماع للقناة حتى انا ما بحسن

    // لما هو يبعلي رسالة رح يبعت على قناة.1 يلي فقك انا ممكن استمع الها

    return (int) $user->id === (int) $userId;
});



Broadcast::channel('{typerId}.typingTo.{reciverId}', function ($user, $typerId, $reciverId) {
    return (int) $user->id === (int) $typerId || (int) $user->id === (int) $reciverId;
});
