<?php 
header('Access-Control-Allow-Origin: *');

if (isset($_GET['start'])) {
	// Get the arguments
	if ($_GET['pager']==1) {
		$args = get_webisodes($_GET['start'],1,true);
	} else {
		$args = get_webisodes($_GET['start'],4,false);
	}

	// Serve the webisodes
	$webisodes = get_posts($args);
	if ($_GET['redirect']==1) {
		$webisodes = json_decode(get_webisode_json($webisodes,true));
		// echo '<a href="/webisode/' . $webisodes->webisodes[0]->post_name . '">'.$webisodes->webisodes[0]->post_title.'</a>';
		// echo 'Location: /webisode/' . $webisodes->webisodes[0]->post_name;
		header('Location: /webisode/' . $webisodes->webisodes[0]->post_name);
	} else {
		echo $_GET['pager']==1 ? get_webisode_json($webisodes,true) : get_webisode_json($webisodes,false);
	}
} else {
	header('Location:/');
}


