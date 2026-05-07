<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * cancel Action With Id.
 *
 * Maps to DELETE /api/user/action/{actionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCancelActionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_cancel_action_with_id',
  'class' => 'FusionAuthCancelActionWithId',
  'method' => 'DELETE',
  'path' => '/api/user/action/{actionId}',
  'operation_id' => 'cancelActionWithId',
  'summary' => 'cancel Action With Id',
  'description' => 'Cancels the user action.',
  'parameters' =>
  array (
    'action_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The action Id of the action to cancel.',
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
