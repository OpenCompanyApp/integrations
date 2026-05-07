<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Ping/Keep-alive a ListenKey (USER_STREAM).
 *
 * Maps to the official Binance Spot endpoint PUT /api/v3/userDataStream.
 */
class BinancePutApiV3Userdatastream extends AbstractBinanceTool
{
    protected const NAME = 'binance_put_api_v3_userdatastream';
    protected const DESCRIPTION = 'Ping/Keep-alive a ListenKey (USER_STREAM)

Keepalive a user data stream to prevent a time out. User data streams will close after 60 minutes. It\'s recommended to send a ping about every 30 minutes. Weight: 2

Official Binance Spot endpoint: PUT /api/v3/userDataStream.';
    protected const PARAMETERS = [
        'listen_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'User websocket listen key',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/userDataStream';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'listenKey' => 'listen_key',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
