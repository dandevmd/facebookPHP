<?php require 'partials/header.php'; ?>
<style>
@import url('/facebook/public/css/default.css');
@import url('/facebook/public/css/font_awesome.css');
@import url('/facebook/public/css/home.css');
</style>
<title>Home</title>
</head>

<body>
  <?php require "partials/nav.php" ?>
  <div class="wrapper">
    <div class="user_details column">
      <img src="<?= $user['profile_pic'] 
      ?  '/facebook/public' . $user['profile_pic']
      : '/facebook/public/images/head_alizarin.png' ?>" alt="profile_pic">

      <div class="user_details_right">
        <span>
          <a href="/user/<?= $user ?>">
            <?= ucwords($user['first_name']) . ' ' . ucwords($user['last_name']) ?>
          </a>
          <p>
            Posts:
            <?= $user_posts ?? 0 ?>
          </p>
          <?php
          if ($user['friends_array'] && subTheString($user['friends_array'])) {
            $friendsTotal = count(subTheString($user['friends_array']));
            echo "<p>
           Friends: $friendsTotal
          </p>";
          }
          ?>
      </div>
    </div>

    <div class="main_column column">
      <form action="/post" method="POST" class='post_form'>
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <textarea name="post_text" id="post_text" class='post_text' placeholder="Got something to say?..."></textarea>
        <button type="submit">POST</button>
      </form>



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