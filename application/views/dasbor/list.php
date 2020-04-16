
<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
<div class="row">
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
        <div class="leftbar p-r-20 p-r-0-sm">
            
        <?php include('menu.php') ?>
           
        </div>
    </div>

    <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
       

        <!-- Product -->
       
                <?php if ($this->session->flashdata('warning')) { ?>
                    <div class="alert alert-danger">
                  <?php   echo $this->session->flashdata('warning'); ?>
                   </div>
                   <?php  } ?>
      
            <div class="alert alert-success">
               <marquee><h2>Selamat Datang <i><strong><?= $this->session->userdata('nama_pelanggan') ?>
            </strong></i></h2></marquee> 
            </div>
           

            <div class="calendar"></div>
            <div class="box"></div>
           
       
    </div>
</div>
</div>
</section>