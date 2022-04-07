<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function deleteData(click,route){
    $(document).on('click', click, function() {
        var delete_id = $(this).data('delete_id');
        var $this = $(this);
        $.ajax({
            type: 'POST',
            url: route,
            data: {delete_id: delete_id},
            success: function(response) {
                $this.parents('tr').remove();
                toastr.success(response.message);
            }
        });
    })
}


function dataTable(name,route,columns){

    var table = $(name).DataTable({
        processing: true,
        serverSide: true,
        ajax: route,
        columns: columns,
    });
}
</script>