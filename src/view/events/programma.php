<section class="uitgelicht programma">
  <header class="bgBlue">
    <div class="content">
      <h2 class="title white">Programma</h2>
      <div>
        <h3 class="subtitle">Verfijnresultaten</h3>
        <form class="programma-filters" method="get" action="index.php?page=programma">
          <input type="hidden" name="page" value="programma">
          <select class="filter-select" name="day">
            <option value="">Alle dagen</option>
            <option value="16" <?php if(!empty($_GET['day'])){if($_GET['day'] == 16){echo 'selected';}}?>>zondag 16 september</option>
            <option value="17" <?php if(!empty($_GET['day'])){if($_GET['day'] == 17){echo 'selected';}}?>>maandag 17 september</option>
            <option value="18" <?php if(!empty($_GET['day'])){if($_GET['day'] == 18){echo 'selected';}}?>>dinsdag 18 september</option>
            <option value="19" <?php if(!empty($_GET['day'])){if($_GET['day'] == 19){echo 'selected';}}?>>woensdag 19 september</option>
            <option value="20" <?php if(!empty($_GET['day'])){if($_GET['day'] == 20){echo 'selected';}}?>>donderdag 20 september</option>
            <option value="21" <?php if(!empty($_GET['day'])){if($_GET['day'] == 21){echo 'selected';}}?>>vrijdag 21 september</option>
            <option value="22" <?php if(!empty($_GET['day'])){if($_GET['day'] == 22){echo 'selected';}}?>>zaterdag 22 september</option>
          </select>
          <select class="filter-select" name="tag">
            <option value="">Geen filter</option>
            <?php foreach($tags as $tag):?>
            <option value="<?php echo $tag['tag'];?>" <?php if(!empty($_GET['tag'])){if($_GET['tag'] == $tag['tag']){echo 'selected';}}?>><?php echo $tag['tag']?> </option>
            <? endforeach;?>
            </select>
            <input class="filter-input" type="text" name="locatie" value="<?php if(!empty($_GET['locatie'])){echo $_GET['locatie'];}?>" placeholder="Zoek op locatie">
            <button class="filter-input filter-submit noJS" type="submit">Zoek!</button>
          </div>
        </form>
      </div>
    </header>
    <div class="content" id="results"></div>
    <div class="content noJS">
      <h3></h3>
      <ul class="list">
        <?php if(!empty($events)){ foreach($events as $event): ?>
          <a class="section-item" href="index.php?page=details&id=<?php echo $event['id'];?>">
            <li class="list-item" style="background-image: url(./assets/images/<?php echo $event['code'];?>/1.jpg)">
              <div class="item bgBlueDark">
                <h3 class="subtitle white"><?php echo $event['title'];?></h3>
                <p class="text--date blue"><?php echo $event['city'];?></p>
              </div>
            </li>
          </a>
        <?php endforeach;} else if(empty($events)){ echo '<p>Uw zoekopdracht leverde geen resultaten op.</p>';} ?>
      </ul>
    </div>
  </section>
  <script type="text/javascript">
{
  const init = () => {
    const confirmationLinks = Array.from(document.getElementsByClassName(`confirmation`));
    confirmationLinks.forEach($confirmationLink => {
      $confirmationLink.addEventListener(`click`, e => {
        if (!confirm('Are you sure?')) e.preventDefault();
      });
    });
  };
  init();
}
</script>
