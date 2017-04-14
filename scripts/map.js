/* {
    'use strict';


} If i remove this i lose my markers
*/


var map;

function drawMap() {


       //sets locations of branches 
	var finglas = new google.maps.LatLng(53.390325, -6.298400700000002),
		raheny = new google.maps.LatLng(53.379482, -6.175452),
                dun= new google.maps.LatLng(53.294396, -6.133867),
		dundrum = new google.maps.LatLng(53.289132, -6.243264),
		gorey = new google.maps.LatLng(52.675735, -6.294302),
		kerry = new google.maps.LatLng(52.154461, -9.566863),
		galway = new google.maps.LatLng(53.270668, -9.056791),
		cork = new google.maps.LatLng(51.8968917, -8.4863157),
		navan = new google.maps.LatLng(53.647092, -6.696661),
		drogheda = new google.maps.LatLng(53.717856, -6.356099),
		donegal = new google.maps.LatLng(54.654197, -8.110546),
		athlone = new google.maps.LatLng(53.423933, -7.94069),
		limerick = new google.maps.LatLng(52.66802, -8.630498);

	var mapOptions = 
            {
                //user controls for the map, position ect
		'center': new google.maps.LatLng(53.294396, -6.133867),
		'zoom': 15,
		'mapTypeId': google.maps.MapTypeId.ROADMAP,
		draggable: true,
		zoomControl: true,
		scrollwheel: false,
		disableDoubleClickZoom: true,
	
                //this is used to style the map to match my site theme
                styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#2a3843"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#2a3843"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#2a3843"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#2a3843"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2a3843"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#2a3843"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#2a3843"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#2a3843"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#2a3843"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#2a3843"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#2a3843"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2a3843"}]}]
            };

                
        //generates the map using the map options in the my_map div
	var map = new google.maps.Map(document.getElementById("my-map"), mapOptions);

        //creates a marker for each branch
	var marker = [new google.maps.Marker({
			position: finglas,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Finglas Dublin 11'
		}),
                dunlaoghaire = new google.maps.Marker({
			position: dun,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Dun Laoghaire'
		}),

		corkcity = new google.maps.Marker({
			position: cork,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Cork City'
		}),

		ra = new google.maps.Marker({
			position: raheny,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Raheny Dublin 5'
		}),

		dun = new google.maps.Marker({
			position: dundrum,
			map: map,
			title: 'Dundrum Dublin',
                        icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
		}),

		wex = new google.maps.Marker({
			position: gorey,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Gorey Wexford'
		}),

		ke = new google.maps.Marker({
			position: kerry,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Kerry'
		}),

		gal = new google.maps.Marker({
			position: galway,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Galway'
		}),

		meath = new google.maps.Marker({
			position: navan,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Navan Meath'
		}),

		louth = new google.maps.Marker({
			position: drogheda,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Drogheda Louth'
		}),

		don = new google.maps.Marker({
			position: donegal,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Donegal'
		}),

		ath = new google.maps.Marker({
			position: athlone,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Athlone'
		}),

		limerick = new google.maps.Marker({
			position: limerick,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
			map: map,
			title: 'Limerick'
		})
    ];



}