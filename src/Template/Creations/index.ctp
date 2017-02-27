<?php

use Cake\Routing\Router;
//debug($creations);
$this->assign('title', __('Portfolio'));
?>
<?= $this->Element('page_header', ['mainTitle' => __('Portfolio'), 'subtitle' => __('Quelques unes de mes créations')]) ?>
<?php
if (!empty($types)):
    ?><p> Filtre : <?php
    $first = True;
foreach ($types as $type):
    if(!$first) echo ", ";
    $first = False;
        ?>
		<a href="<?=
		Router::url(['_name' => 'portfolio_type', $type->slug]) ?>">
			<?= (h($type->name)) ?>
		</a>
<?php
endforeach;
?> </p> <?php
endif;
?>
<div class="clear"></div>
<?php
echo $this->element("grid_creations", [
	"creations" => $creations
]);
?>
