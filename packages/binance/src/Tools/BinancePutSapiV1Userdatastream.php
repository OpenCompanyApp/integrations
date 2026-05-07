<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Ping/Keep-alive a ListenKey (USER_STREAM).
 *
 * Maps to the official Binance Spot endpoint PUT /sapi/v1/userDataStream.
 */
class BinancePutSapiV1Userdatastream extends AbstractBinanceTool
{
    protected const NAME = 'binance_put_sapi_v1_userdatastream';
    protected const DESCRIPTION = 'Ping/Keep-alive a ListenKey (USER_STREAM)

Keepalive a user data stream to prevent a time out. User data streams will close after 60 minutes. It\'s recommended to send a ping about every 30 minutes. Weight: 1

Official Binance Spot endpoint: PUT /sapi/v1/userDataStream.';
    protected const PARAMETERS = [
        'listen_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'User websocket listen key',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/sapi/v1/userDataStream';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'listenKey' => 'listen_key',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
