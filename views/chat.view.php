<?php require 'partials/header.php'; ?>
<style>
@import url('/facebook/public/css/default.css');
@import url('/facebook/public/css/font_awesome.css');
@import url('/facebook/public/css/chat.css');
</style>
<title>Chat</title>
</head>



<body>
  <?php require "partials/nav.php" ?>


  <div class="chat_wrapper">
    <?php if ($conversationsDiv): ?>
    <?= $conversationsDiv ?>
    <? var_dump($conversationId); ?>
    <?php else: ?>
    <h1>You have no conversations started</h1>
    <?php endif; ?>
  </div>


  <?php require 'partials/footer.php'; ?>