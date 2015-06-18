<div id="user-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Users</h2>
        <div class="modal-body">
            <form action="users" class="list-user" enctype='multipart/form-data'>
                <table class="userlist">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>E-Mail</td>
                            <td>Vorname</td>
                            <td>Nachname</td>
                            <td>Kartenausschnitt</td>
                            <td>Rolle</td>

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
                            <td><input type="email" name="email" placeholder="E-Mail" required/></td>
                            <td><input type="password" name="password" placeholder="Passwort" required/></td>
                            <td><input type="text" name="firstname" placeholder="Vorname" required/></td>
                            <td><input type="text" name="lastname" placeholder="Nachname" required/></td>
                            <td>
                                <input type="text"  id="geocomplete-karte" placeholder="Standard Kartenausschnitt" name="search_adress" autocomplete="false"/>
                                <input id="lng" name="longitude" data-geo="lng" type="hidden" value="" placeholder="Longitude">
                                <input id="lat" name="latitude" data-geo="lat" type="hidden" value="" placeholder="Latitude">
                            </td>
                            <td>
                                <select multiple name="roles[]" required> 
                                    <option value="1">Administrator</option>
                                    <option value="2">User</option>
                                </select>
                            </td>

                        </tr>
                    </tbody>
                    <tbody>
                        
                    </tbody>
                </table>

                <button type="submit" class="btn btn-default full-width">Nutzer anlegen</button>
            </form>
            <form action="users" id="edit-user-form" class="edit-user hide" enctype='multipart/form-data'>
                <table>
                    <tbody>
                        <tr>
                            <td><input id="id" type="hidden" name="id"/><input id="email" type="email" name="email" placeholder="E-Mail" disabled/></td>
                            <td><input type="password" name="password" placeholder="Passwort" required/></td>
                            <td><input id="firstname" type="text" name="firstname" placeholder="Vorname" required/></td>
                            <td><input id="lastname" type="text" name="lastname" placeholder="Nachname" required/></td>
                            <td>
                                <input type="text"  id="geocomplete-karte-edit" placeholder="Standard Kartenausschnitt" name="search_adress" autocomplete="false"/>
                                <input id="lng" name="longitude" data-geo="lng" type="hidden" value="" placeholder="Longitude">
                                <input id="lat" name="latitude" data-geo="lat" type="hidden" value="" placeholder="Latitude">
                            </td>
                            <td>
                                <select multiple name="roles" required> 
                                    <option value="1">Administrator</option>
                                    <option value="2">User</option>
                                </select>
                            </td>

                        </tr>
                    </tbody>
                    <tbody>
                        
                    </tbody>
                </table>

                <button type="submit" class="btn btn-default full-width">Nutzer ändern</button>
            </form>
        </div>
        <div class="modal-close"><img src="assets/img/close.png"></div>
    </div>
    <div class="modal-background fade-in"></div>
</div>