<?php $this->load->view('partials/header'); ?>

<!-- Page Header -->
<header class="masthead" style="background-image: url('<?php echo base_url(); ?>assets/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Log In</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>Sign In</h1><br>
        <form method="post" enctype="multipart/form-data"-- Session -->
            <div class="form-group">
                <label for="">Username</label>
                <input class="form-control" type="text" name="username">
            </div> <br>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="password" name="password">
            </div> <br>

            <button class="btn btn-primary" type="submit">Masuk</button><br>
        </form>
        </div>
    </div>
</div>

<hr>

<?php $this->load->view('partials/footer'); ?>