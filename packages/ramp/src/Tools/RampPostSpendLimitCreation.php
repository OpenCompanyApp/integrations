<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a limit.
 *
 * Maps to the official Ramp endpoint post /developer/v1/limits/deferred.
 */
class RampPostSpendLimitCreation extends AbstractRampTool
{
    protected const NAME = 'ramp_post_spend_limit_creation';
    protected const DESCRIPTION = 'Create a limit

Official Ramp endpoint: POST /developer/v1/limits/deferred

Limit may either be created with spend program id (can provide display name and spending restrictions, cannot permitted spend types) or without (must provide display name, spending restrictions, and permitted spend types).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/limits/deferred';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
