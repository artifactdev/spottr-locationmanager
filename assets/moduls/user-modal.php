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
                            <td>Firmenname</td>
                            <td>Rolle</td>

                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

            </form>
            <form action="rest-api/users" id="user-form" class="add-user" enctype='multipart/form-data'>
                <table>
                    <tbody>
                        <tr>
                            <td><input type="text" name="email" placeholder="E-Mail"/></td>
                            <td><input type="password" name="password" placeholder="Passwort"/></td>
                            <td><input type="text" name="firstname" placeholder="Vorname"/></td>
                            <td><input type="text" name="lastname" placeholder="Nachname"/></td>
                            <td><input type="text" name="companyname" placeholder="Firmenname"/></td>
                            <td>
                                <select multiple name="roles"> 
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
                            <td><input id="id" type="hidden" name="id"/><input id="email" type="text" name="email" placeholder="E-Mail" required/></td>
                            <td><input type="password" name="password" placeholder="Passwort" required/></td>
                            <td><input id="firstname" type="text" name="firstname" placeholder="Vorname" required/></td>
                            <td><input id="lastname" type="text" name="lastname" placeholder="Nachname" required/></td>
                            <td><input id="companyname" type="text" name="companyname" placeholder="Firmenname" required/></td>
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