var buscador = $("#table").DataTable({
    "bPaginate":false,
    //"bFilter":false,
    //"bInfo":false,
    "info":false
    });

$("#input-search").keyup(function(){
    
    buscador.search($(this).val()).draw();
    
    if ($("#input-search").val() == ""){
        $(".content-search").fadeOut(300);
    }else{
        $(".content-search").fadeIn(300);
    }
});

$("#input-search2").keyup(function(){
    
    buscador.search($(this).val()).draw();
    
    if ($("#input-search2").val() == ""){
        $(".content-search").fadeOut(300);
    }else{
        $(".content-search").fadeIn(300);
    }
});

