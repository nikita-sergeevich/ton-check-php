# ton-check-php

This is an example of implementing a TON wallet connection with signature verification and user-friendly address transfer to the database.

To work correctly, you need to pass the GET parameter 'link' to the page index.html
This parameter is used to link the wallet to a specific row in the database. You can use, for example, `md5('YOUR_SALT'.$id);`

Request example: `https://example.com/?link=1afa148eb41f2e7103f21410bf48346c`

All used API are connected via CDN:
* [jQuery Core 3.7.1](https://releases.jquery.com/)
* [TON Connect UI](https://ton-connect.github.io/sdk/modules/_tonconnect_ui.html)
* [TON Access(tonweb.js)](https://www.orbs.com/ton-access/) by [Orbs](https://github.com/orbs-network)

The code of [Vladimir Fokin](https://github.com/vladimirfokingithub/Ton-Connect-Proof-Php-Check) and [mlmcoder](https://ru.stackoverflow.com/questions/1536914/1542252#1542252) is used as a basis and was modified, linked and adapted.

-----------

Пример реализации подключения TON-кошелька с проверкой подписи и передачей читабельного адреса в базу данных.

Для корректной работы необходимо передавать GET-параметр 'link' на страницу index.html
Этот параметр используется для привязки кошелька к конкретной строке в БД. Можно использовать, например `md5('YOUR_SALT'.$id);`

Пример запроса: `https://example.com/?link=1afa148eb41f2e7103f21410bf48346c`

Все использованные API подключены через CDN:
* [jQuery Core 3.7.1](https://releases.jquery.com/)
* [TON Connect UI](https://ton-connect.github.io/sdk/modules/_tonconnect_ui.html)
* [TON Access(tonweb.js)](https://www.orbs.com/ton-access/) от [Orbs](https://github.com/orbs-network)

За основу взят код [Vladimir Fokin](https://github.com/vladimirfokingithub/Ton-Connect-Proof-Php-Check) и [mlmcoder](https://ru.stackoverflow.com/questions/1536914/1542252#1542252), доработан, связан и адаптирован.