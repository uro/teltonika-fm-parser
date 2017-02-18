# Teltonika FM-XXXX Parser 

[![Build Status](https://travis-ci.org/uro/teltonika-fm-parser.svg?branch=master)](https://travis-ci.org/uro/teltonika-fm-parser)

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

Authentication decode:
```php
// Recieve data from tcp socket
$payloadFromDevice = "000F313233343536373839303132333435";

// Decode recieved data
$decoder = new TcpDecoder();

// Check if data which we recieved are authentication or Gps records
if($decoder->isAuthentication($payloadFromDevice)){ // returns true;
    
    $imei = $decoder->decodeAuthentication($payloadFromDevice);
    echo json_encode(imei);
    
    // Check if device is authenticated in your system, and then encode response for device
    $encoder = new TcpEncoder();
    $payload = $encoder->encodeAuthentication(true); // Yes, device was authenticated successfully

    // send $payload though the socket.
}
```
Echo will return:
```json
{
    "imei": "862259588834290"
}
```

```php
// Now we need to wait for next data from the device

// Recieve next payload from the socket (now with data)
$tcpPayloadFromDevice = "00000000000000FE080400000113fc208dff000f14f650209cca80006f...";

// Decode it
$data = $this->decoder->decodeData($payload);

echo json_encode(data);
```
Echo will return:
```json
[{
	"dateTime": {
		"date": "2007-07-25 06:46:38.000000",
		"timezone_type": 3,
		"timezone": "UTC"
	},
	"priority": 0,
	"gpsData": {
		"longitude": 25.3032016,
		"latitude": 54.7146368,
		"altitude": 111,
		"angle": 214,
		"satellites": 4,
		"speed": 4,
		"hasGpsFix": true
	}
}, {
	"dateTime": {
		"date": "2007-07-25 06:46:38.000000",
		"timezone_type": 3,
		"timezone": "UTC"
	},
	"priority": 0,
	"gpsData": {
		"longitude": 25.3032016,
		"latitude": 54.7146368,
		"altitude": 111,
		"angle": 214,
		"satellites": 4,
		"speed": 4,
		"hasGpsFix": true
	}
}]
```

See tests for more examples!

## Todo:

- [x] Implement TCP protocol (encode and decode)
- [ ] Implement gps sensors data (IOElement)
- [ ] Implement UDP protocol (encode and decode)
- [ ] Implement SMS protocol

## License:

[Public domain](LICENSE.md)
