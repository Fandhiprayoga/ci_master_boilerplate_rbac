<div class="row">
  <div class="col-12 col-md-8 offset-md-2">
    <div class="card">
      <div class="card-header">
        <h4>Edit User: <?= esc($user_edit->username) ?></h4>
      </div>
      <div class="card-body">
        <form action="<?= base_url('admin/users/update/' . $user_edit->id) ?>" method="post">
          <?= csrf_field() ?>

          <div class="form-group">
            <label for="username">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username" name="username"
                   value="<?= old('username', $user_edit->username) ?>" required>
          </div>

          <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= old('email', $user_edit->email) ?>" required>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter.</small>
          </div>

          <?php if (auth()->user()->can('users.manage-roles')): ?>
          <div class="form-group">
            <label for="group">Role</label>
            <select class="form-control" id="group" name="group">
              <option value="">-- Pilih Role --</option>
              <?php foreach ($groups as $key => $group): ?>
                <option value="<?= $key ?>" <?= in_array($key, $userGroups) ? 'selected' : '' ?>>
                  <?= esc($group['title']) ?> - <?= esc($group['description']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <?php endif; ?>

          <div class="form-group text-right">
            <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary mr-1">Batal</a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Perbarui
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
