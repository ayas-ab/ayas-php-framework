<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <base href="/<?php if(!empty($data['directory'])) echo $data['directory'].'/'; ?>">
<link rel="icon" href="favicon.png" sizes="32x32" type="image/png">
<title><?php echo $data['page_title']; ?></title>
<meta name="description" content="<?php echo $data['description']; ?>">
<meta name="robots" content="index, follow">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!-- Bootstrap -->
<link href="https://fonts.googleapis.com/css?family=Libre+Franklin:100,200,300,400,500,700" rel="stylesheet">
<link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/lib/sweetalert2-8.11.1/sweetalert2.css"> 
<style>
<!-- This is to solve the problem for google maps auotcomplete location not working inside bootstrap modals -->
    .pac-container {
    z-index: 100000;
}

body {
  padding-top: 56px;
}

</style>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/lib/jquery-v3.4.1.min.js"></script>
</head>