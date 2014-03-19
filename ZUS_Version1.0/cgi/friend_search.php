<?php
	
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @cgi:friend_search</h1>');
	}
	
	//initialize data
	$error = "none";
	
	$args = array(
				  'pid'     => '',
				  'keyword' => '',
				  'list'    => '',
				  'home'    => $home
				  );
	$search_result = array();

	//Process data
	foreach ($args as $key => $val) {
		if ((isset($_POST[$key])) && ($_POST[$key] != "")) {
			$args[$key] = $_POST[$key];
		}
	}
	
	//Access database
	if ($error == "none") {
		$search_result = SearchDAO::get_search_people_list($args['keyword']);
	}
	
	if ( !empty($search_result) )
	{
		foreach ($search_result as $result) {
			$args['list'] .= "			
											<ul class='ul-search-result-friends'>
												<li class='li-search-result-friends'>
													<div class='search-left-area'>
														<a href='".$home.$result['url']."'>
															<img class='logo-small' src='".$home.$result['image']."' alt='".$result['alt']."' title='".$result['title']."'>
														</a>
													</div>
													<div class='search-right-area'>
														<!-- replyer name -->
														<a href='".$home.$result['url']."'>
															<span class='search-list-title-member'>".$result['title']."</span>
														</a>
													</div>
												</li>
											</ul>";
		}
	}
	else
	{
		$args['list'] .= "
											<div class='search-result-no-found'>
												查无此人...
											</div>";
	}

	//return json-type test
	echo "{\n";
	echo "'error': '$error',\n";
	echo "'args': ";
	echo json_encode($args);
	echo ",\n'search_result': ";
	echo json_encode($search_result);
	echo "\n}";
?>

