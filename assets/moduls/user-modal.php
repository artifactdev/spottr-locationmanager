<div id="user-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
    <h2>Users</h2>
      <form action="users" class="list-user" enctype='multipart/form-data'>
                <table class="userlist">
                    <thead>
                        <tr>
                            <td class="id">ID</td>
                            <td class="mail">E-Mail</td>
                            <td class="firstName">Vorname</td>
                            <td class="lastName">Nachname</td>
                            <td class="table-card">Kartenausschnitt</td>
                            <td class="roles">Rolle</td>

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
                                  <label for="email">E-Mail</label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input type="password" name="password" class="validate" required>
                                  <label for="password">Passwort</label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input id="firstname" type="text" name="firstname" required class="validate">
                                  <label for="firstname">Vorname</label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input id="lastname" type="text" name="lastname"  required class="validate">
                                  <label for="lastname">Nachname</label>
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
                                        <option value="1">Administrator</option>
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
                                <div class="input-field">
                                  <input id="email" type="email" name="email" placeholder="E-Mail" disabled class="validate">
                                  <label for="email">E-Mail</label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input type="password" name="password" placeholder="Passwort" class="validate" required>
                                  <label for="password">Passwort</label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input id="firstname" type="text" placeholder="Vorname" name="firstname" required class="validate">
                                  <label for="firstname">Vorname</label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input id="lastname" type="text" placeholder="Nachname" name="lastname"  required class="validate">
                                  <label for="lastname">Nachname</label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field">
                                  <input type="text"  id="geocomplete-karte-edit" placeholder="Kartenausschnitt" name="searchAddress" autocomplete="false">
                                </div>
                                <input id="lng" name="longitude" data-geo="lng" type="hidden" value="">
                                <input id="lat" name="latitude" data-geo="lat" type="hidden" value="">
                            </td>
                            <td>
                                <div class="input-field">
                                    <select multiple name="roles[]" placeholder="Userrole wählen" required>
                                        <option value="" disabled selected>Choose Userrole</option>
                                        <option value="1">Administrator</option>
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
        <button type="submit" class="btn btn-default btn-change-user pull-right hide">Nutzer ändern</button>
        <button type="submit" class="btn btn-default btn-add-user pull-right">Nutzer anlegen</button>
        <a href="#!" class="pull-left modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>

