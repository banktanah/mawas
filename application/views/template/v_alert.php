                <div style="margin-top: 45px; margin-bottom: -50px;">
                    <?php if($this->session->flashdata('success')){ ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" style="text-decoration:none; color: white;" data-dismiss="alert">&times;</a>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                        </div>

                    <?php } else if($this->session->flashdata('error')){  ?>

                        <div class="alert alert-danger">
                            <a href="#" class="close" style="text-decoration:none; color: white;" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                        </div>

                    <?php } ?>
                </div>