<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * import Key.
 *
 * Maps to POST /api/key/import in the official FusionAuth OpenAPI document.
 */
class FusionAuthImportKey extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_import_key',
  'class' => 'FusionAuthImportKey',
  'method' => 'POST',
  'path' => '/api/key/import',
  'operation_id' => 'importKey',
  'summary' => 'import Key',
  'description' => 'Import an existing RSA or EC key pair or an HMAC secret.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
