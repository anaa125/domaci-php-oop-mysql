$('#dodajForm').submit(function(){
    event.preventDefault();
    console.log("Dodavanje novog prikaza predstave");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');
    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);
    req = $.ajax({
        url: 'handler/add.php',
        type:'post',
        data: serijalizacija
    });
    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Predstava je uspesno zakazana");
            console.log("Dodato je novo prikazivanje predstave");
            location.reload(true);
        }else console.log("Prikazivanje predstave nije dodato  "+res);
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});

$('#btn-obrisi').click(function(){
    console.log("Brisanje prikaza predstave");
    const checked = $('input[name=checked-donut]:checked');

    req = $.ajax({
        url: 'handler/delete.php',
        type:'post',
        data: {'id':checked.val()}
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
           checked.closest('tr').remove();
           alert('Obrisano prikazivanje predstave');
           console.log('Obrisan');
        }else {
        console.log("Prikazivanje predstave nije obrisano "+res);
        alert("Prikaz nije obrisan");

        }
        console.log(res);
    });

});

///////////////////////////////////////////////////////////////////
// dugme koje je na glavnoj formi i otvara dijalog za izmenu

$('#dugme-izmeni').click(function () {

    const checked = $('input[name=checked-donut]:checked');

    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        console.log('Popunjena forma');

        $('#naziv').val(response[0]['naziv'].trim());
        console.log(response[0]['naziv'].trim());

        $('#sala').val(response[0]['sala'].trim());
        console.log(response[0]['sala'].trim());
        $('#trajanje').val(response[0]['trajanje'].trim());
        console.log(response[0]['trajanje'].trim());

        $('#datum').val(response[0]['datum'].trim());
        console.log(response[0]['datum'].trim());

        $('#korisnikID').val(response[0]['korisnikID'].trim());
        console.log(response[0]['korisnikID'].trim());
        $('#id').val(checked.val());
  
        console.log(response);
    });
  
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });
  
  });
  //////////////////////////////////////////
  
  $('#izmeniForm').submit(function () {
    event.preventDefault();
    console.log("Nove vrednosti");
    ////////////////////////////////
    const $form = $(this);
    const $inputs = $form.find('input, select, button,textarea');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    request = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {
  
  
        if (response === 'Success') {
            console.log('Prikaz predstave je izmenjen');
            location.reload(true);
            $('#izmeniForm').reset;
        }
        else console.log('Prikaz predstave nije izmenjen' + response);
        console.log(response);
    });
  
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });


    $('#izmeniModal').modal('hide'); 
  });



///////////////////////////////////////////////  

$('#btn-pretraga').click(function () {

    var para = document.querySelector('#myInput');
    console.log(para);
    var style = window.getComputedStyle(para);
    console.log(style);
    if (!(style.display === 'inline-block') || ($('#myInput').css("visibility") ==  "hidden")) {
        console.log('block');
        $('#myInput').show();
        document.querySelector("#myInput").style.visibility = "";
    } else {
       document.querySelector("#myInput").style.visibility = "hidden";
    }
});

$('#btnPrikaz').click(function () {
    $('#pregled').toggle();
});

$('#btnDodaj').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});
$('#btnIzmeni').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});
