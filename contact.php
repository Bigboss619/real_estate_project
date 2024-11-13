<?php require_once('header.php'); ?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/banner.jpg);">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Contact Us</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact-form">
                        <form action="<?php echo BASE_URL; ?>ajax-contact.php" method="POST" class="form_contact">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email Address</label>
                                <input name="email" type="text" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Message</label>
                                <textarea class="form-control" rows="3" name="message"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799198932!2d-74.25987701513004!3d40.69767006272707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1645362221879!5m2!1sen!2sbd" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    (function($){
        "use strict";
        $(document).ready(function(){
            $('.form_contact').on('submit', function(e){
                e.preventDefault();
                let formData = new FormData(this);
                let form = this;

                $.ajax({
                    url: this.action,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        try {
                            // Attempt to parse the response as JSON
                            let data = JSON.parse(response);

                            if (data.error_message) {
                                iziToast.show({
                                message: data.error_message,
                                position: 'topRight',
                                color: 'red'
                                });
                            } else {
                                form.reset();
                                iziToast.show({
                                message: data.success_message,
                                position: 'topRight',
                                color: 'green'
                                });
                            }
                        } catch (error) {
                            console.error('Error parsing JSON response:', error);
                            alert("An unexpected error occurred. Please try again.");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle the case when the AJAX request fails
                        console.error('AJAX error:', textStatus, errorThrown);
                        alert('There was a problem with the request. Please try again later.');
                    }
                });
            });
        });
    })(jQuery);
</script>
<?php require_once('footer.php'); ?>