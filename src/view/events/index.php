<section class="uitgelicht">
  <div class="content">
    <header>
      <h2 class="title blue">Populaire acties & activiteiten</h2>
    </header>
    <ul class="list">
      <?php foreach($events as $event): ?>
      <a class="section-item" href="index.php?page=details&id=<?php echo $event['id'];?>">
        <li class="list-item" style="background-image: url(./assets/images/<?php echo $event['code'];?>/1.jpg)">
          <div class="item bgBlueDark">
            <h3 class="subtitle white"><?php echo $event['title'];?></h3>
            <p class="text--date blue"><?php echo $event['city'];?></p>
          </div>
        </li>
      </a>
      <? endforeach;?>
    </ul>
  </div>
  <a href="index.php?page=programma">
    <div class="button--section bgBlue">
      <p>Bekijk het programma ></p>
    </div>
  </a>
</section>

<section class="verhalen">
  <div class="content">
    <header>
      <h2 class="title green">Verhalen</h2>
    </header>
    <ul class="list">
      <a class="section-item" href="#">
        <li class="list-item"  style="background: url(./assets/images/banner.jpg)">
          <div class="item bgGreenDark">
            <h3 class="subtitle white">Autovrije zondag</h3>
            <p class="text--date green">zondag 10 september</p>
          </div>
        </li>
      </a>
      <a class="section-item" href="#">
        <li class="list-item"  style="background: url(./assets/images/banner.jpg)">
          <div class="item bgGreenDark">
            <h3 class="subtitle white">Autovrije zondag</h3>
            <p class="text--date green">zondag 10 september</p>
          </div>
        </li>
      </a>
      <a class="section-item" href="#">
        <li class="list-item" style="background: url(./assets/images/banner.jpg)">
          <div class="item bgGreenDark">
            <h3 class="subtitle white">Autovrije zondag</h3>
            <p class="text--date green">zondag 10 september</p>
          </div>
        </li>
      </a>
    </ul>
  </div>
  <a href="#">
    <div class="button--section bgGreen">
      <p>Ontdek alle verhalen ></p>
    </div>
  </a>
</section>

<section class="instafeed" style="background: url(./assets/images/banner.jpg)">
  <div class="content">
    <header>
      <h2 class="title yellow">#weekdemobiliteit</h2>
    </header>
  </div>
  <article>
    <p class="text--paragraph marginBig">Deel supergemakkelijk je ervarivingen met de weekvandemobiliteit-hastag via Instagram</p>
  </article>
  <a href="#">
    <div class="button--section bgYellow">
      <p>Bekijk alle foto's ></p>
    </div>
  </a>
</section>

<section class="organiseren">
  <div class="content">
    <header>
      <h2 class="title blue">Organiseer een actie</h2>
    </header>
  </div>
  <article>
    <p class="text--paragraph">Zit je boordevol boeiende ideëen? Ben je goed in mensen anticiperen? Neem dan zeker een kijkje op het organisator-platform. Start gemakkelijk en snel een actie!</p>
  </article>
  <a href="#">
    <div class="button--section bgBlue">
      <p>Start een actie ></p>
    </div>
  </a>
</section>

<section class="steunen">
  <div class="content">
    <header>
      <h2 class="title yellow">Steunen kan ook!</h2>
    </header>
  </div>
  <article>
    <p class="text--paragraph">Niet zo zeker om zelf een actie te starten? Geen nood, je kan alvast steunen d.m.v. een vrije donatie. Ontdek snel hoe en ontvang een gepersonaliseerd flue-hesje!</p>
  </article>
  <a href="#">
    <div class="button--section bgYellow">
      <p>Steun mee ></p>
    </div>
  </a>
</section>
