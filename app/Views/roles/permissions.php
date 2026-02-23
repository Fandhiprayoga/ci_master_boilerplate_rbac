<h2 class="section-title">Permission Matrix</h2>
<p class="section-lead">
  Tabel berikut menampilkan permission yang dimiliki setiap role dalam sistem.
</p>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Matrix Permission per Role</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Permission</th>
                <th>Deskripsi</th>
                <?php foreach ($groups as $key => $group): ?>
                <th class="text-center"><?= esc($group['title']) ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($permissions as $permKey => $permDesc): ?>
              <tr>
                <td><code><?= esc($permKey) ?></code></td>
                <td><?= esc($permDesc) ?></td>
                <?php foreach ($groups as $groupKey => $group): ?>
                <td class="text-center">
                  <?php
                    $hasPermission = false;
                    if (isset($matrix[$groupKey])) {
                      foreach ($matrix[$groupKey] as $matrixPerm) {
                        // Cek exact match atau wildcard
                        if ($matrixPerm === $permKey) {
                          $hasPermission = true;
                          break;
                        }
                        // Cek wildcard (e.g., admin.* matches admin.access)
                        if (str_contains($matrixPerm, '*')) {
                          $prefix = str_replace('*', '', $matrixPerm);
                          if (str_starts_with($permKey, $prefix)) {
                            $hasPermission = true;
                            break;
                          }
                        }
                      }
                    }
                  ?>
                  <?php if ($hasPermission): ?>
                    <span class="badge badge-success"><i class="fas fa-check"></i></span>
                  <?php else: ?>
                    <span class="badge badge-light"><i class="fas fa-times"></i></span>
                  <?php endif; ?>
                </td>
                <?php endforeach; ?>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
