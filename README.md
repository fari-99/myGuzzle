# myGuzzle
is a php class for post request multipart or form_params from [GuzzleHttp] (https://github.com/guzzle/guzzle) package.

#How To Use
##Form_params
in your controller client

```php
$data = array(
    'id' => $data['id']
);

$routeToController = 'FriendStatus';
$guzzle = new myGuzzle($routeToController);

$return = $guzzle->formParams($data, 'post');
print_r($return);
echo $return;
```

##Multipart
in your controller client

```php
$data = [
  [
      'id' => $data['id']
  ],
  [
      'namesANDcontents' => [
          'title' => Input::get('title'),
          'title1' => Input::get('title1'),
          'title2' => Input::get('title2'),
          'year_pro' => Input::get('year_pro'),
          'year_pro1' => Input::get('year_pro1'),
          'year_pro2' => Input::get('year_pro2'),
          'genre' => Input::get('genre'),
          'genre1' => Input::get('genre1'),
          'genre2' => Input::get('genre2'),
          'trackType' => Input::get('trackType'),
          'trackType1' => Input::get('trackType1'),
          'trackType2' => Input::get('trackType2'),
      ]
  ],
  [
      'namesANDcontentsFiles' => [
          'fileInput' => Input::file('lagu1'),
          'fileInput1' => Input::file('lagu1'),
          'fileInput2' => Input::file('lagu2'),
      ]
  ]
];

$guzzle = new myGuzzle('testServer');
$return = $guzzle->multiPart($data, 'post');

print_r($return);
```

#Future Update
more handling in request, and some function (i don't know what). jiaahaha.

#contribute and pull request
contribute and pull request is needed, please kindly request or contribute in this class (app?).
