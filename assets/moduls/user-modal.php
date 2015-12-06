<div id="user-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
    <h2>Users</h2>
      <form action="users" class="list-user" enctype='multipart/form-data'>
                <table class="userlist">
                    <thead>
                        <tr>
                            <td class="id">ID</td>
                            <td class="mail"><?php echo "$email" ?></td>
                            <td class="firstName"><?php echo "$firstname" ?></td>
                            <td class="lastName"><?php echo "$lastname" ?></td>
                            <td class="table-card"><?php echo "$cardview" ?></td>
                            <td class="roles"><?php echo "$role" ?></td>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </form>
            <form action="users" id="user-form" class="add-user" enctype='multipart/form-data'>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <input id="id" type="hidden" name="id"/>
                                <div class="input-field">
                                  <input id="email" type="email" name="email" class="validate">
                                  <label for="email"><?php echo "$email" ?></label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input type="password" name="password" class="validate" required>
                                  <label for="password"><?php echo "$password" ?></label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input id="firstname" type="text" name="firstname" required class="validate">
                                  <label for="firstname"><?php echo "$firstname" ?></label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input id="lastname" type="text" name="lastname"  required class="validate">
                                  <label for="lastname"><?php echo "$lastname" ?></label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input type="text" id="geocomplete-karte" name="searchAddress" autocomplete="false">
                                </div>
                                <input id="lng" name="longitude" data-geo="lng" type="hidden" value="">
                                <input id="lat" name="latitude" data-geo="lat" type="hidden" value="">
                            </td>
                            <td>
                                <div class="input-field">
                                    <select multiple name="roles[]" required>
                                        <option value="" disabled selected></option>
                                        <option value="1"><?php echo "$admin" ?></option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                    <tbody>

                    </tbody>
                </table>
            </form>
            <form action="users" id="edit-user-form" class="edit-user hide" enctype='multipart/form-data'>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <input type="hidden" id="idEdit">
                                <div class="input-field">
                                  <input id="emailEdit" type="email" name="email" placeholder="<?php echo "$email" ?>" disabled class="validate">
                                  <label for="email"><?php echo "$email" ?></label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input type="password" name="password" placeholder="<?php echo "$password" ?>" class="validate" required>
                                  <label for="password"><?php echo "$password" ?></label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input id="firstnameEdit" type="text" placeholder="<?php echo "$firstname" ?>" name="firstname" required class="validate">
                                  <label for="firstname"><?php echo "$firstname" ?></label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input id="lastnameEdit" type="text" placeholder="<?php echo "$lastname" ?>" name="lastname"  required class="validate">
                                  <label for="lastname"><?php echo "$lastname" ?></label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input type="text"  id="geocomplete-karte-edit" placeholder="<?php echo "$cardview" ?>" name="searchAddress" autocomplete="false">
                                </div>
                                <input id="lngEdit" name="longitude" data-geo="lng" type="hidden" value="">
                                <input id="latEdit" name="latitude" data-geo="lat" type="hidden" value="">
                            </td>
                            <td>
                                <div class="input-field">
                                    <select multiple name="roles[]" placeholder="Userrole wählen" required>
                                        <option value="" disabled selected>Choose Userrole</option>
                                        <option value="1"><?php echo "$admin" ?></option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                    <tbody>

                    </tbody>
                </table>
            </form>

    </div>
    <div class="clearfix"></div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-default btn-change-user pull-right hide"><?php echo "$editUser" ?></button>
        <button type="submit" class="btn btn-default btn-add-user pull-right"><?php echo "$saveUser" ?></button>
        <a href="#!" class="pull-left modal-action modal-<?php echo "$close" ?> waves-effect waves-green btn-flat"><?php echo "$close" ?></a>
    </div>
  </div>

