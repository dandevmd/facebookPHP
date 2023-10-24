<?php require 'partials/header.php'; ?>
<style>
  @import url('/facebook/public/css/default.css');
  @import url('/facebook/public/css/font_awesome.css');
  @import url('/facebook/public/css/profile.css');
</style>
<title>Profile</title>
</head>

<body>
  <?php require "partials/nav.php" ?>
  <div class="stranger_wrapper">
    <div class="profile_left">
      <div class="pic_wrapper">
        <img src="<?= $user['profile_pic']
          ? '/facebook/public' . $user['profile_pic']
          : '/facebook/public/images/head_alizarin.png' ?>" alt="profile_pic">
      </div>


      <div class="user_description">
        <a href="/user/<?= $user ?>" class="username_anchor">
          <?= ucwords($user['first_name']) . ' ' . ucwords($user['last_name']) ?>
        </a>

        <p>
          Posts:
          <?= $user_posts ?? 0 ?>
        </p>

        <?=
          "<p>
           Mutual Friends: $mutualFriendsCount
          </p>";
        ?>

        <?php
        if ($user['friends_array'] && subTheString($user['friends_array'])) {
          $friendsTotal = count(subTheString($user['friends_array']));
          echo "<p>
           Friends: $friendsTotal
          </p>";
        }
        ?>
      </div>

      <div class="btn_wrapper">
        <?php if (!$isFriend): ?>
          <form action="/manage-followed" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <input type="hidden" name="user_email" value="<?= $user['email'] ?>">
            <input type="hidden" name="action" value="follow">
            <button type="submit" class="fa fa-user-plus"> FOLLOW</button>
          </form>
        <?php else: ?>
          <form action="/manage-followed" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <input type="hidden" name="user_email" value="<?= $user['email'] ?>">
            <input type="hidden" name="action" value="unfollow">
            <button type="submit" class="fa fa-user-times"> UN-FOLLOW</button>
          </form>
        <?php endif ?>
      </div>

      <?php if (!$conversation): ?>
        <br>
        <div class="btn_wrapper">
          <form action="/chat/store" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <input type="hidden" name="user_email" value="<?= $user['email'] ?>">
            <button type="submit" class="fa fa-envelope"> Start a conversation</button>
          </form>
        </div>
      <?php endif; ?>

    </div>

    <div class="column">
      <form action="/post" method="POST" class='post_form'>
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <textarea name="post_text" id="post_text" class='post_text' placeholder="Got something to say?..."></textarea>
        <button type="submit">POST</button>
      </form>
      <?php
      if (!empty($errors)) {
        foreach ($errors as $error) {
          echo "<span class='error'>$error</span>";
          echo '<br/>';
        }
      }
      ?>

      <!-- It is styled and interacting with js script -->
      <div id="postsWrapper">
      </div>
      <button id="loadMoreButton">
      </button>

    </div>
  </div>


  <script>
    const friendsPosts = <?php echo json_encode($friendsPosts); ?>;
    const authUser = <?php echo json_encode($_SESSION['user']); ?>;
    const csrfToken = <?php echo json_encode(generate_csrf_token()); ?>;
  </script>
  <script src="/facebook/scripts/showPostsHandler.js"></script>

  <?php require 'partials/footer.php'; ?>