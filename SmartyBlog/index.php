<?php
try {
    require 'smarty-3.1.30/libs/Smarty.class.php';
} catch (Exception $e) {
    echo $e;
}
//include('/smarty-3.1.30/libs/Smarty.class.php');
// create object
$smarty = new Smarty();
if(isset($smarty)){
  //assign data to variables
  $smarty->assign('name', 'Declan Wright');
  $query = "http://www.blogger.com/feeds/4886411145150219450/posts/default";
  $resp = simplexml_load_file($query);
  $blogarray = array();
  foreach ($resp->entry as $post) {
      array_push($blogarray,array('title'=>$post->title, 'content'=>$post->content, 'publishdate'=>'<center><p class="blog-timestamp"> Posted on: ' . substr($post->published, 0, 10) . ' at: ' .substr($post->published, 11, 5) . '</p></center>'));
  }
  $smarty->assign('blogs', $blogarray);
  // display it
  $smarty->display('index.tpl');
} else {
  echo 'smarty does not exist';
}
 ?>
