<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Messenger With Id.
 *
 * Maps to DELETE /api/messenger/{messengerId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteMessengerWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_messenger_with_id',
  'class' => 'FusionAuthDeleteMessengerWithId',
  'method' => 'DELETE',
  'path' => '/api/messenger/{messengerId}',
  'operation_id' => 'deleteMessengerWithId',
  'summary' => 'delete Messenger With Id',
  'description' => 'Deletes the messenger for the given Id.',
  'parameters' =>
  array (
    'messenger_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the messenger to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
