<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch the company balance information.
 *
 * Maps to the official Ramp endpoint get /developer/v1/business/balance.
 */
class RampGetBusinessBalanceResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_business_balance_resource';
    protected const DESCRIPTION = 'Fetch the company balance information

Official Ramp endpoint: GET /developer/v1/business/balance';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/business/balance';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
