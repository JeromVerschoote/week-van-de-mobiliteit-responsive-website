<section class="uitgelicht programma event">
  <header class="bgBlue">
    <div class="left bgBlueDark">
      <div class="content">
        <p class="subtitle"><?php $dateStart = new DateTime($events[0]['start']); echo $dateStart->format('d m H:i');?> - <?php $dateEnd = new DateTime($events[0]['end']); echo $dateEnd->format('d m H:i');?></p>
        <ul class="text"><?php foreach($events[0]['tags'] as $tag): ?><li><?php echo $tag['tag'];?></li><?php endforeach; // TODO: tags & organisators laden uit database (gelinkte kolommen)?></ul>
        </div>
      </div>
      <div class="right">
        <div class="content">
          <h2 class="title white"><?php echo $events[0]['title']; ?></h2>
          <ul class="text blueDark">
          </ul>
            <div class="info">
              <p class="subtitle blueDark"><?php echo $events[0]['location'];?></p>
              <h3 class="text blueDark"><?php echo $events[0]['address'];?>, <?php echo $events[0]['postal'];?> <?php echo $events[0]['city'];?></h3>
              <p class="text blueDark"><a href="<?php echo $events[0]['link'];?>"><?php echo $events[0]['link'];?></a></p>
            </div>
          </div>
        </div>
      </header>
      <img src="./assets/images/<?php echo $events[0]['code']?>/1.jpg" alt="event-image">
      <div class="content">
        <h4 class="subtitle blueDark">Beschrijving</h4>
        <p><?php echo $events[0]['content'];?></p>
        <?php if(!empty($events[0]['practical'])){?>
          <h4 class="subtitle blueDark">Praktisch</h4>
          <p><?php echo $events[0]['practical'];?></p>
        <?php } ?>
      </div>
      <style>
      #map {
        height: 400px;
        width: 100%;
      }
      </style>
      <div id="map"></div>
      <script>
      function initMap() {
        var uluru = {lat: 50.835983, lng: 3.255449};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
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
    </section>
