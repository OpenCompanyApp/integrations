<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Keys With Id.
 *
 * Maps to GET /api/key in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveKeysWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_keys_with_id',
  'class' => 'FusionAuthRetrieveKeysWithId',
  'method' => 'GET',
  'path' => '/api/key',
  'operation_id' => 'retrieveKeysWithId',
  'summary' => 'retrieve Keys With Id',
  'description' => 'Retrieves all the keys.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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
