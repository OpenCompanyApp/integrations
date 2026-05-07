<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a limit.
 *
 * Maps to the official Ramp endpoint get /developer/v1/limits/{spend_limit_id}.
 */
class RampGetSpendLimitResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_spend_limit_resource';
    protected const DESCRIPTION = 'Fetch a limit

Official Ramp endpoint: GET /developer/v1/limits/{spend_limit_id}';
    protected const PARAMETERS = array (
  'spend_limit_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `spend_limit_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/limits/{spend_limit_id}';
    protected const PATH_PARAMS = array (
  'spend_limit_id' => 'spend_limit_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
