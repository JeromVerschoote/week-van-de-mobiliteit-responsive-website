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
        <ul class="event-tags text white"><?php foreach($events[0]['tags'] as $tag): echo '<a href="index.php?page=programma&tag='.$tag['tag'].'"><li class="event-tag">'.$tag['tag'].'</li></a>'; endforeach;?></ul>

        <div class="container--flex-row">
          <img class="icon icon-location" src="./assets/images/location.svg" alt="">
          <p class="event-location text blueDark"><span class="subtitle"><?php echo $events[0]['location'];?></span></br><?php if($events[0]['address'] !== 'Diverse locaties'){echo $events[0]['address'].', '.$events[0]['postal'].' '.$events[0]['city'];}?></p>
        </div>
        <div class="container--flex-row">
          <img class="icon icon-world" src="./assets/images/world.svg" alt="">
          <div>
            <ul class="event-organisers text"><?php foreach($events[0]['organisers'] as $organiser): echo '<li class="event-organiser">'.$organiser['name'].'</li>'; endforeach;?></ul>
            <p class="event-link text blueDark"><a href="<?php echo $events[0]['link'];?>"><?php echo $events[0]['link'];?></a></p>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="event-image" style="background-image: url(./assets/images/<?php echo $events[0]['code']?>/1.webp)"></div>
  <div class="content event-beschrijving">
    <article class="event-article">
      <h4 class="event-title subtitle blueDark">Beschrijving</h4>
      <p ><?php echo $events[0]['content'];?></p>
    </article>

    <?php if(!empty($events[0]['practical'])){?>
      <article class="event-article orderSwapped">
        <h4 class="event-title subtitle blueDark">Praktisch</h4>
        <?php } ?>
        <?php if(!empty($events[0]['practical'])){?>
        <p><?php echo $events[0]['practical'];?></p>
      </article>

      <?php } ?>
  </div>
  <?php if($events[0]['address'] !== 'Diverse locaties'){?>
  <div class="event-map" id="map"></div>
  <?php } ?>
  <style>
  #map {
    height: 400px;
    width: 100%;
    border-radius: 3rem 3rem 0 0;
  }
  </style>
</section>

<section class="uitgelicht meer">
  <div class="content">
    <header>
      <h2 class="title yellow">Meer acties & activiteiten</h2>
    </header>
    <ul class="list">
      <?php foreach($spotlightEvents as $event): ?>
      <a class="section-item" href="index.php?page=details&id=<?php echo $event['id'];?>">
        <li class="list-item" style="background-image: url(./assets/images/<?php echo $event['code'];?>/1.webp)">
          <div class="item bgYellowDark">
            <h3 class="subtitle white"><?php echo $event['title'];?></h3>
            <p class="text--date yellow"><?php echo $event['city'];?></p>
          </div>
        </li>
      </a>
    <?php endforeach;?>
    </ul>
  </div>
  <a href="index.php?page=programma">
    <div class="button--section bgYellow">
      <p>Terug naar programma ></p>
    </div>
  </a>
</section>
