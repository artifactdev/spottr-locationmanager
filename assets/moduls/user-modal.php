<div id="user-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Users</h2>
        <div class="modal-body">
            <form action="users" class="add-user" enctype='multipart/form-data'>
                <table class="userlist">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>E-Mail</td>
                            <td>Passwort</td>
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
            <form action="users" id="user-form" class="add-user" enctype='multipart/form-data'>
                <table>
                    <tbody>
                        <tr>
                            <td><input type="text" name="email" placeholder="E-Mail"/></td>
                            <td><input type="password" name="password" placeholder="Passwort"/></td>
                            <td><input type="text" name="firstname" placeholder="Vorname"/></td>
                            <td><input type="text" name="lastname" placeholder="Nachname"/></td>
                            <td><input type="text" name="companyname" placeholder="Firmenname"/></td>
                            <td><input type="text" name="roles" placeholder="Rolle (1 Admin,2 Consumer)"/></td>

                        </tr>
                    </tbody>
                    <tbody>
                        
                    </tbody>
                </table>

                <button type="submit" class="btn btn-default full-width">Nutzer anlegen</button>
            </form>
        </div>
        <div class="modal-close"><img src="assets/img/close.png"></div>
    </div>
    <div class="modal-background fade-in"></div>
</div>