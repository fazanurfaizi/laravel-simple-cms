$('#image').on('change',function(){
    var fileName = $(this).val();
    $(this).next('.custom-file-label').html(fileName);
})

$(function() {
    $.getScript("https://www.jqueryscript.net/demo/Delete-Confirmation-Dialog-Plugin-with-jQuery-Bootstrap/bootstrap-confirm-delete.js", function(){
        $('.delete').bootstrap_confirm_delete({
            heading: '',
            message: 'Apakah kamu yakin akan menghapus data ini ?'
        });
    });
});

function stripHtml(html) {
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}