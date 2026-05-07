<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch User Action Reason With Id.
 *
 * Maps to PATCH /api/user-action-reason/{userActionReasonId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchUserActionReasonWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_user_action_reason_with_id',
  'class' => 'FusionAuthPatchUserActionReasonWithId',
  'method' => 'PATCH',
  'path' => '/api/user-action-reason/{userActionReasonId}',
  'operation_id' => 'patchUserActionReasonWithId',
  'summary' => 'patch User Action Reason With Id',
  'description' => 'Updates, via PATCH, the user action reason with the given Id.',
  'parameters' =>
  array (
    'user_action_reason_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user action reason to update.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'userActionReasonId' => 'user_action_reason_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
