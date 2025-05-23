<div class="container" style="direction: ltr;">
    <div class="row box box-shadow p-t-1 p-b-1">
        <div class="col-xs-12">
            <h4>Users list</h4>
            <? if (Session::get('role') == 'admin') { ?>
                <table class="table table-bordered">
                    <?php
                    foreach ($this->userList as $key => $value) {
                        echo '<tr>';
                        echo '<td>' . $value['userid'] . '</td>';
                        echo '<td>' . $value['login'] . '</td>';
                        echo '<td>' . $value['role'] . '</td>';
                        echo '<td>
                <a href="' . URL . 'user/edit/' . $value['userid'] . '">Edit</a> 
                <a href="' . URL . 'user/delete/' . $value['userid'] . '">Delete</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <form method="post" action="<?php echo URL; ?>user/create" class="col-sm-4 box box-shadow p-t-1 p-b-1">
                <h4>Add new user.</h4>
                <div class="form-group">
                    <label class="form-control-label">Login</label>
                    <input class="form-control" type="text" name="login" />
                </div>
                <div class="form-group">
                    <label class="form-control-label">Password</label>
                    <input class="form-control" type="text" name="password" />
                </div>
                <div class="form-group">
                    <label class="form-control-label">Role</label>
                    <select class="form-control" name="role">
                        <option value="default">Default</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <label>&nbsp;</label><input class="btn btn-success" type="submit" />
            </form>
            <div class="col-sm-4"></div>


        <? } ?>
    </div>
</div>
