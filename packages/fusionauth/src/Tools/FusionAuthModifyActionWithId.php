<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * modify Action With Id.
 *
 * Maps to PUT /api/user/action/{actionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthModifyActionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_modify_action_with_id',
  'class' => 'FusionAuthModifyActionWithId',
  'method' => 'PUT',
  'path' => '/api/user/action/{actionId}',
  'operation_id' => 'modifyActionWithId',
  'summary' => 'modify Action With Id',
  'description' => 'Modifies a temporal user action by changing the expiration of the action and optionally adding a comment to the action.',
  'parameters' =>
  array (
    'action_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the action to modify. This is technically the user action log Id.',
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
    'actionId' => 'action_id',
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
