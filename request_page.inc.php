<?php

$title = 'CMS | Request To Be Content Contributor';
$page = 'request';

include 'components/header.php';
include 'components/footer.php';

?>
    <div class="section-invert pb-4">
        <div class="container">

            <h2 class="section-title mt-5 mb-3"> Request to be our content contributor</h2>
            <div class="underline mb-2"></div>

            <p> Please fill up the form below to request to be our content contributor.
                <br> We will contact you shortly through email about the status of application.
            </p>

            <!-- Form ! -->
            <div class="section py-5">
                <div class="container px-5">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h2 class="section-title mt-5 mb-3">Request Form</h2>
                            <div class="underline mb-4"></div>
                            <form class="form-request" action="request.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label for="fullName">Full name</label>
                                        <input type="text" class="form-control" name="fullName" placeholder="" value=""
                                               required>
                                        <div class="invalid-feedback">
                                            Please enter a valid full name.
                                        </div>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="" value=""
                                               required>
                                        <div class="invalid-feedback">
                                            Please enter a valid email.
                                        </div>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label for="organization">Name of Club/Societies/School/Department</label>
                                        <input type="text" class="form-control" name="organization"
                                               placeholder="Please state your name of organization" value="" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid organization.
                                        </div>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label for="reason">Reason of request</label>
                                        <input type="text" class="form-control" name="reason" placeholder="" value=""
                                               required>
                                        <div class="invalid-feedback">
                                            Please enter a valid reason.
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="custom-control custom-checkbox my-4">
                                        <input type="checkbox" class="custom-control-input" id="TC" required>
                                        <label class="custom-control-label" for="TC">I agree to the terms and conditions
                                            of using this service</label>
                                    </div>
                                        <div class="col-12">
                                            <input class="btn btn-small btn-primary btn-block" type="submit"
                                                   name="request"
                                                   style="border-radius: 16px; font-size:14px;" value="Send Request">
                                            </input>
                                            <i class="la la-bars"></i>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>