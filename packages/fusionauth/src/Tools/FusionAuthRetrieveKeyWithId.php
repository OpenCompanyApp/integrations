<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Key With Id.
 *
 * Maps to GET /api/key/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveKeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_key_with_id',
  'class' => 'FusionAuthRetrieveKeyWithId',
  'method' => 'GET',
  'path' => '/api/key/{keyId}',
  'operation_id' => 'retrieveKeyWithId',
  'summary' => 'retrieve Key With Id',
  'description' => 'Retrieves the key for the given Id.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the key.',
    ),
  ),
  'path_params' =>
  array (
    'keyId' => 'key_id',
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
