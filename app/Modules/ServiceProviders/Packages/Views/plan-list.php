<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<?php helper('custom'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row"> 
                <?php if (!empty($plans)): ?>
                    <?php foreach ($plans as $plan): ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card plan-box">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5><?= $plan->plan_name; ?></h5>
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <h2><sup><small>$</small></sup> <?= $plan->plan_rate ?>/ <span class="font-size-13">Per year</span></h2>
                                    </div>
                                    <div class="plan-features mt-3">
                                        <p>
                                            <i class="bx bx-checkbox-square text-primary me-2"></i> <?= $plan->number_of_client; ?> 
                                        </p>
                                        <p>
                                            <i class="bx bx-checkbox-square text-primary me-2"></i> <?= sizeConverter($plan->storage_capacity, 'GB').' GB'; ?> Storage
                                        </p>
                                    </div>
                                    <div class="text-center plan-btn">
                                        <?php if (empty($currentPlan)): ?>
                                            <a href="<?= site_url('service-providers/packages/check-out/'.encrypt($plan->id)) ?>"  class="btn btn-primary btn-sm waves-effect waves-light"> Active</a>
                                        <?php elseif ($currentPlan->plan_id == $plan->id): ?>
                                            <a href="javascript:void(0)"  class="btn btn-primary btn-sm waves-effect waves-light"> Current Plan</a>
                                        <?php elseif ($currentPlan->plan_rate > $plan->plan_rate): ?>
                                            <a href="javascript:void(0)"  class="btn btn-danger btn-sm waves-effect waves-light"> Downgrade</a>
                                        <?php elseif ($currentPlan->plan_rate < $plan->plan_rate): ?>
                                            <a href="javascript:void(0)"  class="btn btn-success btn-sm waves-effect waves-light"> Upgrade</a>
                                        <?php endif ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div> <!-- container-fluid -->
    </div>
<?= $this->endSection() ?>