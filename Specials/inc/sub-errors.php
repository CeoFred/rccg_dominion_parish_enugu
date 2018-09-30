
<?php if(isset($_SESSION['sub_error'])){ ?>
  <div class="alert alert-danger animated tada alert-dismissible"
   style="text-align: center;font-size:2.0em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 100%;
  height: 400px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close"
   style="font-size: 30px;color: black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-down" style="font-size: 170px;"></i>
  <br>
  <?php echo $_SESSION['sub_error'];unset($_SESSION['sub_error']); ?>
  <div class="alert alert-footer fixed bottom" style="text-align: center;">Powered by Do-media</div>
  </div>
  <?php
  }
  ?>

<?php if(isset($_SESSION['sub_success'])){ ?>
  <div class="alert alert-success animated tada alert-dismissible" style="text-align: center;font-size:2.0em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 100%;
  height: 400px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 30px;color: black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-up" style="font-size: 70px;"></i>
  <br>
  <?php echo $_SESSION['sub_success'];unset($_SESSION['sub_success']); ?>
  <div class="alert alert-footer fixed bottom" style="text-align: center;">Powered by Do-media</div>
  </div>
  <?php
  }
  ?>
  <!-- Prayer request errors and success message -->
  <?php if(isset($_SESSION['prayer_success'])){ ?>
  <div class="alert alert-success animated tada alert-dismissible" style="text-align: center;font-size:1.0em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 100%;
  height: 400px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 20px;color: black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-up" style="font-size: 70px;"></i>
  <br>
  <?php echo $_SESSION['prayer_success'];unset($_SESSION['prayer_success']); ?>
  </div>
  <?php
  }
  ?>

<?php if(isset($_SESSION['prayer_error'])){ ?>
  <div class="alert alert-danger animated tada alert-dismissible"
   style="text-align: center;font-size:2.0em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 100%;
  height: 400px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close"
   style="font-size:20px;color:black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-down" style="font-size: 170px;"></i>
  <br>
  <?php echo $_SESSION['prayer_error'];unset($_SESSION['prayer_error']); ?>
  <div class="alert alert-footer fixed bottom" style="text-align: center;">Powered by Do-media</div>
  </div>
  <?php
  }
  ?>

  <!-- Prayer request errors and success message -->


<?php if(isset($_SESSION['add_error'])){ ?>
  <div class="alert alert-danger animated tada alert-dismissible"
   style="text-align: center;font-size:1.5em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 50%;
  height: 200px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close"
   style="font-size:20px;color:black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-down" style="font-size:70px;color:red;"></i>
  <br>
  <?php echo $_SESSION['add_error'];unset($_SESSION['add_error']); ?>
  </div>
  <?php
  }
  ?>



<?php if(isset($_SESSION['add_success'])){ ?>
  <div class="alert alert-success animated tada alert-dismissible"
   style="text-align: center;font-size:1.5em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 50%;
  height: 300px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close"
   style="font-size:20px;color:black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-up" style="font-size:70px;"></i>
  <br>
  <?php echo $_SESSION['add_success'];unset($_SESSION['add_success']); ?>
  </div>
  <?php
  }
  ?>


<?php if(isset($_SESSION['access_error'])){ ?>
  <div class="alert alert-danger animated tada alert-dismissible"
   style="text-align: center;font-size:1.5em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 50%;
  height: 390px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close"
   style="font-size:20px;color:black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-down" style="font-size:70px;"></i>
  <br>
  <?php echo $_SESSION['access_error'];unset($_SESSION['access_error']); ?>
  </div>
  <?php
  }
  ?>


<?php if(isset($_SESSION['reply_success'])){ ?>
  <div class="alert alert-success animated tada alert-dismissible"
   style="text-align: center;font-size:2.0em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 50%;
  height: 350px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close"
   style="font-size: 30px;color: black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-up" style="font-size: 170px;"></i>
 
  <?php echo $_SESSION['reply_success'];unset($_SESSION['reply_success']); ?>
  </div>
  <?php
  }
  ?>


<?php if(isset($_SESSION['reply_error'])){ ?>
  <div class="alert alert-success animated tada alert-dismissible"
   style="text-align: center;font-size:2.0em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 50%;
  height: 350px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close"
   style="font-size: 30px;color: black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-up" style="font-size: 170px;"></i>
 
  <?php echo $_SESSION['reply_error'];unset($_SESSION['reply_error']); ?>
  </div>
  <?php
  }
  ?>