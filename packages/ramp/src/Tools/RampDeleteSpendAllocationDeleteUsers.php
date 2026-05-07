<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Remove users from a shared limit.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/limits/{spend_limit_id}/delete-users.
 */
class RampDeleteSpendAllocationDeleteUsers extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_spend_allocation_delete_users';
    protected const DESCRIPTION = 'Remove users from a shared limit

Official Ramp endpoint: DELETE /developer/v1/limits/{spend_limit_id}/delete-users';
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
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/limits/{spend_limit_id}/delete-users';
    protected const PATH_PARAMS = array (
  'spend_limit_id' => 'spend_limit_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
