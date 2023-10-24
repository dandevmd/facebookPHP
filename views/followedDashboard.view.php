<?php require 'partials/header.php'; ?>
<style>
@import url('/facebook/public/css/default.css');
@import url('/facebook/public/css/font_awesome.css');
@import url('/facebook/public/css/friends_dashboard.css');
</style>
<title>Dashboard</title>
</head>

<body>
  <?php require "partials/nav.php" ?>
  <div class="dashboard_container">
    <h1 class='dashboard_title'>Manage follow relationships</h1>

    <div class="dashboard_column">
      <?= $followed ?>
    </div>
  </div>




  <?php require 'partials/footer.php'; ?>