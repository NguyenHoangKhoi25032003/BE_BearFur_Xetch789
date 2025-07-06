<?php
if (isset($data) && is_array($data) && !empty($data)):
    foreach ($data as $value):
        $data_id = $value['id'];
        $data_title = $value['title'];
				$data_hometext = $value['hometext'];
        $data_link = site_url($value['categories']['alias'] . '/' . $value['alias'] . '-' . $data_id);
        $data_image = array(
          'src' => get_image(get_module_path('shops') . $value['homeimgfile'], get_module_path('shops') . 'no-image.png'),
          'alt' => ''
        );
        ?>
    <?php endforeach; ?>
<?php endif; ?>
