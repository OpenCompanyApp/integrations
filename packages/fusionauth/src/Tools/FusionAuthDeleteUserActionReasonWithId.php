<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete User Action Reason With Id.
 *
 * Maps to DELETE /api/user-action-reason/{userActionReasonId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteUserActionReasonWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_user_action_reason_with_id',
  'class' => 'FusionAuthDeleteUserActionReasonWithId',
  'method' => 'DELETE',
  'path' => '/api/user-action-reason/{userActionReasonId}',
  'operation_id' => 'deleteUserActionReasonWithId',
  'summary' => 'delete User Action Reason With Id',
  'description' => 'Deletes the user action reason for the given Id.',
  'parameters' =>
  array (
    'user_action_reason_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user action reason to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
