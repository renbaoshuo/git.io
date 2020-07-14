<?php

    $talkContent = "";
    $url         = addslashes($_POST['url']);

    function send_post($url, $post_data) {

        $postdata = http_build_query($post_data);  
        $options  = array(
            'http' => array(
                'method' => 'POST',  
                'header' => 'Content-type:application/x-www-form-urlencoded',  
                'content' => $postdata,  
                'timeout' => 15 * 60
            )
        );

        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;  
    } 

    if(get_headers($url))   {
        $post_data   = array('url' => "https://renbaoshuo.github.io/git.io/jump.html?url=" . $url );
        $talkContent = send_post('https://git.io/create', $post_data);

        header('text/html; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        echo $talkContent;
    } else {
        header('HTTP/1.1 500 Internal Server Error');
        header('text/html; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        echo "Invalid url: " . $url;
    }
