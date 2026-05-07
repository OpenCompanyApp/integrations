<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Terminate a limit.
 *
 * Maps to the official Ramp endpoint post /developer/v1/limits/{spend_limit_id}/deferred/termination.
 */
class RampPostSpendLimitTerminationResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_spend_limit_termination_resource';
    protected const DESCRIPTION = 'Terminate a limit

Official Ramp endpoint: POST /developer/v1/limits/{spend_limit_id}/deferred/termination

This endpoint creates an async task to terminate a limit permanently.';
    protected const PARAMETERS = array (
  'spend_limit_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `spend_limit_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/limits/{spend_limit_id}/deferred/termination';
    protected const PATH_PARAMS = array (
  'spend_limit_id' => 'spend_limit_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
