<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Action Reason With Id.
 *
 * Maps to GET /api/user-action-reason/{userActionReasonId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserActionReasonWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_action_reason_with_id',
  'class' => 'FusionAuthRetrieveUserActionReasonWithId',
  'method' => 'GET',
  'path' => '/api/user-action-reason/{userActionReasonId}',
  'operation_id' => 'retrieveUserActionReasonWithId',
  'summary' => 'retrieve User Action Reason With Id',
  'description' => 'Retrieves the user action reason for the given Id. If you pass in null for the Id, this will return all the user action reasons.',
  'parameters' =>
  array (
    'user_action_reason_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user action reason.',
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
  'type' => 'read',
);
}
