<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Action With Id.
 *
 * Maps to GET /api/user/action/{actionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveActionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_action_with_id',
  'class' => 'FusionAuthRetrieveActionWithId',
  'method' => 'GET',
  'path' => '/api/user/action/{actionId}',
  'operation_id' => 'retrieveActionWithId',
  'summary' => 'retrieve Action With Id',
  'description' => 'Retrieves a single action log (the log of a user action that was taken on a user previously) for the given Id.',
  'parameters' =>
  array (
    'action_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the action to retrieve.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
