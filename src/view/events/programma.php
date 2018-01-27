<section class="uitgelicht programma">
  <header class="bgBlue">
    <div class="content">
      <h2 class="title white">Programma</h2>
      <div>
        <h3 class="subtitle">Verfijnresultaten</h3>
        <form class="programma-filters" action="" method="post">
          <select class="filter-select" name="day">
            <option value="">Alle dagen</option>
            <option name="day" value="16" <?php if(!empty($_POST['day'])){if($_POST['day'] == 16){echo 'selected';}}?>>zondag 16 september</option>
            <option name="day" value="17" <?php if(!empty($_POST['day'])){if($_POST['day'] == 17){echo 'selected';}}?>>maandag 17 september</option>
            <option name="day" value="18" <?php if(!empty($_POST['day'])){if($_POST['day'] == 18){echo 'selected';}}?>>dinsdag 18 september</option>
            <option name="day" value="19" <?php if(!empty($_POST['day'])){if($_POST['day'] == 19){echo 'selected';}}?>>woensdag 19 september</option>
            <option name="day" value="20" <?php if(!empty($_POST['day'])){if($_POST['day'] == 20){echo 'selected';}}?>>donderdag 20 september</option>
            <option name="day" value="21" <?php if(!empty($_POST['day'])){if($_POST['day'] == 21){echo 'selected';}}?>>vrijdag 21 september</option>
            <option name="day" value="22" <?php if(!empty($_POST['day'])){if($_POST['day'] == 22){echo 'selected';}}?>>zaterdag 22 september</option>
          </select>
          <select class="filter-select" name="tag">
            <option value="">Select filter</option>
            <?php foreach($tags as $tag):?>
            <option name="tag" value="<?php echo $tag['tag'];?>" <?php if(!empty($_POST['tag'])){if($_POST['tag'] == $tag['tag']){echo 'selected';}}?>><?php echo $tag['tag']?> </option>
            <? endforeach;?>
            </select>
            <input class="filter-input" type="text" name="locatie" value="<?php if(!empty($_POST['locatie'])){echo $_POST['locatie'];}?>">
            <input class="filter-input filter-submit" type="submit" value="Zoek!">
          </div>
        </form>
      </div>
    </header>
    <div class="content">
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
