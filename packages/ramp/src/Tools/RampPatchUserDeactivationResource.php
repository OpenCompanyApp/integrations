<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Deactivate a user.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/users/{user_id}/deactivate.
 */
class RampPatchUserDeactivationResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_user_deactivation_resource';
    protected const DESCRIPTION = 'Deactivate a user

Official Ramp endpoint: PATCH /developer/v1/users/{user_id}/deactivate

When users are deactivated, they will no longer be able to log in, spend on cards, or receive any notifications from Ramp.';
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
    protected const PATH = '/developer/v1/users/{user_id}/deactivate';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
