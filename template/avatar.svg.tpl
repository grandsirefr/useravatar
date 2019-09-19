<?xml version="1.0" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" 
  "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg width="300" height="300" viewBox="0 0 <?=$matrix->getSize()?> <?=$matrix->getSize()?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink= "http://www.w3.org/1999/xlink">
    <?php foreach($result as $y => $col): ?>
        <?php foreach($col as $x => $color): ?>
            <rect x="<?=$x;?>"  y="<?=$y;?>" height="1" width="1" fill="<?=$color?>"/>
        <?php endforeach; ?>
    <?php endforeach; ?>
</svg>
