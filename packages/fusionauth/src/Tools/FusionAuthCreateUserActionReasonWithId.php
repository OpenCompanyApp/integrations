<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Action Reason With Id.
 *
 * Maps to POST /api/user-action-reason/{userActionReasonId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserActionReasonWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_action_reason_with_id',
  'class' => 'FusionAuthCreateUserActionReasonWithId',
  'method' => 'POST',
  'path' => '/api/user-action-reason/{userActionReasonId}',
  'operation_id' => 'createUserActionReasonWithId',
  'summary' => 'create User Action Reason With Id',
  'description' => 'Creates a user reason. This user action reason cannot be used when actioning a user until this call completes successfully. Anytime after that the user action reason can be used.',
  'parameters' =>
  array (
    'user_action_reason_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the user action reason. If not provided a secure random UUID will be generated.',
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
