<?php

// add new service to healthcheck
if(isset($_POST['displayname'])){

  $elem = ['displayname' => $_POST['displayname'], 'addr' => $_POST['addr'], 'port' => $_POST['port']];
  array_push($services, $elem);
  file_put_contents('/app/services.json', json_encode($services));
}

// add new portal
if(isset($_POST['portalname'])){

  $elem = ['portalname' => $_POST['portalname'], 'url' => $_POST['url']];
  array_push($portals, $elem);
  file_put_contents('/app/portals.json', json_encode($portals));
}

// edit smtp
if(isset($_POST['smtp_host'])){

  $smtp = ['smtp_username' => $_POST['smtp_username'], 'smtp_password' => $_POST['smtp_password'], 'smtp_host' => $_POST['smtp_host'], 'smtp_port' => $_POST['smtp_port'], 'smtp_reciever' => $_POST['smtp_reciever']];
  file_put_contents('/app/smtp.json', json_encode($smtp));
}

// remove service
if(isset($_GET['remove_service'])){

  if (array_key_exists(intval($_GET['remove_service']), $services)) {
    unset($services[intval($_GET['remove_service'])]);
    $services = array_values($services);
    file_put_contents('/app/services.json', json_encode($services));
    header("Location: ".$_SERVER['PHP_SELF']);
  }
}

//remove portal
if(isset($_GET['remove_portal'])){

  if (array_key_exists(intval($_GET['remove_portal']), $portals)) {
    unset($portals[intval($_GET['remove_portal'])]);
    $portals = array_values($portals);
    file_put_contents('/app/portals.json', json_encode($portals));
    header("Location: ".$_SERVER['PHP_SELF']);
  }
}


