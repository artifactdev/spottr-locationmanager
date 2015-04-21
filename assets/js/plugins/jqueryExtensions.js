$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        var parameterName = this.name;
        if (parameterName.substring(parameterName.length - 2) == "[]") {
            parameterName = parameterName.replace("[]", "");
            if (o[parameterName] === undefined) {
                o[parameterName] = [];
            }
            o[parameterName].push(this.value || '');
            return;
        }
        if (o[parameterName] !== undefined) {
            if (!o[parameterName].push) {
                o[parameterName] = [o[parameterName]];
            }
            o[parameterName].push(this.value || '');
        } else {
            o[parameterName] = this.value || '';
        }
    });
    return o;
};