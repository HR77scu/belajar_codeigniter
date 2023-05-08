<div class="container-fluid">
    <div class="h3 mb-4 text-gray-800"><?= $title; ?></div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <?php if(validation_errors()): ?>
                <?= validation_errors('<div class="alert alert-warning" role="alert">','</div>'); ?>
                <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= form_open_multipart('users/edit'); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Input email" value="<?= $user['email'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Input name" value="<?= $user['name'] ?>">
                                <?= form_error('name','<span class="badge badge-danger">','</span>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">Picture</div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/admin/img/').$user['image']; ?>" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="Image">Choose image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary float-right">Save Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>