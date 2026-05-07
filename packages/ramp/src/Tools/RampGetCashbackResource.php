<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a cashback payment.
 *
 * Maps to the official Ramp endpoint get /developer/v1/cashbacks/{cashback_id}.
 */
class RampGetCashbackResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_cashback_resource';
    protected const DESCRIPTION = 'Fetch a cashback payment

Official Ramp endpoint: GET /developer/v1/cashbacks/{cashback_id}';
    protected const PARAMETERS = array (
  'cashback_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `cashback_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/cashbacks/{cashback_id}';
    protected const PATH_PARAMS = array (
  'cashback_id' => 'cashback_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
