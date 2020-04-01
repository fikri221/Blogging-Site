<?php $this->load->view('partials/header'); ?>

<!-- Page Header -->
<header class="masthead" style="background-image: url('<?php echo base_url(); ?>assets/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Perubahan Artikel</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

        <h1>Ubah Artikel</h1><br>

        <div class="alert alert-warning">
          <?php echo validation_errors(); ?>
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Judul</label>
                <input class="form-control" type="text" name="title" value="<?php echo set_value('title', $blog['title']); ?>"> <br>
            </div>

            <div class="form-group">
                <label for="">URL</label>
                <input class="form-control" type="text" name="url" value="<?php echo set_value('url', $blog['url']); ?>"> <br>
            </div>
            
            <div class="form-group">
                <label for="">Konten</label>
                <textarea class="form-control ckeditor" name="content" id="" cols="30" rows="10">
                    <?php echo set_value('content', $blog['content']); ?>
                </textarea> <br>
            </div>

            <div class="form-group">
                <label for="">Cover</label>
                <input class="form-control" type="file" name="cover" value="<?php echo $blog['cover']; ?>"> <br>
            </div>
            
            <button class="btn btn-primary" type="submit">Ubah Artikel</button><br>
        </form>
        </div>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>