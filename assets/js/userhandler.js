;(function ($, window, undefined) {

    spottr.userAdministration = {
        init: function () {

            var modal = $('#user-modal');

            $('body').on('click','#useradmin-link', function(id) {
                spottr.global.modalHandler(modal);

                $('#user-modal .modal-close').on('click', function(){
                    modal.find('input').val('');
                    modal.find('select').val('');
                    modal.find('select').selectpicker('render');
                });
            });

            spottr.userAdministration.loadUsers();

            spottr.userAdministration.saveUser(modal);

            spottr.userAdministration.deleteUser();

            spottr.userAdministration.editUser();
        },

        saveUser: function (modal) {
            modal.find('form').on('submit',function(e){
                e.preventDefault();
                AjaxHandler.request({
                    method     : "POST",
                    cache    : false,
                    url      : $(this).attr('action'),
                    data     : $(this).serializeObject(),
                    success  : function(data) {
                        spottr.userAdministation.loadUsers();
                    }
                });
            });
        },

        loadUsers: function () {
            AjaxHandler.request({
                method     : "GET",
                cache    : false,
                url      : "users",
                data     : $(this).serialize(),
                success  : function(data) {
                    var userTable = $('#user-modal table.userlist tbody');
                    userTable.empty();   
                    spottr.userAdministration.fillTable(data); 
                }
            });
        },

        fillTable: function (json) {
            for (var i = 0; i < json.items.length; i++) {
                var userTable = $('#user-modal table.userlist tbody');
                
                userTable.append(
                    '<tr>' +
                        '<td class="id">' + json.items[i].id + '</td>' +
                        '<td class="id">' + json.items[i].email + '</td>' +
                        '<td class="id">' + json.items[i].firstName + '</td>' +
                        '<td class="id">' + json.items[i].lastName + '</td>' +
                        '<td class="id">' + json.items[i].companyName + '</td>' +
                        '<td class="id">' + json.items[i].roles + '</td>' +
                        '<td class="id">' + 
                            '<button type="button" class="btn btn-default edit-user" data-id="' + json.items[i].id + '" aria-label="Left Align">' + 
                                '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>' +
                            '</button>' +
                            '<button type="button" class="btn btn-red delete-user" data-id="' + json.items[i].id + '" aria-label="Left Align">' + 
                                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
                            '</button>' +
                        '</td>' +
                    '</tr>'
                );
            }
        },

        deleteUser: function () {
            $('body').on('click','.delete-user', function() {
                var id = $(this).data('id');

                AjaxHandler.request({
                    method     : "DELETE",
                    cache    : false,
                    url      : "users/" + id,
                    data     : $(this).serialize(),
                    success  : function(data) {
                        var userTable = $('#user-modal table.userlist tbody');
                        userTable.empty();   
                        spottr.userAdministation.loadUsers(); 
                    }
                });


            });
        },

        editUser: function () {
            $('body').on('click','.edit-user', function() {
                var id = $(this).data('id');

                AjaxHandler.request({
                    method     : "GET",
                    cache    : false,
                    url      : "users/" + id,
                    data     : $(this).serializeObject(),
                    success  : function(data) {
                        $('#user-modal').find('.add-user').addClass('hide');
                        var editUserForm = $('#user-modal').find('.edit-user');
                        editUserForm.removeClass('hide');

                        editUserForm.find('#id').val(data.id);
                        editUserForm.find('#email').val(data.email);
                        editUserForm.find('#firstname').val(data.firstName);
                        editUserForm.find('#lastname').val(data.lastName);
                        editUserForm.find('#companyname').val(data.companyName);
                        editUserForm.find('select').val(data.roles);
                        editUserForm.find('select').selectpicker('render');

                        spottr.userAdministation.editHandler(data.id);

                    }
                });


            });
        },

        editHandler: function (id) {

            $('#user-modal').find('.edit-user').on('submit',function(e){
                e.preventDefault();
                AjaxHandler.request({
                    method   : "PUT",
                    cache    : false,
                    url      : $(this).attr('action') + "/" + id,
                    data     : $(this).serializeObject(),
                    success  : function(data) {
                        $('#user-modal').find('.add-user').addClass('hide');
                        var editUserForm = $('#user-modal').find('.edit-user');
                        var addUserForm = $('#user-modal').find('.add-user');
                        editUserForm.addClass('hide');
                        addUserForm.removeClass('hide');
                        loadUsers();

                    },

                    error    : function(data) {
                        console.log(data);
                    } 
                });

            });
        }
    };

})(jQuery, this);

spottr.userAdministration.init();

