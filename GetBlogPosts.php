<?php
$query = "http://www.blogger.com/feeds/4886411145150219450/posts/default";
$resp = simplexml_load_file($query);
header('Content-Type: application/json');
echo '[';
$numItems = count($resp->entry);
$i = 0;
foreach ($resp->entry as $post) {
    echo '{"Title": "' . $post->title . '",';
    echo '"Content": ' . str_replace('"0"', '"Text"',str_replace('@','',json_encode($post->content))) . ',';
    echo '"DateCreated": ' . json_encode(substr($post->published, 0, 10). ' '.substr($post->published, 11, 5)) . '}';
    if(++$i !== $numItems) {
      echo ",";
    }
}
echo ']';
?>