
jQuery(document).ready(function () {

    $("#my-awesome-dropzone").dropzone(
        {
            dictDefaultMessage: '<h3><i class="glyphicon glyphicon-picture"></i> Déposer votre image ici</h3>',
            paramName: "file",
            clickable : true,
            maxFilesize: 6, // MB
            success: function() {
               alert('Vos images ont bien été ajoutée');
            },
            error: function() {
                alert("Une erreur s'est produite lors de l'upload");
            }
        }
    );

});
