<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch deferred task status.
 *
 * Maps to the official Ramp endpoint get /developer/v1/limits/deferred/status/{task_id}.
 */
class RampGetSpendLimitDeferredTaskStatus extends AbstractRampTool
{
    protected const NAME = 'ramp_get_spend_limit_deferred_task_status';
    protected const DESCRIPTION = 'Fetch deferred task status

Official Ramp endpoint: GET /developer/v1/limits/deferred/status/{task_id}';
    protected const PARAMETERS = array (
  'task_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `task_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/limits/deferred/status/{task_id}';
    protected const PATH_PARAMS = array (
  'task_id' => 'task_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
