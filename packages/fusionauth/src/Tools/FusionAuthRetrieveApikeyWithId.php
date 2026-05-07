<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve APIKey With Id.
 *
 * Maps to GET /api/api-key/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveApikeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_apikey_with_id',
  'class' => 'FusionAuthRetrieveApikeyWithId',
  'method' => 'GET',
  'path' => '/api/api-key/{keyId}',
  'operation_id' => 'retrieveAPIKeyWithId',
  'summary' => 'retrieve APIKey With Id',
  'description' => 'Retrieves an authentication API key for the given Id.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the API key to retrieve.',
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
