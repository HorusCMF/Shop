var app = require('http').createServer();
app.listen(1665);
var io = require("socket.io");
var io = io.listen(app);
var sockets = {};
var mongojs = require('mongojs');
var db = mongojs('mongodb://localhost/horus');

/**
 * nohup nodejs app/node/realtime.js > /dev/null 2>&1  & to launch in bg
 * kill -0
 * nohup server &
 * ps -a | grep "nodejs"
 */

/**
 * Initialisation...
 */
//var io = require('socket.io').listen(server);
var messages = {};
var history = 20;
var iduser = null;
var users = {};

/**
 * Connexion of user at users
 */
io.sockets.on('connection', function (socket) {

    var me;

    for (var k in users) {
        socket.emit('logged', users[k]);
    }

    /**
     * On User logged
     */
    socket.on('login', function (user) {
        me = user;
        users[me.id] = me;
    });


    /**
     * On User logged
     */
    socket.on('logged', function (user) {
        me = user;
        socket.broadcast.emit('logged', me);
    });

    /**
     * On User alerting
     */
    socket.on('alerting', function (user) {
        me = user;
        socket.broadcast.emit('alerting', me);
    });


    /**
     * On User alerting
     */
    socket.on('notify', function (user) {
        me = user;
        socket.broadcast.emit('notify', me);
    });


    /**
     * Suscribe
     */
    socket.on('messagerie', function (user) {

        var db = mongojs('horus');
        var mycollection = db.collection('Messagerie');

        firstname = user.firstname;
        lastname = user.lastname;
        mess = user.message;
        $title = firstname + " " + lastname + " a dit:";


        var d = new Date();
        var n = Math.round(+new Date()/1000);

        mycollection.save({title: $title, description: mess, dateCreated:  n});
        me = user;
        socket.broadcast.emit('messagerie', me);
    });




//    /**
//     * On User edit a product
//     */
//    socket.on('editproduct', function (user) {
//        me = user;
//        socket.broadcast.emit('editproduct', me);
//    });
//
//    /**
//     * On User edit a product
//     */
//    socket.on('createactioncomm', function (user) {
//        me = user;
//        socket.broadcast.emit('createactioncomm', me);
//    });
//
//    /**
//     * On User edit a product
//     */
//    socket.on('removeactioncomm', function (user) {
//        me = user;
//        socket.broadcast.emit('createactioncomm', me);
//    });
//
//    /**
//     * On User edit a product
//     */
//    socket.on('editactioncomm', function (user) {
//        me = user;
//        socket.broadcast.emit('createactioncomm', me);
//    });

    /**
     * When User Disconnect
     */
    socket.on('disconnect', function () {
        if(!me){
            return false;
        }
        delete users[me.id];
        socket.broadcast.emit('disconnect', me);
    });


    /**
     * Suscribe
     */
    socket.on('write', function (user) {
        io.sockets.emit('writing', user);
    });


    /**
     * Not Suscribe
     */
    socket.on('notwrite', function (user) {
        io.sockets.emit('notwriting', user);
    });

    /**
     * add Friend
     */
    socket.on('addfriend', function (user) {
        iduser = user.iduser;
        iduseradded = user.iduseradded;
        var socketid = sockets[iduseradded];
        io.sockets.socket(socketid).emit('addfriendlalerting', user);
    });


    /**
     * remove Friend
     */
    socket.on('removefriend', function (user) {
        iduser = user.iduser;
        iduseradded = user.iduseradded;
        var socketid = sockets[iduseradded];
        io.sockets.socket(socketid).emit('removefriendlalerting', user);
    });

    /**
     * add Message
     */
    socket.on('addmessage', function (user) {
        iduser = user.iduser;
        iduseradded = user.iduseradded;
        var socketid = sockets[iduseradded];
        io.sockets.socket(socketid).emit('addmessagelalerting', user);
    });


//    /**
//     * Tchats
//     */
//    socket.on('messagerie', function (user) {
//        iduser = user.id;
//        me.message = user.message;
//        destinataire = user.destinataire;
////        messages[me.id] = user;
////
////        if (messages.length > history) {
////            messages.shift();
////        }
//        var socketid = sockets[destinataire];
//        io.sockets.socket(socketid).emit('newmessage', user);
//
//
////        io.sockets.socket(socketid).emit('nb_max_user', user);
////        io.sockets.socket(socket.id).emit('newmessage', user);
//
//        function js_yyyy_mm_dd_hh_mm_ss () {
//            now = new Date();
//            year = "" + now.getFullYear();
//            month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
//            day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
//            hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
//            minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
//            second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
//            return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
//        }
//
//        new mysql.Database({
//            hostname:'localhost',
//            user:'djscrave',
//            password:'OLBypJ_Oeba5B',
//            database:'wks',
//            charset:'utf8'
//        }).connect(function (error) {
//
//                if (error) {
////                    return console.log('CONNECTION error: ' + error);
//                }
//                this.query().
//                    insert('messagerie',
//                        ['suscriber', 'destinataire', 'message', 'date_created'],
//                        [iduser, destinataire, user.message, js_yyyy_mm_dd_hh_mm_ss()]
//                    ).
//                    execute(function (error, result) {
//                        if (error) {
////                            console.log('ERROR: ' + error);
//                            return;
//                        }
////                        console.log('GENERATED id: ' + result.id);
//                    });
//            });
//    });

    /**
     * Message Prvt
     */
    socket.on('pvtmessage', function (user) {
        iduser = user.id;
        me.firstname = user.firstname;
        me.lastname = user.lastname;
        me.message = user.message;
        me.typemessage = user.typemessage;
        me.destinataire = user.destinataire;

        var socketid = sockets[me.destinataire];
        io.sockets.socket(socketid).emit('new_pvr_message', user);

    });

});






