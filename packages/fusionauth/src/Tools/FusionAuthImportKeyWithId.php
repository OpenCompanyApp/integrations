<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * import Key With Id.
 *
 * Maps to POST /api/key/import/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthImportKeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_import_key_with_id',
  'class' => 'FusionAuthImportKeyWithId',
  'method' => 'POST',
  'path' => '/api/key/import/{keyId}',
  'operation_id' => 'importKeyWithId',
  'summary' => 'import Key With Id',
  'description' => 'Import an existing RSA or EC key pair or an HMAC secret.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the key. If not provided a secure random UUID will be generated.',
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
    'keyId' => 'key_id',
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
