var map;
var geocoder;

function loadMap() {
    var pune = {lat: -8.839988, lng: 13.289437};
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: pune
    });

    var marker = new google.maps.Marker({
    position: pune,
    map: map
    });

    /*
    var cdata = JSON.parse(document.getElementById('data').innerHTML);
    geocoder = new google.maps.Geocoder();  
    codeAddress(cdata);
    */

    var allData = JSON.parse(document.getElementById('allData').innerHTML);
    showAllColleges(allData)
}

function showAllColleges(allData) {
    var infoWind = new google.maps.InfoWindow;
    Array.prototype.forEach.call(allData, function(data){
        var content = document.createElement('div');
        var strong = document.createElement('strong');
        console.log(data);

        if(data.status == 'full'){
            status = 'Cheio';
        }else if(data.status == 'empty'){
            status = 'Vazio';
        }else {
            status = 'Meio';
        }

        strong.textContent = data.name+' | '+data.address+' | '+status;
        content.appendChild(strong);
/*
        var img = document.createElement('img');

        img.src = image_status;
        img.style.width = '100px';
        content.appendChild(img);
*/
        var marker = new google.maps.Marker({
        position: new google.maps.LatLng(data.lat, data.lng),
        map: map
        });

        marker.addListener('mouseover', function(){
            infoWind.setContent(content);
            infoWind.open(map, marker);
        })
    })
}

/*
function codeAddress(cdata) {
Array.prototype.forEach.call(cdata, function(data){
        var address = data.name + ' ' + data.address;
        geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == 'OK') {
            map.setCenter(results[0].geometry.location);
            var points = {};
            points.id = data.id;
            points.lat = map.getCenter().lat();
            points.lng = map.getCenter().lng();
            updateCollegeWithLatLng(points);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
        });
    });
}
*/

/*
function updateCollegeWithLatLng(points) {
    $.ajax({
        url:"action.php",
        method:"post",
        data: points,
        success: function(res) {
            console.log(res)
        }
    })
    
}
*/