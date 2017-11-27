<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('layout/head') ?>
</head>
<body class="hold-transition login-page">

<?php $this->load->view('layout/top_menu')?>
  
<div class="login-box">
  <div class="login-logo">
    <a href="base_url()"><b>SISFO</b>ASET</a>
  </div>
  <!-- /.login-logo -->

  <div class="login-box-body">
    <p class="login-box-msg">LOGIN </p>

    <?=form_open('auth/login')?>
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->

    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php $this->load->view('layout/foot2')?>
</body>
</html>
