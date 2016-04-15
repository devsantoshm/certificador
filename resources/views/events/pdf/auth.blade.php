<div class="pdf-authorities">
  <?php
  $i = 0;
  $authorities = [1, 2, 3, 4];

  foreach ($event->professors as $professor) {
    if ($i === 0) {
      echo "<div class=\"group\">";
    }

    $title = $professor->title ?
      $professor->title->desc : $professor->personalDetails->title->desc;
    $names = $professor->personalDetails->formattedNames();

    if ($event->professors->count() == 1) {
      echo "<div class=\"single\">
        &#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;
        <br>
        $title $names
      </div>";
    } else {
      echo "<div class=\"name\">
        &#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;
        <br>
        $title $names
      </div>";
    }

    if ($i === 1) {
      $i = 0;
      echo "</div>";
      continue;
    }
    $i++;
  }
  ?>
</div>