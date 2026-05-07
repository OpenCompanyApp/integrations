<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Ping/Keep-alive a Listen Key (USER_STREAM).
 *
 * Maps to the official Binance Spot endpoint PUT /sapi/v1/userDataStream/isolated.
 */
class BinancePutSapiV1UserdatastreamIsolated extends AbstractBinanceTool
{
    protected const NAME = 'binance_put_sapi_v1_userdatastream_isolated';
    protected const DESCRIPTION = 'Ping/Keep-alive a Listen Key (USER_STREAM)

Keepalive a user data stream to prevent a time out. User data streams will close after 60 minutes. It\'s recommended to send a ping about every 30 minutes. Weight: 1

Official Binance Spot endpoint: PUT /sapi/v1/userDataStream/isolated.';
    protected const PARAMETERS = [
        'listen_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'User websocket listen key',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/sapi/v1/userDataStream/isolated';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'listenKey' => 'listen_key',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
