<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row"> 
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
                                    <a href="javascript:void(0)" data-edit="<?= $plan->id ?>" class="btn btn-primary btn-sm waves-effect waves-light editPlans"><i class="dripicons-document-edit bx font-size-12 align-middle"></i>  Modify</a> &nbsp
                                    <a href="javascript: void(0);" data-delete="<?= $plan->id; ?>"  class="btn btn-danger btn-sm waves-effect waves-light deletePlan"><i class="dripicons-trash bx font-size-12 align-middle"></i>&nbsp Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div> <!-- container-fluid -->
    </div>

    <div class="offcanvas offcanvas-end canvas-50" tabindex="-1" id="planCanvas" aria-labelledby="offcanvasRightLabel" style="visibility: visible;" aria-modal="true" role="dialog">
            <div class="offcanvas-header">
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
               <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">New Plan</h4><hr>
                            <form id="defaultForm" action="<?= site_url('admin/plan/add-plan'.(empty($details)?'':'/'.$details->id)) ?>">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="plan_name">Plan Name <span class="text-danger">*</span></label>
                                            <input id="plan_name" name="plan_name" type="text" class="form-control char" placeholder="Plan Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="number_of_client">Number of Clients <span class="text-danger">*</span></label>
                                            <input id="number_of_client" name="number_of_client" type="text" class="form-control numbers" placeholder="Number of Client">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="storage_capacity">Storage Capacity <span class="text-danger">*</span></label>
                                            <input id="storage_capacity" name="storage_capacity" type="text" class="form-control decimal" placeholder="Storage Capacity">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="storage_capacity">Plan Rate <span class="text-danger">*</span></label>
                                            <input id="plan_rate" name="plan_rate" type="text" class="form-control numbers" placeholder="Plan Rate">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2" id="btn-holder">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="defaultBtn"><i class="dripicons-plus bx font-size-16 align-middle"></i> Save Plan</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
<?= $this->endSection() ?>