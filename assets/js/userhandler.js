function userAdministration() {

    $('body').on('click','#useradmin-link', function(id) {
        modalHandler();
    });

    function modalHandler() {
        var modal = $('#user-modal');

        modal.removeClass('hide');
        modal.addClass('fade-in');

        $('#user-modal .modal-close').on('click', function(){

            modal.addClass('hide');
            modal.removeClass('fade-in');
            modal.find('input').val('');
            modal.find('select').val('');
            modal.find('select').selectpicker('render');
        });

        loadUsers();

        saveUser(modal);

        deleteUser();

        editUser();
    }

    function saveUser(modal) {
        modal.find('form').on('submit',function(e){
            e.preventDefault();
            AjaxHandler.request({
                method     : "POST",
                cache    : false,
                url      : $(this).attr('action'),
                data     : $(this).serializeObject(),
                success  : function(data) {
                    loadUsers();
                }
            });
        });
    }

    function loadUsers() {
        AjaxHandler.request({
            method     : "GET",
            cache    : false,
            url      : "users",
            data     : $(this).serialize(),
            success  : function(data) {
                var userTable = $('#user-modal table.userlist tbody');
                userTable.empty();   
                fillTable(data); 
            }
        });

        function fillTable(json) {
            console.log(json);
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
        }
    }

    function deleteUser() {
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
                    loadUsers(); 
                }
            });


        });
    }

    function editUser() {
        $('body').on('click','.edit-user', function() {
            var id = $(this).data('id');

            console.log(id);

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

                    editHandler(data.id);

                }
            });


        });

        function editHandler(id) {

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
    }
}