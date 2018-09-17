<?php
/**
 * Created by PhpStorm.
 * User: YAO
 * Date: 2018/8/26
 * Time: 21:06
 */


add_action('wp_footer', function(){

    $confirm_page = get_page_by_title( '合格投资者认定' );

    if($confirm_page):

        $the_content = wpautop($confirm_page->post_content);

    $confirm_box = <<<EOF
<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{$confirm_page->post_title}</h5>
      </div>
      <div class="modal-body">
        {$the_content}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancel">无法确认,关闭页面</button>
        <button type="button" class="btn btn-primary confirm">确认，并进入页面</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	function mu_confirm_box(){

		var hidden_confirm_box = Cookies.get('hidden_confirm_box', true);
		
		if( typeof hidden_confirm_box !== 'undefined' ) {
			return;
		}

		var confirm_box = jQuery('#confirmModal');

       confirm_box.modal({backdrop: 'static', keyboard: false});

       confirm_box.find('.confirm').on('click', function () {
           confirm_box.modal('hide');
           Cookies.set('hidden_confirm_box', true);
       });
       
       confirm_box.find('.cancel').on('click', function () {
           open(location, '_self').close();
           return false;
       });
	}

	jQuery( document ).ready( function() {
	    mu_confirm_box();
	});

</script>

EOF;



    echo $confirm_box;
    endif;


});