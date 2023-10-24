<?php require 'partials/header.php'; ?>
<style>
@import url('/facebook/public/css/default.css');
@import url('/facebook/public/css/font_awesome.css');
@import url('/facebook/public/css/message.css');
</style>
<title>To
  <?= $convName ?>
</title>
</head>



<body>
  <?php require "partials/nav.php" ?>


  <div class="message_wrapper">
    <div>
      <h1>Conversation with <span>
          <?= $convName ?>
        </span> </h1>
      <hr>
    </div>
    <div class="messages">
      <?php foreach ($messages as $m): ?>

      <div class="message <?= $m['sender_email'] !== $_SESSION['user'] ? 'message_me' : '' ?> ">
        <p class="body">
          <?= $m['body'] ?>
        </p>
        <span class="date">
          <?= $m['sent_at'] ?>
        </span>
      </div>
      <?php endforeach; ?>
    </div>

    <form action="/chat/messages/store" method="POST">
      <input type="hidden" name="conversation_id" value="<?= $conversation['id'] ?>">
      <input type="hidden" name="user_email" value="<?= $_SESSION['user'] ?> ">
      <textarea name="body" required></textarea>
      <button type="submit" class="fa fa-paper-plane-o"></button>
    </form>
  </div>


  <?php require 'partials/footer.php'; ?>