<?php
$this->Html->script('SeoLite.admin', array('inline' => false));
$field = isset($field) ? $field : 'body';
?>
<div class="row-fluid">
	<div class="span12">
		<div class="actions pull-right">
			<ul class="nav-buttons">
			<?php
			echo $this->Croogo->adminAction(__d('seolite', 'Analyze'), array(
				'plugin' => 'seo_lite',
				'controller' => 'seo_lite_analyze',
				'action' => 'index',
				$this->Form->plugin,
				$this->Form->defaultModel,
				$this->data[$this->Form->defaultModel]['id'],
				$field,
				'ext' => 'json',
			), array(
				'data-toggle' => 'seo-lite-analyze',
				'icon' => 'cogs',
				'iconSize' => 'small',
				'tooltip' => array(
					'data-title' => 'Simple auto keywords and description',
					'data-placement' => 'left',
				),
			));
			?>
			</ul>
		</div>
	</div>
</div>
<?php

$keys = array(
	'meta_keywords' => array(
		'label' => __d('seolite', 'Keywords'),
	),
	'meta_description' => array(
		'label' => __d('seolite', 'Description'),
	),
);
$fields = array(
	'id' => array('type' => 'hidden'),
	'key' => array('type' => 'hidden'),
	'value' => array('type' => 'textarea'),
);

foreach ($keys as $key => $keyOptions):
	foreach ($fields as $field => $options):
		$input = sprintf('SeoLite.%s.%s', $key, $field);
		if ($field === 'id' && empty($this->data['SeoLite'][$key]['id'])):
			$options['value'] = String::uuid();
		endif;
		if ($field === 'key' && empty($this->data['SeoLite'][$key]['key'])):
			$options['value'] = $key;
		endif;
		if (!empty($keyOptions['label']) && $options['type'] !== 'hidden'):
			$options['label'] = $keyOptions['label'];
		endif;
		echo $this->Form->input($input, $options);
	endforeach;
endforeach;