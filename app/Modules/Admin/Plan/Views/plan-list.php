<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row"><!-- start page title -->
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><?= $title ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Plan</a></li>
                                <li class="breadcrumb-item active">Plans</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div><!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                <a class="btn btn-dark waves-effect waves-light" href="#" role="button"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Plan Information</h4><hr>
                            <form id="defaultForm" action="<?= site_url('admin/plan/add-plan'.(empty($details)?'':'/'.$details->id)) ?>">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="plan_name">Plan Name <span class="text-danger">*</span></label>
                                            <input id="plan_name" name="plan_name" type="text" class="form-control char" placeholder="Plan Name" value="<?= empty($details)?'':$details->plan_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="number_of_client">Number of Clients <span class="text-danger">*</span></label>
                                            <input id="number_of_client" name="number_of_client" type="text" class="form-control numbers" placeholder="Number of Client" value="<?= empty($details)?'':$details->number_of_client; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="storage_capacity">Storage Capacity <span class="text-danger">*</span></label>
                                            <input id="storage_capacity" name="storage_capacity" type="text" class="form-control decimal" placeholder="Storage Capacity" value="<?= empty($details)?'':sizeConverter($details->storage_capacity, 'GB') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2" id="btn-holder">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="defaultBtn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <h4 class="card-title">Plan List</h4><hr>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th width="70%">Plan Name</th>
                                            <th>Clients</th>
                                            <th>Storage</th>
                                            <th width="1%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($plans)): $i = 1; ?>
                                            <?php foreach ($plans as $plan): ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $plan->plan_name; ?></td>
                                                    <td><?= $plan->number_of_client; ?></td>
                                                    <td><?= sizeConverter($plan->storage_capacity, 'GB').' GB'; ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                                <li><a href="<?= site_url('admin/plan/').$plan->id; ?>" class="dropdown-item"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>
                                                                <li><a href="javascript:void(0)" data-delete="<?= $plan->id; ?>" class="dropdown-item deletePlan"><i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
<?= $this->endSection() ?>