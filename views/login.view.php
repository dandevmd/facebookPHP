<?php require 'partials/header.php'; ?>
<link rel="stylesheet" href="/facebook/public/css/auth.css">
<title>Login</title>
</head>

<body>
  <div class="container">
    <div class="form_title_container">
      <h1>AquaMeet</h1>
      <p>LOGIN</p>
    </div>

    <form action="/login" method="POST">
      <?php
      if (!empty($errors)) {
        foreach ($errors as $error) {
          echo "<span class='error'>$error</span>";
          echo '<br/>';
        }
      }
      ?>

      <input type="email" name="log_email" placeholder="Email" value="<?= $old['log_email'] ?? '' ?>" required />
      <br />
      <input type="password" name="log_password" placeholder="Password" required />
      <br />
      <div class='anchor_wrapper'>
        <a href="/register" class="anchor">Open an account!</a>
      </div>

      <input type="submit" name="login_button" value="Login" />
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