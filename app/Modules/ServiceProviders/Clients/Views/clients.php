<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="<?= site_url('service-providers/add-client') ?>" id="form-new-client">
                        <div class="card">
                            <div class="card-body">
                                <table  class=" basicDatatable table dataTable table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($lists)): $i = 1; ?>
                                            <?php foreach ($lists as $list): ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $list->name; ?></td>
                                                    <td><?= $list->email; ?></td>
                                                    <td><?= $list->phone; ?></td>
                                                    <td>
                                                        <a href="<?= site_url('service-providers/update-client/').encrypt($list->id) ?>" class="action-icon text-dark"> <i class="fas fa-edit font-size-18"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- load extra css and js -->
    <?= $this->section('css') ?>
        <link rel="stylesheet" href="<?= site_url('global/libs/intl-input/intlTelInput.min.css') ?>">
    <?= $this->endSection() ?>

    <?= $this->section('js') ?>
        <script src="<?= site_url('global/libs/intl-input/intlTelInput.min.js') ?>"></script>
        <script src="<?= site_url('service-provider/js/pages/save-client.init.js?v=').filemtime('service-provider/js/pages/save-client.init.js') ?>"></script>
    <?= $this->endSection() ?>

<?= $this->endSection() ?>