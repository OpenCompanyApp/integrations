<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Messenger With Id.
 *
 * Maps to PATCH /api/messenger/{messengerId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchMessengerWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_messenger_with_id',
  'class' => 'FusionAuthPatchMessengerWithId',
  'method' => 'PATCH',
  'path' => '/api/messenger/{messengerId}',
  'operation_id' => 'patchMessengerWithId',
  'summary' => 'patch Messenger With Id',
  'description' => 'Updates, via PATCH, the messenger with the given Id.',
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
