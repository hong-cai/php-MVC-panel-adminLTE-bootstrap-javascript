<?php
require PRIVATE_PATH . '/views/inc/header.php';
?>
<div class="content-range">
    <!-- Edit & Delete a user -->
    <div class="col-12">
        <h2>Edit a user</h2>
        <?php echo flash('delete_user_success'); ?>
        <?php echo flash('delete_user_fail'); ?>
        <h4>Form: input diabled</h4>
        <form id="edit-users" action="<?php echo URL; ?>/users/editSave/
        " method="post" class="border px-3">
            <table class="table table-sm table-responsive-sm" id="user-info">
                <thead>
                    <tr class="overflow-scroll">
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">PASSWORD</th>
                        <th scope="col"> </th>
                        <th scope="col">EDIT</th>
                        <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
if (!empty($data['users'])) {
    foreach ($data['users'] as $user): ?>
                    <tr id="<?php echo $user->id; ?>" class=" my-auto">

                        <th scope="row"><span><?php echo $user->id ?></span></th>
                        <td class="data-edit py-2">
                            <input class="editInput" disabled type="text" value="<?php echo $user->name ?>" name="name"
                                form="edit-users" /></td>
                        <td class="data-edit py-2"><input class="editInput" disabled type="text"
                                value="<?php echo $user->status ?>" name="status" form="edit-users" /></td>
                        <td class="data-edit py-2"><input class="editInput" disabled type="text"
                                value="<?php echo $user->email ?>" name="email" form="edit-users" /></td>
                        <td class="data-edit py-2"><input class="editInput" disabled type="password"
                                value="<?php echo $user->password ?>" name="password" form="edit-users" /></td>
                        <td><input type="hidden" name="id" value="<?php echo $user->id; ?>" form="edit-users" />
                        </td>
                        <td><button class="edit-user btn btn-outline-primary" form="edit-users"
                                value="<?php echo $user->id ?>" id="<?php echo $user->id ?>">edit</button></td>
                        <td><a class="btn btn-outline-danger"
                                href="<?php echo URL; ?>/users/delete/<?php echo $user->id ?>"
                                id="<?php echo $user->id ?>">delete</a></td>
                    </tr>
                    <?php endforeach;
}?>
                </tbody>
            </table>
        </form>
    </div>


    <div class="col-12">
        <h4>Table: switch between span and input</h4>
        <?php echo flash('delete_user_success') ;?>
        <?php echo flash('delete_user_fail') ;?>
        <div class="row">
            <div class="panel panel-default users-content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="userData">
                        <?php if (!empty($data['users'])): foreach ($data['users'] as $user): ;?>
                        <tr id="<?php echo $user->id; ?>">

                            <td><?php echo $user->id; ?></td>
                            <td>
                                <span class="editSpan name"><?php echo $user->name; ?></span>
                                <input class="editInput email form-control input-sm" type="text" name="name"
                                    value="<?php echo $user->name; ?>" style="display: none;">
                            </td>
                            <td>
                                <span class="editSpan email"><?php echo $user->email; ?></span>
                                <input class="editInput email form-control input-sm" type="text" name="email"
                                    value="<?php echo $user->email; ?>" style="display: none;">
                            </td>
                            <td>
                                <span class="editSpan role"><?php echo $user->status; ?></span>
                                <input class="editInput role form-control input-sm" type="text" name="status"
                                    value="<?php echo $user->status; ?>" style="display: none;">
                            </td>
                            <td>
                                <span class="editSpan password">******<?php // echo $user['password_hash']; ?></span>
                                <input class="editInput password form-control input-sm" type="password" name="password"
                                    value="<?php echo $user->password; ?>" style="display: none;">
                            </td>

                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-sm btn-default editBtn"
                                        style="float: none;"><span class="fa fa-pencil"></span></button>
                                    <button type="button" class="btn btn-sm btn-success saveBtn"
                                        style="float: none; display: none;">Save</button>
                                    <button type="button" class="btn btn-sm btn-default deleteBtn"
                                        style="float: none;"><span class="fa fa-trash"></span></button>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger confirmBtn"
                                    style="float: none; display: none;">Confirm</button>
                            </td>
                        </tr>
                        <?php endforeach;else: ?>
                        <tr>
                            <td colspan="5">No user(s) found......</td>
                        </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
<?php
require PRIVATE_PATH . '/views/inc/footer.php';
?>