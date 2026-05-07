<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Add new users into a shared limit.
 *
 * Maps to the official Ramp endpoint put /developer/v1/limits/{spend_limit_id}/add-users.
 */
class RampPutSpendAllocationAddUsers extends AbstractRampTool
{
    protected const NAME = 'ramp_put_spend_allocation_add_users';
    protected const DESCRIPTION = 'Add new users into a shared limit

Official Ramp endpoint: PUT /developer/v1/limits/{spend_limit_id}/add-users';
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
    protected const METHOD = 'put';
    protected const PATH = '/developer/v1/limits/{spend_limit_id}/add-users';
    protected const PATH_PARAMS = array (
  'spend_limit_id' => 'spend_limit_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
