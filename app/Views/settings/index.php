<div class="row">
  <div class="col-12 col-md-8 offset-md-2">
    <div class="card">
      <div class="card-header">
        <h4>Pengaturan Sistem</h4>
      </div>
      <div class="card-body">
        <form action="<?= base_url('admin/settings/update') ?>" method="post">
          <?= csrf_field() ?>

          <div class="form-group">
            <label for="app_name">Nama Aplikasi</label>
            <input type="text" class="form-control" id="app_name" name="app_name" value="CI4 Shield RBAC">
          </div>

          <div class="form-group">
            <label for="app_description">Deskripsi Aplikasi</label>
            <textarea class="form-control" id="app_description" name="app_description" rows="3">Boilerplate CodeIgniter 4 dengan Shield RBAC</textarea>
          </div>

          <div class="form-group">
            <label for="default_role">Default Role untuk User Baru</label>
            <select class="form-control" id="default_role" name="default_role">
              <?php
                $authGroups = config('AuthGroups');
                foreach ($authGroups->groups as $key => $group):
              ?>
              <option value="<?= $key ?>" <?= $authGroups->defaultGroup === $key ? 'selected' : '' ?>>
                <?= esc($group['title']) ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Simpan Pengaturan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
