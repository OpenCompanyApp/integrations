<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Messenger With Id.
 *
 * Maps to GET /api/messenger/{messengerId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveMessengerWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_messenger_with_id',
  'class' => 'FusionAuthRetrieveMessengerWithId',
  'method' => 'GET',
  'path' => '/api/messenger/{messengerId}',
  'operation_id' => 'retrieveMessengerWithId',
  'summary' => 'retrieve Messenger With Id',
  'description' => 'Retrieves the messenger with the given Id.',
  'parameters' =>
  array (
    'messenger_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the messenger.',
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
  'type' => 'read',
);
}
