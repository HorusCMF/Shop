$(document).ready(function () {

    var socket = io.connect('http://www.horus.ju:1665');
    var me = null;




    /*****************Handle All actions******************/

    // on the client connected
    socket.on('logged', function (user) {
        $html ='<h3><i class="glyphicon glyphicon-info-sign"></i> '+ user.firstname +' '+ user.lastname +' s\'est connecté</h3>';
        $('#mini-notification').html($html);
        $('#mini-notification').miniNotification({closeButton: false});
    });

    // on the client connected
    socket.on('createproduct', function (user) {
        $html ='<h3><i class="glyphicon glyphicon-info-sign"></i> '+ user.firstname +' '+ user.lastname +' a créer un produit</h3>';
        $('#mini-notification').html($html);
        $('#mini-notification').miniNotification({closeButton: false});
    });


});