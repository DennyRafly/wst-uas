<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ajax Database</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome.css">
    <link rel="stylesheet" href="style.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>
Dari Mahasiswa &nbsp;:&nbsp;&nbsp;

<select onchange="cekpesan()" style="width:100px" id="frommahasiswas">
</select>
Kepada Mahasiswa &nbsp;:&nbsp;&nbsp;

<select onchange="cekpesan()" style="width:100px" id="mahasiswas">

</select>
<br><br>
<div class="container">
    <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-body msg_container_base" id="pesan">
                    
                    
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input  type="text" id="isi_pesan" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" onclick="kirimpesan()" id="btn-chat">Send</button>
                        </span>
                    </div>
                </div>
    		</div>
        </div>
    </div>
    
    
</div>



<script src="jquery.js"></script>
<script>
mahasiswa();  

function mahasiswa() {
    $.ajax({
        url: 'GetMahasiswa.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            
            $('#frommahasiswas').html("");
            $('#mahasiswas').html("");
            var html = '';
            html += '<option value="">Pilih Nama</option>';
            for (i = 0; i < data.length; i++) {
                html += '<option value="' + data[i].nis + ' ">' + data[i].nama + ' </option>';
            }
            $('#frommahasiswas').html(html);
            $('#mahasiswas').html(html);
        },
        error: function(err) {
            $('#frommahasiswas').html("");
            $('#mahasiswas').html("");
        }

    });
}
cekpesan();
function cekpesan() {
    var from = $('#frommahasiswas').val();
    var nis = $('#mahasiswas').val();
    if (nis != null) {
        $.ajax({
        url: 'GetMessage.php?nis=' + nis+ '&from='+from,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#pesan').html("");
            var html = '';
            for (i = 0; i < data.length; i++) {
               console.log(data[i].to_nis);
                
                if ( data[i].to_nis == from) {
                    console.log('diterima');
                    html += '<div class="row msg_container base_receive">'+
                            '<div class="col-md-4 col-xs-4 avatar">'+
                            '<img src="image.png" class=" img-responsive ">' +
                            ' </div>' +
                            '<div class="col-xs-8 col-md-8">'+
                            '<div class="messages msg_receive">'+
                            '<p>' +data[i].message +'</p>' +
                            '<time datetime="2009-11-13T20:00">'+ data[i].nama+ '</time>' +
                            ' </div>' +
                            '</div>' +
                            '</div>';
                }else  {
                    console.log('dikirim');


                   
                    html += '<div class="row msg_container base_sent">'+
                            '<div class="col-md-8 col-xs-8 ">'+
                            '<div class="messages msg_sent">'+
                            '<p>' +data[i].message +'</p>' +
                                '<time datetime="2009-11-13T20:00">'+ data[i].nama+ '</time>'+
                            '</div>'+
                            ' </div>' +
                            '<div class="col-md-4 col-xs-4 avatar">' +
                            '<img src="image.png" class=" img-responsive ">' +
                            '</div>' +
                            '</div>' ;
                }
               
            }
            $('#pesan').html(html);
        },
        error: function(err) {
            console.log('err');
            $('#pesan').html("");
        }

    });
    }
   
}


function kirimpesan(){
    var nis = $('#mahasiswas').val();
    var from = $('#frommahasiswas').val();
    var message = $('#isi_pesan').val();
    
    $.ajax({
        url: 'SendMessage.php',
        type: 'POST',
        dataType: 'json',
        data: {nis:nis,message:message,from:from},
        success: function(data) {
            GetMassage();
            $('#isi_pesan').val('');
            
        },
        error: function(err) {
            GetMassage();
        }

    });
}
</script>
</body>
</html>


