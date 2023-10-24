<?php require 'partials/header.php'; ?>
<style>
  @import url('/facebook/public/css/default.css');
  @import url('/facebook/public/css/font_awesome.css');
  @import url('/facebook/public/css/cabinet.css');
</style>
<title>User Cabinet</title>
</head>

<body>
  <?php require "partials/nav.php" ?>

  <div class="wrapper">
    <h1>Update user profile</h1>


    <h3>Update user pic</h3>
    <div class="img_wrapper">
      <span> Current Image:</span>
      <img src="<?= $user['profile_pic'] ? '/facebook/public' . $user['profile_pic'] : null ?>" alt="profile_pic">
    </div>

    <form action="/cabinet/upload-pic" method="POST" enctype="multipart/form-data" class='update_pic_form'>
      <input type="file" name="profile_pic" accept="image/*" id='upload_input'>
      <input type="submit" value="Upload" class='update_pic_input' id="upload_button">
    </form>


    <form class="update_info_form" action="/cabinet/user-update" method="POST">
      <h3>Update user info</h3>
      <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token() ?>" />
      <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>" />

      <input type="text" name="fName" placeholder="First Name" value="<?= $user['first_name'] ?? '' ?>" required />
      <br />
      <input type="text" name="lName" placeholder="Last Name" value="<?= $user['last_name'] ?? '' ?>" required />
      <br />
      <input type="password" name="password" placeholder="Password" required />
      <br />
      <input type="submit" name="update" value="Update" />
    </form>
  </div>



  <?php require 'partials/footer.php'; ?>