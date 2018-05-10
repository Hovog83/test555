<!DOCTYPE HTML>
<html>
  <head>
    <title>test</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
  
    <link rel="stylesheet" href="{{asset('/assets/front/assets/css/main.css')}}" />
  </head>
  <body>
  <header class="masthead">
  	<div class="boards-menu">
  		<div class="boards-btn btn">
        {{Auth::user()->code}}
  		</div>
  	</div>

  	<div class="logo">

  		<h1><i class="fa fa-hand-peace-o logo-icon"></i>Owl</h1>

  	</div>

  	<div class="user-settings">

  		<div class="user-settings-btn btn">
  			<i class="fas fa-plus"></i>
  		</div>

  		<div class="user-settings-btn btn">
  			<i class="fas fa-info-circle"></i>
  		</div>

  		<div class="user-settings-btn btn">
  			<i class="fas fa-bell"></i>
  		</div>

  		<div class="user-settings-btn btn">
  			<i class="fas fa-user-circle"></i>
  		</div>

  	</div>

  </header>