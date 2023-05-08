<div class="container-fluid">
    <div class="h3 mb-4 text-gray-800"><?= $title; ?></div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <form action="<?= base_url('users/changepassword'); ?>" enctype="multipart/form-data" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Current Password</label>
                                    <input type="password" name="current_password" id="current_password" class="form-control">
                                    <?= form_error('current_password','<span class="badge badge-danger">','</span>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="text" class="form-control" id="new_password1" name="new_password1">
                                    <?= form_error('new_password1','<span class="badge badge-danger">','</span>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Repeat Password</label>
                                    <input type="text" class="form-control" id="new_password2" name="new_password2">
                                    <?= form_error('new_password2','<span class="badge badge-danger">','</span>') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-block btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>