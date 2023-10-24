<?php require 'partials/header.php'; ?>
<link rel="stylesheet" href="/facebook/public/css/auth.css">
<title>Register</title>
</head>

<body>
  <div class="container">
    <div class="form_title_container">
      <h1>AquaMeet</h1>
      <p>REGISTER</p>
    </div>

    <form action="/register" method="POST">
      <?php
      if (!empty($errors)) {
        foreach ($errors as $error) {
          echo "<span class='error'>$error</span>";
          echo '<br/>';
        }
      }
      ?>

      <input type="text" name="reg_fname" placeholder="First Name" value="<?= $old['reg_fname'] ?? '' ?>" />
      <br />
      <input type="text" name="reg_lname" placeholder="Last Name" value="<?= $old['reg_lname'] ?? '' ?>" />
      <br />
      <input type="email" name="reg_email" placeholder="Email" value="<?= $old['reg_email'] ?? '' ?>" required />
      <br />
      <input type="email" name="reg_confirm_email" placeholder="Confirm Email"
        value="<?= $old['reg_confirm_email'] ?? '' ?>" />
      <br />
      <input type="password" name="reg_password" placeholder="Password" required />
      <br />
      <input type="password" name="reg_confirm_password" placeholder="Confirm Password" />
      <br />
      <div class='anchor_wrapper'>
        <a href="/login" class="anchor">Have an account already?!</a>
      </div>

      <input type="submit" name="register_button" value="Register" />
    </form>
  </div>


  <style>
    .anchor_wrapper {
      display: flex;
      justify-content: end;
      padding-right: 5%;
    }

    .anchor {
      font-size: 12px;
      color: #3b5998;
      text-decoration: none;
    }

    .anchor:hover {
      text-decoration: underline;
    }
  </style>

  <script src="facebook/scripts/error.js"></script>
  <?php require 'partials/footer.php'; ?>