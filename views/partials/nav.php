<?php
use Core\Messaging\Messages;

$unreadMessages = (new Messages())->getUnreadMessages();
$totalUnreadCount = $unreadMessages ? array_sum(array_map('count', $unreadMessages)) : 0;
?>


<div class="top_bar" style="z-index: 2;">
  <div class="logo">
    <a href="/home">AquaMeet</a>
  </div>


  <nav>
    <span class='username'>
      <?= $_SESSION['user'] ? explode("@", $_SESSION['user'])[0] : false ?>
    </span>
    <a href="/chat">
      <i class="fa fa-envelope" aria-hidden="true"></i>
      <?php if ($totalUnreadCount): ?>
      <span class="message_badge">
        <?= $totalUnreadCount ?>
      </span>
      <?php endif; ?>
    </a>
    <a href="/followed-dashboard">
      <i class="fa fa-users" aria-hidden="true"></i>
    </a>
    <a href="/cabinet">
      <i class="fa fa-cog" aria-hidden="true"></i>
    </a>

    <form action="/logout" method="POST" class='logout_form'>
      <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
      <input type="hidden" name="_method" value="DELETE">
      <button type="submit">
        <i class="fa fa-sign-out fa-lg"></i>
      </button>
    </form>
  </nav>
</div>


<style>
@import url('/facebook/public/css/nav.css');

.message_badge {
  position: absolute;
  top: -5px;
  right: -5px;
  border-radius: 100%;
  background-color: red;
  color: #fff;
  padding: 3px;
  font-weight: bold;
  font-size: small;
}

i:first-child {
  margin-right: 5px;
}
</style>