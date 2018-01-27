<script>
const loadCoordinates = (straat, stad, land, postcode) => {
  fetch(`https:maps.googleapis.com/maps/api/geocode/json?address=${straat},${stad},+${land},+${postcode}&key=AIzaSyDOGEtKw0_1-5fJhqBTozZayROxyqqCSSM`)
    .then(r => r.json())
    .then(json => initMap(json.results[0].geometry.location.lat, json.results[0].geometry.location.lng));
};

loadCoordinates('<?php echo $events[0]['address']?>', '<?php echo $events[0]['city'] ?>', 'België', '<?php echo $events[0]['postal']?>');

function initMap(x, y) {
  var uluru = {lat: x, lng: y};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: uluru
  });
  var marker = new google.maps.Marker({
    position: uluru,
    map: map
  });
}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOGEtKw0_1-5fJhqBTozZayROxyqqCSSM&callback=initMap">
</script>
<section class="uitgelicht programma event">
  <header class="event-header bgBlue">
    <div class="event-info bgBlueDark">
      <div class="content">
        <p class="event-date subtitle white"><?php $dateStart = new DateTime($events[0]['start']); echo '<span>'.$dateStart->format('d').'</span>'; $dateEnd = new DateTime($events[0]['end']);if($dateStart->format('d') !== $dateEnd->format('d')){echo ' tot '.$dateEnd->format('d');} echo '</br> september'?></p>
        <p class="event-time text blue"><?php $dateStart = new DateTime($events[0]['start']); echo $dateStart->format('h:s'); $dateEnd = new DateTime($events[0]['end']);if($dateStart->format('h:s') !== $dateEnd->format('h:s')){echo 'u - '.$dateEnd->format('h:s').'u';}?></p>
      </div>
    </div>
    <div>
      <div class="content">
        <h2 class="event-title title white"><?php echo $events[0]['title']; ?></h2>
        <ul class="event-organisers text"><?php foreach($events[0]['organisers'] as $organiser): echo '<li class="event-organiser">'.$organiser['name'].'</li>'; endforeach;?></ul>
        <p class="event-location text blueDark"><span class="subtitle"><?php echo $events[0]['location'];?></span></br><?php if($events[0]['address'] !== 'Diverse locaties'){echo $events[0]['address'].', '.$events[0]['postal'].' '.$events[0]['city'];}?></p>
        <p class="event-link text blueDark"><a href="<?php echo $events[0]['link'];?>"><?php echo $events[0]['link'];?></a></p>
        <ul class="event-tags text white"><?php foreach($events[0]['tags'] as $tag): echo '<li class="event-tag">'.$tag['tag'].'</li>'; endforeach;?></ul>
      </div>
    </div>
  </header>
  <div class="event-image" style="background-image: url(./assets/images/<?php echo $events[0]['code']?>/1.jpg)"></div>
  <div class="content event-beschrijving">
    <article class="event-article">
      <h4 class="event-title subtitle blueDark">Beschrijving</h4>
      <p ><?php echo $events[0]['content'];?></p>
    </article>

    <?php if(!empty($events[0]['practical'])){?>
      <article class="event-article orderSwapped">
        <h4 class="event-title subtitle blueDark">Praktisch</h4>
        <?}?>
        <?php if(!empty($events[0]['practical'])){?>
        <p><?php echo $events[0]['practical'];?></p>
      </article>

      <?}?>
  </div>
  <?php if($events[0]['address'] !== 'Diverse locaties'){?>
  <div class="event-map" id="map"></div>
  <?}?>
  <style>
  #map {
    height: 400px;
    width: 100%;
    border-radius: 3rem 3rem 0 0;
  }
  </style>
</section>
