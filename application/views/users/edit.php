<div class="container-fluid">
    <div class="h3 mb-4 text-gray-800"><?= $title; ?></div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <?= form_open_multipart('user/edit'); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Input email">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>