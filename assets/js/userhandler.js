;
(function($, window, undefined) {

    spottr.userAdministration = {
        /**
         * initialises all needed functions by clicking the useradmin-link
         */
        init: function() {

            var modal = $('#user-modal');

            $('body').on('click', '#useradmin-link', function(id) {
                var modal = $('#user-modal');
                spottr.global.modalHandler(modal);
                spottr.global.fancySelect();
                spottr.userAdministration.loadUsers();
                spottr.userAdministration.saveUser(modal);

                $("#geocomplete-karte").geocomplete({
                    details: "#user-form",
                    types: ["geocode", "establishment"],
                    detailsAttribute: "data-geo"
                });

                $('#user-modal .modal-close').on('click', function() {
                    modal.find('input').val('');
                    modal.find('select').val('');
                });
            });

            spottr.userAdministration.loadUsers();

            spottr.userAdministration.deleteUser();

            spottr.userAdministration.editUser();
        },

        /**
         * saves a new user
         * @param  {Object} modal the modal there the form can be find
         */
        saveUser: function(modal) {
            var form = modal.find('.add-user');

            $('.btn-add-user').on('click', function(){
                form.submit();
            })

            form.on('submit', function(e) {
                e.preventDefault();
                form.validate();
                if (form.valid()) {
                    AjaxHandler.request({
                        method: "POST",
                        cache: false,
                        url: $(this).attr('action'),
                        data: $(this).serializeObject(),
                        success: function(data) {
                            spottr.userAdministration.loadUsers();
                            form.find('input').each(function(){
                                $(this).val('');
                            });
                        },
                        error: function() {
                            spottr.global.error('Fehler beim anlegen des Users!');
                            spottr.userAdministration.loadUsers();
                        }
                    });
                }
            });
        },

        /**
         * loads all existing users
         */
        loadUsers: function() {
            AjaxHandler.request({
                method: "GET",
                cache: false,
                url: "users",
                data: $(this).serializeObject(),
                success: function(data) {
                    spottr.global.loading();
                    var userTable = $('#user-modal table.userlist tbody');
                    userTable.empty();
                    spottr.userAdministration.fillTable(data);
                }
            });
        },

        /**
         * adds existing users to the usertable
         * @param  {JSON} json the JSON of existing users
         */
        fillTable: function(json) {
            for (var i = 0; i < json.items.length; i++) {
                var userTable = $('#user-modal table.userlist tbody');

                userTable.append(
                    '<tr>' +
                    '<td class="id">' + json.items[i].id + '</td>' +
                    '<td class="mail">' + json.items[i].email + '</td>' +
                    '<td class="firstName">' + json.items[i].firstName + '</td>' +
                    '<td class="lastName">' + json.items[i].lastName + '</td>' +
                    '<td class="table-card">' + json.items[i].searchAddress + '</td>' +
                    '<td class="roles">' + json.items[i].roles + '</td>' +
                    '<td class="buttons">' +
                    '<button type="button" class="btn btn-default edit-user" data-id="' + json.items[i].id + '" aria-label="Left Align">' +
                    '<i class="material-icons small mdi-action-assignment-ind"></i>' +
                    '</button>' +
                    '<button type="button" class="btn red delete-user" data-id="' + json.items[i].id + '" aria-label="Left Align">' +
                    '<i class="material-icons small mdi-action-delete"></i>' +
                    '</button>' +
                    '</td>' +
                    '</tr>'
                );
            }
            spottr.global.success('User wurden geladen');
        },

        /**
         * handles user delete if deletebutton is clicked
         */
        deleteUser: function() {
            $('body').on('click', '.delete-user', function() {
                var id = $(this).data('id');

                AjaxHandler.request({
                    method: "DELETE",
                    cache: false,
                    url: "users/" + id,
                    data: $(this).serialize(),
                    success: function(data) {
                        var userTable = $('#user-modal table.userlist tbody');
                        userTable.empty();
                        spottr.global.success('User wurde gelöscht!');
                        spottr.userAdministration.loadUsers();
                    }
                });


            });
        },

        /**
         * handles editUser form and fills the data of the user which should be edited
         */
        editUser: function() {
            $('body').on('click', '.edit-user', function() {
                var id = $(this).data('id');

                AjaxHandler.request({
                    method: "GET",
                    cache: false,
                    url: "users/" + id,
                    data: $(this).serializeObject(),
                    success: function(data) {
                        spottr.global.loading();
                        $('#user-modal').find('.add-user').addClass('hide');
                        var editUserForm = $('#user-modal').find('.edit-user');
                        editUserForm.removeClass('hide');

                        $("#geocomplete-karte-edit").geocomplete({
                            details: "#edit-user-form",
                            types: ["geocode", "establishment"],
                            detailsAttribute: "data-geo"
                        });

                        $('.btn-add-user').addClass('hide');
                        $('.btn-change-user').removeClass('hide');

                        editUserForm.find('#id').val(data.id);
                        editUserForm.find('#email').val(data.email);
                        editUserForm.find('#firstname').val(data.firstName);
                        editUserForm.find('#lastname').val(data.lastName);
                        editUserForm.find('#mapCenter').val(data.searchAddress);
                        editUserForm.find('#lng').val(data.longitude);
                        editUserForm.find('#lat').val(data.latitude);
                        editUserForm.find('select').val(data.roles);

                        spottr.userAdministration.editHandler(data.id);

                    }
                });


            });
        },

        /**
         * handles the update of a given user to the backend
         * @param  {ID} id The userID
         */
        editHandler: function(id) {
            var form = $('#user-modal').find('#edit-user-form');

            $('.btn-change-user').on('click', function(){
                form.submit();
            });

            form.on('submit', function(e) {
                e.preventDefault();
                form.validate();
                if (form.valid()) {
                    AjaxHandler.request({
                        method: "PUT",
                        cache: false,
                        url: $(this).attr('action') + "/" + id,
                        data: $(this).serializeObject(),
                        success: function(data) {
                            spottr.global.success('User wurde editiert!');
                            $('#user-modal').find('.add-user').addClass('hide');
                            var editUserForm = $('#user-modal').find('.edit-user');
                            var addUserForm = $('#user-modal').find('.add-user');
                            editUserForm.addClass('hide');
                            addUserForm.removeClass('hide');
                            spottr.userAdministration.loadUsers();

                            var currentUser = AuthenticationHelper.loadCurrentUser();
                            if (currentUser.id == data.id) {
                                $.cookie("X-SPOTTR-USER", JSON.stringify(data), {
                                    expires: (1 / 24),
                                    path: "/"
                                });
                            }

                            $('.btn-add-user').removeClass('hide');
                            $('.btn-change-user').addClass('hide');

                            form.find('input').each(function(){
                                $(this).val('');
                            });


                        },

                        error: function(data) {
                            spottr.global.error('Fehler beim editieren des Users');
                            console.log(data);
                        }
                    });
                }

            });
        }
    };

})(jQuery, this);

spottr.userAdministration.init();
