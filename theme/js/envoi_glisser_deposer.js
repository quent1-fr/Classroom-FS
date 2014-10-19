$('.zone_upload').on('dragleave', function (e){
    e.stopPropagation();
    e.preventDefault();
    $(".zone_upload").css('background', '#fff');
    $(".zone_upload").css('color', '#aaa'); });

$('.zone_upload').on('dragover', function (e){
    e.stopPropagation();
    e.preventDefault(); 
    $(".zone_upload").css('background', '#39a46c url(theme/icones/chargement.png) no-repeat 5px -20px');
    $(".zone_upload").css('color', '#fff');
});

tout_est_ok = true;

var ma_zone_glisser_deposer = new Dropzone(
    '.zone_upload',
    {
        url: "?p=envoyer",
        maxFilesize: 20, // On accepte des fichiers 20 Mo au maximum
        parallelUploads: 2, // 2 fichiers peuvent être envoyés en même temps
        maxFiles: 50, // On accepte au plus 50 fichiers
        init: function() {
            this.on('sending', function() {
                $(".zone_upload").css('background', '#39a46c url(theme/icones/chargement.png) no-repeat 5px -20px');
                $(".zone_upload").css('color', '#fff');
                $('.zone_upload').html('Envoi des fichiers en cours. 0% effectué...');
            });
            this.on('uploadprogress', function(status){
                laf = progress;
                $('.zone_upload').html('Envoi des fichiers en cours. ' + status.upload.progress + '% effectués...');
            });
            this.on('error', function(status) {
                $(".zone_upload").css('background', '#be3f3f url(theme/icones/erreur.png) no-repeat 5px -20px');
                $(".zone_upload").css('color', '#fff');
                $('.zone_upload').html('Une erreur est survenue. Tous les fichiers n\'ont peut-être pas été envoyés.');
                tout_est_ok = false;
            });
            this.on('queuecomplete', function() {
                if(tout_est_ok === true)
                    document.location.reload(true)
            });
            
        }
    }
    
);