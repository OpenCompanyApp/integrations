<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Messenger With Id.
 *
 * Maps to PUT /api/messenger/{messengerId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateMessengerWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_messenger_with_id',
  'class' => 'FusionAuthUpdateMessengerWithId',
  'method' => 'PUT',
  'path' => '/api/messenger/{messengerId}',
  'operation_id' => 'updateMessengerWithId',
  'summary' => 'update Messenger With Id',
  'description' => 'Updates the messenger with the given Id.',
  'parameters' =>
  array (
    'messenger_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the messenger to update.',
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
    'messengerId' => 'messenger_id',
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
