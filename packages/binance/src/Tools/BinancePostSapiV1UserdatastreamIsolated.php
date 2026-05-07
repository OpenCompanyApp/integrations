<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Generate a Listen Key (USER_STREAM).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/userDataStream/isolated.
 */
class BinancePostSapiV1UserdatastreamIsolated extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_userdatastream_isolated';
    protected const DESCRIPTION = 'Generate a Listen Key (USER_STREAM)

Start a new user data stream. The stream will close after 60 minutes unless a keepalive is sent. If the account has an active `listenKey`, that `listenKey` will be returned and its validity will be extended for 60 minutes. Weight: 1

Official Binance Spot endpoint: POST /sapi/v1/userDataStream/isolated.';
    protected const PARAMETERS = [];
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/userDataStream/isolated';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
