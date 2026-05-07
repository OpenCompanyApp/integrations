<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * generate Key With Id.
 *
 * Maps to POST /api/key/generate/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthGenerateKeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_generate_key_with_id',
  'class' => 'FusionAuthGenerateKeyWithId',
  'method' => 'POST',
  'path' => '/api/key/generate/{keyId}',
  'operation_id' => 'generateKeyWithId',
  'summary' => 'generate Key With Id',
  'description' => 'Generate a new RSA or EC key pair or an HMAC secret.',
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
