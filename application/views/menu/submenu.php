<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?> </h1>
	<br>
	<div class="row">
		<div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <?php if(validation_errors()): ?>
                    <?= validation_errors('<div class="alert alert-warning" role="alert">','</div>'); ?>
                    <?php endif; ?>
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal" >Create sub menu</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Url</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            <?php foreach($submenu as $item): ?>
                            <tr>
                                <th scope="row"><?= $no;  ?></th>
                                <td><?= $item['title']; ?></td>
                                <td><?= $item['menu']; ?></td>
                                <td><?= $item['url']; ?></td>
                                <td><?= $item['icon']; ?></td>
                                <td>
                                    <?php 
                                        if($item['is_active'] == 1){
                                            echo "<span class='badge badge-success' >Aktif</span>";
                                        }else{
                                            echo "<span class='badge badge-success' >Tidak Aktif</span>";
                                        }
                                    ?>
                                </td>
                                <td>
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
        <h5 class="modal-title" id="exampleModalLabel">Create menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Sub Menu Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Sub menu">
                    </div>
                    <div class="form-group">
                        <label for="">Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="" selected disabled>-- pilih --</option>
                            <?php foreach($menu as $itemMenu): ?>
                                <option value="<?= $itemMenu['id'] ?>"><?= $itemMenu['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Url</label>
                        <input type="text" class="form-control" name="url" id="url" placeholder="Sub menu">
                    </div>
                    <div class="form-group">
                        <label for="">Icon</label>
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked value="1" id="is_active" name="is_active">
                            <label class="form-check-label" for="defaultCheck1">
                                Active ?
                            </label>
                        </div>
                    </div>
                </div>
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