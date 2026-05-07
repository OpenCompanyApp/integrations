<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Reactivate a user.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/users/{user_id}/reactivate.
 */
class RampPatchUserReactivationResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_user_reactivation_resource';
    protected const DESCRIPTION = 'Reactivate a user

Official Ramp endpoint: PATCH /developer/v1/users/{user_id}/reactivate

Upon reactivation, users can log in to Ramp again, spend on their previously issued cards and resume receiving Ramp notifications.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/users/{user_id}/reactivate';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
