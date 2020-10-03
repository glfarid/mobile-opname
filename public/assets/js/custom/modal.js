const test =(data,request,field) => {
    $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });    
    $.ajax({
        type: 'POST',
        url: request,
        data: {
            id: data
        },
        success: function(data) {
            // $('.modal-title').html('Edit Data');
            // $('#id').val(data.id);
            // $('#judul').val(data.JUDUL);
            // $('#pengarang').val(data.PENGARANG);
            // $('#subjek').val(data.SUBJEK);
            // $('#penerbit').val(data.PENERBIT);

            console.log(data)
      
        field.forEach(function(entry){
           console.log(entry);
            $('#'+entry).val(data.entry);
            console.log(data.entry);
        });

        }

    });
      
    
    
}

