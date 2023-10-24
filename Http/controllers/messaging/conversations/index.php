<?php

use Core\Messaging\Conversation;
use Core\Messaging\Messages;
use Core\User;


$cInstance = new Conversation();
$allConversations = $cInstance->getAuthConversations();

function conversationDiv($allConversations, $conversationId = null)
{
  $output = '';

  foreach ($allConversations as $c) {
    $profilePic = (new User())->getUserPic($c['user2_email'])[0]['profile_pic'] ?? '/facebook/public/images/head_alizarin.png';
    $userName = $c['user1_email'] === $_SESSION['user'] ? $c['user2_email'] : $c['user1_email'];
    $userEmail = $c['user2_email'];
    $csrfToken = generate_csrf_token();
    $currentConversationId = $c['id'];
    $allUnreadMes = (new Messages())->getUnreadMessages();
    $currentUnreadCount = isset($allUnreadMes[$c['id']]) ? count(($allUnreadMes[$c['id']])) : null;


    $output .= <<<HTML
              <a href="/chat/messages/{$currentConversationId}">
            <div class="conversation" id="{$currentConversationId}">
                <div class="user_row">
                    <img src="{$profilePic}" alt="profile_pic">
                    
                    <h4><span>To: </span>{$userName}</h4>
                  </div>
                </a>
                  <div class="delete_conversation">
                    <?php if($currentUnreadCount):?>
<span>New messages: {$currentUnreadCount}</span>
<?php endif;?>
<form action="/chat/delete" method="POST">
  <input type="hidden" name="_method" value="DELETE">
  <input type="hidden" name="conversation_id" value="{$currentConversationId}">
  <input type="hidden" name="csrf_token" value="{$csrfToken}">
  <input type="hidden" name="user_email" value="{$userEmail}">
  <button type="submit" class="fa fa-times"></button>
</form>
</div>
</div>
HTML;
  }

  return $output;
}


return view('chat.view.php', [
  'conversationsDiv' => conversationDiv($allConversations),

]);