<?php

$data = json_decode(file_get_contents('php://input'),true);
$text = $data['message']['text'];

define('TOKEN', '1536419268:AAG1cmEAaBAPc0jyT1F5-PkWFqpNVDspN90');

// Функция вызова методов API
function sendTelegram($method, $response)
{
    $ch = curl_init('https://api.telegram.org/bot' . TOKEN . '/' . $method);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}

//Ответ бота
switch ($text)
{
    case '/start';
    case 'Перезапустить квест';
        sendTelegram(
            'sendPhoto',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'caption' => 'Привет из Ясной Поляны! В этом году наш музей отмечает столетие. За свою историю усадьба Толстого пережила много волнующих событий. Но что особенно важно — почти не изменилась, сохранив свой особой дух и атмосферу места, которое так любил писатель даже после его смерти. Не верите? Пройдите наш текстовый квест, чтобы убедиться в этом!',
                'photo' => curl_file_create(__DIR__ . '/images/photo1.png'),
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Поехали!', 'callback_data' => '1'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Поехали!':
        sendTelegram(
            'sendPhoto',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'caption' => 'В 1763 году князь Сергей Федорович Волконский, прадед Льва Толстого по линии матери, приобрел часть Ясной Поляны. Впоследствии усадьбу унаследовал его сын, Николай Сергеевич (на фотографии). Именно он сыграл решающую роль в судьбе яснополянской усадьбы. Став ее главным строителем и скупив у прежних владельцев разрозненные части Ясной Поляны, он создал здесь крупное имение, к которому мы и привыкли относить название «Ясная Поляна». Стараниями князя в усадьбе появились парки, сады, живописные аллеи, пруды, богатая оранжерея, был создан архитектурный ансамбль, включавший большой барский дом и два флигеля.',
                'photo' => curl_file_create(__DIR__ . '/images/photo2.png'),
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Вот это да!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Вот это да!':
        sendTelegram(
            'sendPhoto',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'caption' => 'На этой фотографии — одно из первых исторических строений, которое видят все, кто приезжают в Ясную Поляну. Что это?',
                'photo' => curl_file_create(__DIR__ . '/images/photo3.png'),
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Колонны'],
                            ['text' => 'Башни въезда'],
                            ['text' => 'Усадебные ворота'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Колонны';
    case 'Усадебные ворота':
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'Это Башни въезда. Они были выстроены дедом Толстого, князем Николаем Сергеевичем Волконским. Когда-то между башнями были укреплены железные ворота, но при Толстом их уже не было. Внутри башни полые, в них укрывались от непогоды сторожа.',
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Буду знать!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Башни въезда':
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'Верно! Они были выстроены дедом Толстого, князем Николаем Сергеевичем Волконским. Когда-то между башнями были укреплены железные ворота, но при Толстом их уже не было. Внутри башни полые, в них укрывались от непогоды сторожа.',
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Я так и знал!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Я так и знал!';
    case 'Буду знать!':
        sendTelegram(
            'sendPhoto',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'caption' => 'После смерти князя Волконского в 1821 году его дочь Мария Николаевна осталась владелицей огромного имения. Через год после смерти отца она вышла замуж за графа Николая Ильича Толстого. Сразу после свадьбы Толстые обосновались в Ясной Поляне.
Любимым местом прогулок Марии Николаевны был Нижний парк. Здесь она сажала розовые кусты, орешник, бересклет, кусты которого, неприметные летом, осенью вспыхивают яркими розово-красными «кострами», живописно разбросанными по всему парку. А у Верхнего пруда до сих пор живут потомки когда-то посаженных ею серебристых тополей.',
                'photo' => curl_file_create(__DIR__ . '/images/photo4.png'),
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Ничего себе!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Ничего себе!':
        sendTelegram(
            'sendPhoto',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'caption' => 'В глубине этого парка находится вот такое деревянное строение. Как вы думаете, для что это?',
                'photo' => curl_file_create(__DIR__ . '/images/photo5.png'),
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Сторожевая будка'],
                            ['text' => 'Беседка-вышка'],
                            ['text' => 'Рабочее место садовника'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Сторожевая будка';
    case 'Рабочее место садовника':
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'На самом деле это беседа-вышка. По семейным преданиям, здесь Мария Николаевна ждала возвращения мужа, часто отлучавшегося из усадьбы по делам.',
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Ну и ну!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Беседка-вышка':
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'Точно! По семейным преданиям, здесь Мария Николаевна ждала возвращения мужа, часто отлучавшегося из усадьбы по делам.',
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Я и это знал!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Ну и ну!';
    case 'Я и это знал!':
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'В браке у Марии Николаевны и Николая Ильича родилось пятеро детей: четыре сына, младшим из которых был Лев, и дочь. Спустя некоторое время после рождения дочери Мария Николаевна скончалась от так называемой «родовой горячки». Николай Ильич пережил супругу на 7 лет. После смерти родителей дети Толстых отправились на воспитание к теткам. А в 1847 году произошел раздел наследства. «По обычаю как младшему в семье мне отдали имение, в котором жили — Ясную Поляну», — пишет Лев Николаевич.',
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Чудеса!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Чудеса!':
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'На момент получения наследства Льву Николаевичу было 18 лет. Он еще не думал о писательстве как о деле всей своей жизни. Как и герой повести «Утро помещика» Дмитрий Нехлюдов, юный Толстой всей душой стремится «посвятить себя жизни в деревне», потому что чувствует, что «рожден для нее».',
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Интересно!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Интересно!':
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'В 1851 году Лев Толстой отправляется на военную службу. В отсутствие хозяина драматическим образом изменился облик центральной части усадьбы. Знаете, что произошло?',
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Был продан усадебный дом'],
                            ['text' => 'В усадьбе произошел пожар'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Был продан усадебный дом':
        sendTelegram(
            'sendPhoto',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'caption' => 'Большой яснополянский дом начал строить Николай Сергеевич Волконский, а закончил — Николай Ильич Толстой. В 1856 году этот дом был продан на своз. Его перевезли в село Долгое, где он простоял до 1913 года и был разобран за ветхостью. На месте постройки остался лишь камень из ее фундамента, на котором впоследствии была выбита надпись: «Здесь стоял дом, в котором родился Л. Н. Толстой».',
                'photo' => curl_file_create(__DIR__ . '/images/photo6.png'),
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Ого!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'В усадьбе произошел пожар':
        sendTelegram(
            'sendPhoto',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'caption' => 'Нет, пожара не было, а вот дом был продан. Большой яснополянский дом начал строить Николай Сергеевич Волконский, а закончил — Николай Ильич Толстой. В 1856 году этот дом был продан на своз. Его перевезли в село Долгое, где он простоял до 1913 года и был разобран за ветхостью. На месте постройки остался лишь камень из ее фундамента, на котором впоследствии была выбита надпись: «Здесь стоял дом, в котором родился Л. Н. Толстой».',
                'photo' => curl_file_create(__DIR__ . '/images/photo6.png'),
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Ого!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Ого!':
        sendTelegram(
            'sendPhoto',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'caption' => 'До 1857 года Толстого нет в усадьбе. В конце 1850-х годов он вышел в отставку и вернулся в Ясную, хотя и не жил там постоянно, много времени проводя в Петербурге и Москве. Он поселился в одном из флигелей, ставшем со временем домом для него и его семьи — в нем он прожил более 50 лет.',
                'photo' => curl_file_create(__DIR__ . '/images/photo7.png'),
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Конец!'],
                        ]
                    ]
                ])
            )
        );
        break;

    case 'Конец!':
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'Прочувствовать атмосферу Дома Толстого можно на обзорной экскурсии.',
                'reply_markup' => json_encode([
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Перезапустить квест'],
                        ]
                    ],
                    'inline_keyboard' => [
                        [
                            ['text' => 'Купить билет', 'url' => 'http://mirror.tickets.ypmus.ru/ru/#id=43'],
                        ]
                    ]
                ])
            )
        );
        break;


    default:
        sendTelegram(
            'sendMessage',
            array (
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'Не понимаю о чем вы :('
            )
        );
}
