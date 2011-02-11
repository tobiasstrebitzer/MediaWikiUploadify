$(document).ready(function() {
    $('#uploadify').uploadify({
      'uploader'  : '/extensions/Uploadify/public/uploadify.swf',
      'script'    : '/Special:UploadifyHandler',
      'cancelImg' : '/extensions/Uploadify/public/cancel.png',
      'folder'    : '/uploads',
      'auto'      : true,
      'multi'     : true,
      'removeCompleted': false,
      'scriptData': {
          'username': wgUserName
      },
      'onComplete'   : function(event, id, fileObj, response, data) {
          $("div#uploadify"+id).html("<div class='uploadify-mediawiki-result'>" + response + "</div>");
      }
    });
});
