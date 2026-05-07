<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Accept Quote (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/convert/acceptQuote.
 */
class BinancePostSapiV1ConvertAcceptquote extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_convert_acceptquote';
    protected const DESCRIPTION = 'Accept Quote (TRADE)

Accept the offered quote by quote ID. Weight(UID): 500

Official Binance Spot endpoint: POST /sapi/v1/convert/acceptQuote.';
    protected const PARAMETERS = [
        'quote_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `quoteId`.',
        ],
        'recv_window' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The value cannot be greater than 60000',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/convert/acceptQuote';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'quoteId' => 'quote_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
