# Teltonika FM-XXXX Parser 

[![Build Status](https://travis-ci.org/uro/teltonika-fm-parser.svg?branch=master)](https://travis-ci.org/uro/teltonika-fm-parser) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/uro/teltonika-fm-parser/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/uro/teltonika-fm-parser/?branch=master) [![CodeFactor](https://www.codefactor.io/repository/github/uro/teltonika-fm-parser/badge)](https://www.codefactor.io/repository/github/uro/teltonika-fm-parser) [![Latest Stable Version](https://poser.pugx.org/uro/teltonika-fm-parser/v/stable)](https://packagist.org/packages/uro/teltonika-fm-parser) [![Total Downloads](https://poser.pugx.org/uro/teltonika-fm-parser/downloads)](https://packagist.org/packages/uro/teltonika-fm-parser)

This repository is object oriented library to translate Teltonika protocols.

You could use this library in your server, it will help you talk with Teltonika devices.

It was build with [Teltonika protocols v2.10](FMXXXX_Protocols_v2.10.pdf) documentation.

## Requirements:

```json
{
    "require": {
        "php": ">=7.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^5.7"
    }
}
```

## Usage:

```php
$parser = new FmParser('tcp');

// Decode IMEI
$imei = $parser->decodeImei($payload);

// Decode Data Packet
$packet = $parser->decodeData($payload);
```

## Examples

### TCP

```php
	$parser = new FmParser('tcp');
	$socket = stream_socket_server("tcp://0.0.0.0:8043", $errno, $errstr);
	if (!$socket) {
		throw new \Exception("$errstr ($errno)");
	} else {
		while ($conn = stream_socket_accept($socket)) {

			// Read IMEI
			$payload = fread($conn, 1024);
			$imei = $parser->decodeImei($payload);

			// Accept packet
			fwrite($conn, Reply::accept());

			// Decline packet
			// fwrite($conn, Reply::reject());
			
			// Read Data
			$payload = fread($conn, 1024);
			$packet = $parser->decodeData($payload);

			// Send acknowledge
			fwrite($conn, $parser->encodeAcknowledge($packet));

			// Close connection
			fclose($conn);
		}

		fclose($socket);
	}
}
```



## License:

[Public domain](LICENSE.md)
