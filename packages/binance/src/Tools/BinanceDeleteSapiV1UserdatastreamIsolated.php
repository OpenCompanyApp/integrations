<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Close a ListenKey (USER_STREAM).
 *
 * Maps to the official Binance Spot endpoint DELETE /sapi/v1/userDataStream/isolated.
 */
class BinanceDeleteSapiV1UserdatastreamIsolated extends AbstractBinanceTool
{
    protected const NAME = 'binance_delete_sapi_v1_userdatastream_isolated';
    protected const DESCRIPTION = 'Close a ListenKey (USER_STREAM)

Close out a user data stream. Weight: 1

Official Binance Spot endpoint: DELETE /sapi/v1/userDataStream/isolated.';
    protected const PARAMETERS = [
        'listen_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'User websocket listen key',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/sapi/v1/userDataStream/isolated';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'listenKey' => 'listen_key',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
