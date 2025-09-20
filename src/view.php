<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./favicon.ico" />
    <title>HealthChecker</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/css/bootstrap.min.css" integrity="sha512-fw7f+TcMjTb7bpbLJZlP8g2Y4XcCyFZW8uy8HsRZsH/SwbMw0plKHFHr99DN3l04VsYNwvzicUX/6qurvIxbxw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./style.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/js/bootstrap.min.js" integrity="sha512-zKeerWHHuP3ar7kX2WKBSENzb+GJytFSBL6HrR2nPSR1kOX1qjm+oHooQtbDpDBSITgyl7QXZApvDfDWvKjkUw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

<header>
<div class="logo">
  <img src="./logo.png">
  <h1>HealthChecker</h1>
</div>
  <div class="mail_button" data-bs-toggle="modal" data-bs-target="#smtpModal">
    <i class="fa-solid fa-bell"></i>
  </div>
</header>

  <!-- FORM SERVICES -->
<div class="card container my-5 px-0">
  <h5 class="card-header">Disponibilité des services</h5>
  <div class="card-body">

  <form method="post" class="form-service" action="">
        <div>
          <input type="text" class="form-control" placeholder="Display Name" id="displayname" name="displayname">
        </div>
        <div>
          <input type="text" class="form-control" placeholder="IP/Domain" id="addr" name="addr">
        </div>
        <div>
          <input type="text" class="form-control" placeholder="Port" id="port" name="port">
        </div>
        <input type="submit" name="submit" class="btn btn-success" value="Ajouter">
  </form>

<?php
    if (!empty($services)) {
?>

  <!-- DISPLAY SERVICES -->
<div class="service-list">
<?php

      foreach ($services as $key => $element) {
        if(HealthCheck($element)){
?>

<div class="card card-up" style="width: 18rem;">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
        <h5 class="card-title"><?= $element['displayname'] ?></h5>
        <h6 class="card-subtitle mb-2 text-body-secondary"><?= $element['addr'].':'.$element['port'] ?></h6>
      </div>
      <div>
        <i class="fa-solid fa-check"></i>
      </div>
    </div>
    <a href="?remove_service=<?= $key ?>" class="card-link"><span class="badge text-bg-danger">retirer</span></a>
  </div>
</div>

<?php } else { ?>

<div class="card card-down" style="width: 18rem;">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
        <h5 class="card-title"><?= $element['displayname'] ?></h5>
        <h6 class="card-subtitle mb-2 text-body-secondary"><?= $element['addr'].':'.$element['port'] ?></h6>
      </div>
      <div>
        <i class="fa-solid fa-xmark"></i>
      </div>
    </div>
    <a href="?remove_service=<?= $key ?>" class="card-link"><span class="badge text-bg-danger">retirer</span></a>
  </div>
</div>

<?php } ?>

<?php
        }
      ?> </div> <?php
    }else {
      echo '<p class="none">Aucun service n\'a été rentré.</p>';
    }

?>

</div>
</div>

  <!-- FORM PORTALS -->

<div class="card container my-5 px-0">
  <h5 class="card-header">Portails de connexion</h5>
  <div class="card-body">

  <form method="post" class="form-service" action="">
        <div>
          <input type="text" class="form-control" placeholder="Portal Name" id="portalname" name="portalname">
        </div>
        <div>
          <input type="text" class="form-control" placeholder="URL" id="url" name="url">
        </div>
        <input type="submit" name="submit" class="btn btn-success" value="Ajouter">
  </form>

<?php

    if (!empty($portals)) {
?>
  <!-- DISPLAY PORTALS -->
<div class="portal-list container">

<?php
        foreach ($portals as $key => $element) {
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
        <h5 class="card-title"><?= $element['portalname'] ?></h5>
        <h6 class="card-subtitle mb-2 text-body-secondary"><?= $element['url'] ?></h6>
      </div>
      <div>
        <a href="<?= $element['url'] ?>" target="__blank"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
      </div>
    </div>
    <a href="?remove_portal=<?= $key ?>" class="card-link"><span class="badge text-bg-danger">Retirer</span></a>
  </div>
</div>

<?php
        }
?>
</div>
<?php
    }else {
      echo '<p class="none">Aucun portail n\'a été rentré.</p>';
    }

?>

</div>
</div>

  <!-- SMTP MODAL -->
  <form class="modal fade" id="smtpModal" tabindex="-1" aria-labelledby="smtpModalLabel" aria-hidden="true" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">SMTP settings</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <div class="mb-3">
              <label for="smtp_host" class="col-form-label">SMTP Host</label>
              <input name="smtp_host" type="text" class="form-control" id="smtp_host" value="<?= $smtp['smtp_host'] ?>">
            </div>
            <div class="mb-3">
              <label for="smtp_port" class="col-form-label">SMTP Port</label>
              <input type="text" name="smtp_port" class="form-control" id="smtp_port" value="<?= $smtp['smtp_port'] ?>">
            </div>
            <div class="mb-3">
              <label for="smtp_username" class="col-form-label">SMTP Username</label>
              <input type="text" class="form-control" id="smtp_username" name="smtp_username" value="<?= $smtp['smtp_username'] ?>">
            </div>
            <div class="mb-3">
              <label for="smtp_password" class="col-form-label">SMTP Password</label>
              <input type="password" class="form-control" id="smtp_password" name="smtp_password" value="<?= $smtp['smtp_password'] ?>">
            </div>
            <div class="mb-3">
              <label for="smtp_reciever" class="col-form-label">Notification's reciever</label>
              <input type="text" class="form-control" name="smtp_reciever" id="smtp_reciever" value="<?= $smtp['smtp_reciever'] ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update SMTP settings</button>
        </div>
      </div>
    </div>
  </form>
