<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * ping api.
 *
 * Maps to the official Modern Treasury endpoint get /api/ping.
 */
class ModernTreasuryPingAPI extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_ping_api';
    protected const DESCRIPTION = 'ping api

Official Modern Treasury endpoint: GET /api/ping

A test endpoint often used to confirm credentials and headers are being passed in correctly.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ping';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
