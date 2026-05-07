<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Create a ListenKey (USER_STREAM).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/userDataStream.
 */
class BinancePostSapiV1Userdatastream extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_userdatastream';
    protected const DESCRIPTION = 'Create a ListenKey (USER_STREAM)

Start a new user data stream. The stream will close after 60 minutes unless a keepalive is sent. If the account has an active `listenKey`, that `listenKey` will be returned and its validity will be extended for 60 minutes. Weight: 1

Official Binance Spot endpoint: POST /sapi/v1/userDataStream.';
    protected const PARAMETERS = [];
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/userDataStream';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
