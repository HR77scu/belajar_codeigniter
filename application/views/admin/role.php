<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?> </h1>
	<br>
	<div class="row">
		<div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <?= validation_errors('<div class="alert alert-warning" role="alert">','</div>'); ?>
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal" >Create role</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            <?php foreach($role as $item): ?>
                            <tr>
                                <th scope="row"><?= $no;  ?></th>
                                <td><?= $item['role']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/roleaccess/').$item['id']; ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-universal-access"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url(); ?>" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <div class="form-group">
                <label for="">Role</label>
                <input type="text" placeholder="Input Role" id="role" name="role" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>