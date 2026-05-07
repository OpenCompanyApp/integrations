<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Margin manual liquidation(MARGIN).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/margin/manual-liquidation.
 */
class BinancePostSapiV1MarginManualLiquidation extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_margin_manual_liquidation';
    protected const DESCRIPTION = 'Margin manual liquidation(MARGIN)

Margin manual liquidation Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/margin/manual-liquidation.';
    protected const PARAMETERS = [
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `type`.',
            'enum' => [
                'MARGIN',
                'ISOLATED',
            ],
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `symbol`.',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/margin/manual-liquidation';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'type' => 'type',
        'symbol' => 'symbol',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
