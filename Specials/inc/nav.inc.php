<?php

if (isset($_SESSION['email'])) {
  echo '<nav class="navbar fixed-top navbar-expand-lg navbar-light green scrolling-navbar">
    <div class="container-fluid">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="index">
        <img src="images/logo.png" height="45">
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="donate">Donate 
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link waves-effect" href="dominion-trumpet" target="_blank">Dominion Trumpet </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="prayer-request" target="_blank">Prayer Request </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="forum" target="_blank">Forums </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="gallery" target="_blank">Gallery </a>
          </li>


          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Connect
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="e-invite">E-invite</a>
          <a class="dropdown-item" href="social">Social</a>

          <a class="dropdown-item" href="contact">Contact</a>
                  <a class="dropdown-item" href="ask-the-pastor">Ask The Pastor</a>
                            <a class="dropdown-item" href="suggestions">Suggestions</a>
        </div>
      </li>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Quick Links
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="downloads">Downloads</a>
          <a class="dropdown-item" href="forms">Forms</a>
                  <a class="dropdown-item" href="quiz">Quiz</a>
                            <a class="dropdown-item" href="games">Games</a>
        </div>
      </li>

        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          
      <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form>
          <li class="nav-item">
         <a href="inc/logout" class="btn btn-success">Logout</a>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
';
}
else{
  echo '<nav class="navbar fixed-top navbar-expand-lg navbar-light green scrolling-navbar">
    <div class="container-fluid">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="index">
        <img src="images/logo.png" height="45">
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="donate">Donate 
             
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link waves-effect" href="dominion-trumpet" target="_blank">Dominion Trumpet </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="prayer-request" target="_blank">Prayer Request </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="forum" target="_blank">Forums </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="gallery" target="_blank">Gallery </a>
          </li>


          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Connect
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="e-invite">E-invite</a>
          <a class="dropdown-item" href="social">Social</a>

          <a class="dropdown-item" href="contact">Contact</a>
                  <a class="dropdown-item" href="ask-the-pastor">Ask The Pastor</a>
                            <a class="dropdown-item" href="Suggestions">Suggestions</a>
        </div>
      </li>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Quick Links
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="downloads">Downlaods</a>
          <a class="dropdown-item" href="forms">Forms</a>
                  <a class="dropdown-item" href="quiz">Quiz</a>
                            <a class="dropdown-item" href="games">Games</a>
        </div>
      </li>

        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
          <a class="btn btn-outline-danger" href="index">Login</a>
         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Join Us
</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
';
}
?>

  <!-- Navbar -->
  