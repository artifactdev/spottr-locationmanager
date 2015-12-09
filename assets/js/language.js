
var userLang = navigator.language || navigator.userLanguage;

if (userLang === 'de' || userLang === 'de-de') {
    var openInMaps    = 'In GoogleMaps öffnen';
    var edit          = 'bearbeiten';
    var deleteIt      = 'löschen';
    var putMarker     = 'Bitte den Marker zur Position ziehen.';
    var errorAppeared = 'Fehler!';
    var success       = 'Erfolgreich!';
    var loginError    = 'Fehler beim Login!';
    var userError     = 'Fehler beim anlegen des Users!';
    var userDeleted   = 'Benutzer wurde gelöscht!';
    var userEdited    = 'Benutzer wurde editiert!';
    var quickview     = 'Ansehen';

}

if (userLang === 'en' || userLang === 'en-us' || userLang === 'en-gb') {
    var openInMaps    = 'open in GoogleMaps';
    var edit          = 'edit';
    var deleteIt      = 'delete';
    var putMarker     = 'Please drag the marker to the desired position.';
    var errorAppeared = 'Error!';
    var success       = 'Success!';
    var loginError    = 'Login failure!';
    var userError     = 'Failure on user adding!';
    var userDeleted   = 'User deleted!';
    var userEdited    = 'User edited!';
    var quickview     = 'Quick view';
}

