<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Messenger With Id.
 *
 * Maps to POST /api/messenger/{messengerId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateMessengerWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_messenger_with_id',
  'class' => 'FusionAuthCreateMessengerWithId',
  'method' => 'POST',
  'path' => '/api/messenger/{messengerId}',
  'operation_id' => 'createMessengerWithId',
  'summary' => 'create Messenger With Id',
  'description' => 'Creates a messenger. You can optionally specify an Id for the messenger, if not provided one will be generated.',
  'parameters' =>
  array (
    'messenger_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the messenger. If not provided a secure random UUID will be generated.',
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
