<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Key With Id.
 *
 * Maps to DELETE /api/key/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteKeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_key_with_id',
  'class' => 'FusionAuthDeleteKeyWithId',
  'method' => 'DELETE',
  'path' => '/api/key/{keyId}',
  'operation_id' => 'deleteKeyWithId',
  'summary' => 'delete Key With Id',
  'description' => 'Deletes the key for the given Id.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the key to delete.',
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
  'type' => 'write',
);
}
