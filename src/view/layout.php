<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week van de Mobiliteit</title>
    <script>
    WebFontConfig = {
      custom: {
        families: ['cocogoose', 'gotham', 'gotham light'],
        urls: ['css/fonts.css']
      }
  };
  (function(d) {
    var wf = d.createElement('script'), s = d.scripts[0];
    wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
    wf.async = true;
    s.parentNode.insertBefore(wf, s);
  })(document);
  </script>
  <script>
  </script>
  <script async src="https://stevesouders.com/bin/sleep.cgi?type=js&sleep=5&expires=-1&last=0"></script>
    <?php echo $css;?>
  </head>
  <body>
    <header class="header">
      <div class="">
        <?php if(!empty($_SESSION['info'])): ?><div class="alert alert-success"><?php echo $_SESSION['info'];?></div><?php endif; ?>
        <?php if(!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?php echo $_SESSION['error'];?></div><?php endif; ?>
      </div>
      <div class="banner <?php if($currentPage !== 'home'){echo 'hidden';} ?>">
        <article>
          <header>
            <h1 class="title title--header white">Week van de Mobiliteit</h1>
            <p class="subtitle subtitle--header yellow orderSwapped">16 sept 2018 - 22 sept 2018</p>
          </header>
          <p class="text text--header white">Samen voor duurzame, ecologische en efficiënte mobiliteit. Neem deel aan talloze acties & activiteiten in het teken van de Europese Week van de Mobiliteit, of organiseer er zelf een.</p>
          <button><a  class="button button--header" href="index.php?page=programma">Ontdek ze allemaal</a></button>
        </article>
        <div class="chart">
          <p class="counter" style="width:<?php echo count($events);?>vw"><?php echo count($events);?> acties</p>
          <button type="button" name="button"><a class="button--cta" href="index.php?page=organiseren">+ Organiseer een actie</a></button>
        </div>
      </div>
      <nav class="menu menu--primairy <?php if($currentPage !== 'home') {echo 'menu--show';} if($currentPage == 'details') {echo ' menu--block';}?>">
        <ul class="menu-list">
          <li><a class="link--header <?php if($currentPage == 'home'){echo 'link--header--active';} ?>" href="index.php">Home</a></li>
          <li><a class="link--header <?php if($currentPage == 'over'){echo 'link--header--active';} ?>" href="index.php?page=over">Over</a></li>
          <li><a class="link--header <?php if($currentPage == 'programma'){echo 'link--header--active';} ?>" href="index.php?page=programma">Programma</a></li>
          <li><a class="link--header <?php if($currentPage == 'instafeed'){echo 'link--header--active';} ?>" href="index.php?page=instafeed">#weekvandemobiliteit</a></li>
          <li><a class="link--header <?php if($currentPage == 'organiseren'){echo 'link--header--active';} ?>" href="index.php?page=organiseren">Organiseren</a></li>
          <li><a class="link--header <?php if($currentPage == 'steunen'){echo 'link--header--active';} ?>" href="index.php?page=steunen">Steunen</a></li>
        </ul>
      </nav>
      <?php if($currentPage == 'details'){ ?>
      <nav class="menu menu--tertiariy">
        <div class="">
          <p><a href="index.php">Home</a> > <a href="index.php?page=programma">Programma</a> > <?php echo $events[0]['title']; ?></p>
        </div>
      </nav>
    <?php } ?>
    </header>
    <nav class="menu menu--secundairy">
      <ul class="menu-list">
        <a class="link--date bgBlue<?php if($currentPage == '16/09'){echo 'link--date--active';} ?>" href="index.php"><li><p class="subtitle">zondag 16</p><p class="text--date yellow">septemer</p></li></a>
        <a class="link--date bgYellow<?php if($currentPage == '17/09'){echo 'link--date--active';} ?>" href="index.php"><li><p class="subtitle">maandag 17</p><p class="text--date green">septemer</p></li></a>
        <a class="link--date bgGreen<?php if($currentPage == '18/09'){echo 'link--date--active';} ?>" href="index.php"><li><p class="subtitle">dinsdag 18</p><p class="text--date blue">septemer</p></li></a>
        <a class="link--date bgBlue<?php if($currentPage == '19/09'){echo 'link--date--active';} ?>" href="index.php"><li><p class="subtitle">woensdag 19</p><p class="text--date yellow">septemer</p></li></a>
        <a class="link--date bgYellow<?php if($currentPage == '20/09'){echo 'link--date--active';} ?>" href="index.php"><li><p class="subtitle">donderdag 20</p><p class="text--date green">septemer</p></li></a>
        <a class="link--date bgGreen<?php if($currentPage == '21/09'){echo 'link--date--active';} ?>" href="index.php"><li><p class="subtitle">vrijdag 21</p><p class="text--date blue">septemer</p></li></a>
        <a class="link--date bgBlue<?php if($currentPage == '22/09'){echo 'link--date--active';}; ?>" href="index.php"><li><p class="subtitle">zaterdag 22</p><p class="text--date yellow">septemer</p></li></a>
      </ul>
    </nav>
    <main>
        <div class="<?php echo $currentPage; ?>-container">
          <?php echo $content; ?>
        </div>
    </main>
    <footer>
      <div class="top">
        <div class="social">
          <h4 class="title title--footer green">Deel je ervaring</h4>
          <ul>
            <li><a class="link--footer" href="http://www.facebook.com/"><img src="./assets/images/fb.svg" alt=""></a></li>
            <li><a class="link--footer" href="http://www.twitter.com/"><img src="./assets/images/twitter.svg" alt=""></a></li>
            <li><a class="link--footer" href="http://www.instagram.com/"><img src="./assets/images/instagram.svg" alt=""></a></li>
            <li><a class="link--footer" href="http://www.youtube.com/"><img src="./assets/images/youtube.svg" alt=""></a></li>
          </ul>
        </div>
        <div class="newsletter">
          <form class="newsletter-form" action="index.php" method="post">
          <input type="hidden" name="action" value="insertEmail">
            <div class="container--flex">
              <h4 class="title title--footer white" for="nieuwsbrief">Ontvang de nieuwsbrief</h4>
              <p class="info subtitle error--text" data-success=""></p>
              <div>
                <input class="input--footer" type="email" name="email"  id="nieuwsbrief" required>
                <button class="button button--footer" type="submit" name="button">Inschrijven</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="bottom">
        <div>
          <h5 class="subtitle subtitle--footer yellow">Interressante links</h5>
          <ul class="text--footer white">
            <li><a class="link--footer" href="http://www.mobilityweek.eu/">European Mobility Week</a></li>
            <li><a class="link--footer" href="https://mobilit.belgium.be/nl">FOD Mobiliteit</a></li>
            <li><a class="link--footer" href="https://www.duurzame-mobiliteit.be/vacatures">Vacatures</a></li>
            <li><a class="link--footer" href="#">Meld een probleem</a></li>
          </ul>
        </div>
        <div>
          <p class="subtitle subtitle--footer grey rightAligned">Week van de Mobiliteit is een Europees inititief (c) 2018</p>
          <p class="subtitle subtitle--footer white rightAligned">Ontwikkeld door Jerom Verschoote</p>
        </div>
      </div>
    </footer>
    <?php echo $js;?>
  </body>
</html>
