$(document).ready(function () {

    var socket = io.connect('http://www.freakinjob.com:1665');
    var me = null;


    /*****************Handle All actions******************/

    // on the client connected
    socket.on('logged', function (user) {
        $html ='<h3><i class="glyphicon glyphicon-info-sign"></i> '+ user.firstname +' '+ user.lastname +' vient de se connecter</h3>';
        $('#mini-notification').html($html);
        $('#mini-notification').miniNotification({closeButton: false});
    });


    // on create action comm
    socket.on('alerting', function (user) {
        $html ='<h4><i class="glyphicon glyphicon-info-sign"></i> '+ user.message +' par '+ user.firstname +' '+ user.lastname +'</h4>';
        $('#mini-notification').html($html);
        $('#mini-notification').miniNotification({closeButton: false});
    });


});