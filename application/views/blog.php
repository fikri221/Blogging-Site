<?php $this->load->view('partials/header'); ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?php echo base_url(); ?>assets/img/home2-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Selamat datang di Flazz.com</h1>
            <span class="subheading">Blog About Tech by Fikri Lazuardi</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

      <!-- Session -->
      <?php echo $this->session->flashdata('message'); ?>

      <!-- Pencarian -->
        <form method="get" class="form-inline active-cyan-3 active-cyan-4">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" name="search"
                aria-label="Search">
        </form>
        
        <?php foreach ($blog as $key => $blogs) : ?>
        <div class="post-preview">
          <a href="<?php echo site_url('blog/detail_artikel/'.$blogs['url']);?>">
            <h2 class="post-title">
                <h2>
                <?php echo $blogs['title']; ?></h2>
            </h2>
            </a>
            <?php $blogs['content'] = word_limiter($blogs['content'], 30); ?>
            <p class="post-subtitle"><?php echo $blogs['content'];?><br><br>
              <a href="<?php echo site_url('blog/detail_artikel/'.$blogs['url']);?>">
                <button class="btn btn-primary" type="submit">Read More</button></p>
              </a>    
          <p class="post-meta">Posted on <?php echo $blogs['date']; ?>
          <?php if(isset($_SESSION['username'])) : ?>
            <a href="<?php echo site_url('blog/edit/'.$blogs['id']); ?>">Edit</a>
            <a href="<?php echo site_url('blog/delete/'.$blogs['id']); ?>" onclick="return confirm('Apa kamu yakin ingin menghapus data tersebut?')">Hapus</a></p>
          <?php endif; ?>
        </div>
        <hr>
        <?php endforeach; ?> 
        <!-- Pager -->
        <!-- <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div> -->
        <?php echo $this->pagination->create_links(); ?>
      </div>
    </div>
  </div>

  <hr>

  <?php $this->load->view('partials/footer'); ?>