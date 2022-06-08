<p>Thank you for signing up on <?= base_url() ?>!</p>

<p>Please click the following link to activate your account!</p>
<p><a href="<?= site_url('service-providers/activate-account') . '?token=' . $hash ?>"><?=  site_url('service-providers/activate-account') . '?token=' . $hash ?></a></p>

<p>If you didn't register on this website, just ignore this email.</p>