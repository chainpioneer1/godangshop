

    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">

            <?php $success = $this->session->flashdata("success");?>
            <?php if( !empty( $success ) ) : ?>
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                    <?= $success ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="form-group col-lg-offset-1 col-lg-5 col-md-offset-1 col-md-5 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                    <h2 style="margin-top: 54px; margin-bottom: 25px;color: #333;"></h2>

                    <form action="<?= base_url('contactus/send_message')?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="contact_user_name"><?=$this->lang->line('name');?></label>
                                    <input type="text" required class="form-control" id="contact_user_name" name="contact_user_name">
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="contact_user_email"><?=$this->lang->line('email');?></label>
                                    <input type="email" required class="form-control" id="contact_user_email" name="contact_user_email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact_title"><?=$this->lang->line('title');?></label>
                            <input type="text" required class="form-control" id="contact_title" name="contact_title">
                        </div>
                        <div class="form-group">
                            <label for="contact_content"><?=$this->lang->line('content');?></label>
                            <textarea required class="form-control" id="contact_content" rows="5" name="contact_content"></textarea>
                        </div>

                        <div class="form-group">
                            <button  style="width: 100%; " class="form-control btn btn-warning" type="submit" id="send_message" name="send_message"><?=$this->lang->line('send_message');?></button>
                        </div>
                    </form>


                </div>
                <div class="col-lg-offset-1 col-lg-5 col-md-offset-1 col-md-5 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                    <h2 style="margin-top: 54px; margin-bottom: 25px;color: #333;"><?php echo($this->lang->line('contact_information'));?></h2>
                    <ul class="contact-us-information">
                        <li id="address"><b><?=$this->lang->line('address');?></b>:<?php echo $contactus_data->address1;?></li>
                        <li id="address"><?php echo $contactus_data->address2;?></li>
                        <li id="tel"><b><?=$this->lang->line('tel');?></b>:<?php echo $contactus_data->tel; ?></li>
                        <li id="fax"><b><?=$this->lang->line('fax');?></b>: <?php echo $contactus_data->fax; ?></li>
                        <li id="email"><b><?=$this->lang->line('email');?></b>: <?php echo $contactus_data->email; ?></li>
                        <li id="line_id"><b><?=$this->lang->line('line_id');?></b>: <?php echo $contactus_data->line_id; ?></li>
                        <li id="google_mail"><b><?=$this->lang->line('google');?></b>: <?php echo $contactus_data->google; ?></li>
                        <li id="facebook"><b><?=$this->lang->line('facebook');?></b>: <?php echo $contactus_data->facebook; ?></li>
                    </ul>
                </div>

            </div>
            <div class="row">
                <div id="map" style="width: 100% ; height: 300px; margin-bottom: 100px; "></div>
                <script>
                    function initMap() {
                        var x = '<?php echo $contactus_data->location_x; ?>';
                        var y = '<?php echo $contactus_data->location_y; ?>';
                        x = parseFloat(x);
                        y = parseFloat(y);
                        var uluru = {lat: x, lng: y};
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 10,
                            center: uluru
                        });
                        var marker = new google.maps.Marker({
                            position: uluru,
                            map: map
                        });
                    }
                </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdVKYxAmZxcYOMuvR_GStm6F6KIJxk54k&callback=initMap">
                </script>
            </div>

        </div>
    </div>
</div>