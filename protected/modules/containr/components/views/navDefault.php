
	<ul class="<?php echo $cssclass; ?>">
	<?php 

	$step = 0;
	$lastLvl = 1;
	foreach($items as $key => $item){
	    $classes = array();

	    if($key == array_pop(array_keys($items))) $classes[] = 'last';
	    if($item['active']) $classes[] = 'current active';
	    $classes[] = 'lvl' . $item['level'];

		//css
		$css = 'class="' . implode(' ', $classes) . '"';
		
		if($step > 0) {
			if($lastLvl == 2 && $item['level'] == 1) $start = '</li></ul></li><li '.$css.'>';
			if($lastLvl == 1 && $item['level'] == 2) $start = '<ul '.$css.'><li '.$css.'>';
			if($lastLvl == $item['level']) $start = '</li><li '.$css.'>';
		} else {
			$start = '<li '.$css.'>';
		}
		
		
		if(isset($item['image']) && $item['image'] <> ''){
			$entry = $start . CHtml::link($item['image'],$this->controller->createUrl('', array('code'=>$item['code'])),array('class'=>implode(' ', $classes))); 
		} else {
			$path = '/'.$item['code'];
			$entry = $start . CHtml::link($item['label'],$this->controller->createUrl($path, array(), array('class'=>implode(' ', $classes))));
		}
			
		echo $entry;
		
		//add sepperator if set
		if($sepperator) echo $sepperator;
		
		$lastLvl = $item['level'];
		$step++;
	}
	?>
	</li>
	
	</ul>
