
    $(document).on('change','#tick',function () {

        var tickmarks=$('#tick').val();

        $('.showrage').html(100-tickmarks+'%');
    }) ;
    var fullname = getCookie('name');
    if(fullname) {
        $("#fullname").html(fullname);
    }
    var check;
    $(document).on('click','.yes',function () {
        check = 1;
        return check;

    });

    $(document).on('click','.no',function () {
        check = 0;
        return check;
    });

    $(document).on('click','.option',function (e) {
        e.preventDefault();

        if( check === 1){
            $(this).addClass('btn-danger').removeClass('btn-default');
            $('.no').removeClass('btn-danger').addClass('btn-default');
        }
        if(check === 0) {
            $(this).addClass('btn-danger').removeClass('btn-default');
            $('.yes').removeClass('btn-danger').addClass('btn-default');
        }
        var option= $(this).attr('at');
        var ip =$('input[name="ip"]').val();
        var id =$('input[name="id_she"]').val();
        var reliability=$('input[type="range"]').val();
        var url=$('#register').attr('data-url');
        var name =$('input[name="name"]').val();
        if (typeof name !== 'undefined') {
            document.cookie = "name=" + name;
        } else {
            name = $("#fullname").html();
        }
        var id_she =$('input[name="id_she"]').val();
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {"option": option,"name":name,"reliability":reliability,'ip':ip,'id':id}
        }).done(function (data) {



            var fullname = getCookie('name');
            if(fullname) {
                $("#fullname").html(fullname);
            }
            var lists = data.lists;
            var listsF = data.listFail;
            var htmlList = '';
            $.each(lists, function (index, v) {

                htmlList += '<li class="col-xs-4 join"><div ><p>' + v.name + '</p></div></li>';

            });
            $("#list-active").html(htmlList);
            htmlList = '';
            $.each(listsF, function (index, v) {

                htmlList += '<li class="col-xs-4 join"><div ><p>' + v.name + '</p></div></li>';
            });
            $("#list-in-active").html(htmlList);



        })
    });
    $('body').ready(function () {
        var id_she =$('input[name="id_she"]').val();
        var name =$('#fullname').text();
        var reliability=$('input[type="range"]').val();
        var option= $(this).attr('at');
        $.ajax({
            url: '/checkname',
            type: 'get',
            dataType: 'json',
            data: {'id_she':id_she,'name':name,'reliability':reliability}
        }).done(function (data) {


            $('#tick').val(data.reliability);
            $('.showrage').html(100-data.reliability+"%");

            if(data.option==1){

                $('.yes').addClass('btn-danger').removeClass('btn-default');
                $('.no').addClass('btn-default').removeClass('btn-danger');
            }else {
                $('.no').addClass('btn-danger').removeClass('btn-default');
                $('.yes').addClass('btn-default').removeClass('btn-danger');
            }

        })
    });
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    $(document).on('click','#address',function () {

        geocoder = new google.maps.Geocoder();
        var address = $('#address').text();
        geocoder.geocode({'address':address},function(results,status){
            if(status == 'OK'){
                var LatLngVN =   results[0].geometry.location;
                var infowindowAd =  new google.maps.InfoWindow;
                var map = new google.maps.Map(document.getElementById('map'));
                map.setCenter(LatLngVN);
                map.setZoom(14);
                var markerSearch  = new google.maps.Marker({map:map,draggable:true});
                markerSearch.setPosition(LatLngVN);
                infowindowAd.setContent('Trận đấu ở đây <strong>'+address+'</strong>');
                infowindowAd.open(map,markerSearch);

            }
        });
        $('#myModal').modal('show');
    });

