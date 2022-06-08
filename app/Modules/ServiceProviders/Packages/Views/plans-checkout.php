<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<?php helper('custom'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Payment information</h4>
                            <p class="card-title-desc">Fill all information below</p>
                            <form id="checkout-form" action="<?= site_url('service-providers/packages/check-out') ?>">
                                <div class="form-check form-check-inline font-size-16">
                                    <input class="form-check-input" type="radio" name="via" id="paymentoptionsRadio1" checked value="1">
                                    <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><i class="fab fa-cc-mastercard me-1 font-size-20 align-top"></i> Credit / Debit Card</label>
                                </div>
                                <div class="form-check form-check-inline font-size-16">
                                    <input class="form-check-input" type="radio" name="via" id="paymentoptionsRadio2" value="2">
                                    <label class="form-check-label font-size-13" for="paymentoptionsRadio2"><i class="fab fa-cc-paypal me-1 font-size-20 align-top"></i> Paypal</label>
                                </div>
                                <div class="form-check form-check-inline font-size-16">
                                    <input class="form-check-input" type="radio" name="via" id="paymentoptionsRadio3" value="3">
                                    <label class="form-check-label font-size-13" for="paymentoptionsRadio3"><i class="far fa-money-bill-alt me-1 font-size-20 align-top"></i> Cash on Delivery</label>
                                </div>

                                <h5 class="mt-5 mb-3 font-size-15">For card Payment</h5>
                                <div class="p-4 border">
                                    <div class="form-group mb-0">
                                        <label for="card_number" name="">Card Number</label>
                                        <input type="text" class="form-control" id="card_number" name="card_number" placeholder="0000 0000 0000 0000">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mt-4 mb-0">
                                                <label for="cardnameInput">Name on card</label>
                                                <input type="text" class="form-control" id="cardnameInput" placeholder="Name on Card">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mt-4 mb-0">
                                                <label for="expiry_date">Expiry date</label>
                                                <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mt-4 mb-0">
                                                <label for="cvv">CVV Code</label>
                                                <input type="text" class="form-control numbers" name="cvv" id="cvv" placeholder="Enter CVV Code" maxlength="3">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="text-end">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="plan_id" value="<?= encrypt($details->id); ?>">
                                            <button class="btn btn-success" type="submit">Proceed</button>
                                        </div>
                                    </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= site_url('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') ?>"></script>
    <script src="<?= site_url('service-provider/js/pages/package-check-out.init.js?v=').filemtime('service-provider/js/pages/package-check-out.init.js') ?>"></script>
    <?= $this->endSection() ?>