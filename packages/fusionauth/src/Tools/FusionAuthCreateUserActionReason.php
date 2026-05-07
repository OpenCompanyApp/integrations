<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Action Reason.
 *
 * Maps to POST /api/user-action-reason in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserActionReason extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_action_reason',
  'class' => 'FusionAuthCreateUserActionReason',
  'method' => 'POST',
  'path' => '/api/user-action-reason',
  'operation_id' => 'createUserActionReason',
  'summary' => 'create User Action Reason',
  'description' => 'Creates a user reason. This user action reason cannot be used when actioning a user until this call completes successfully. Anytime after that the user action reason can be used.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
