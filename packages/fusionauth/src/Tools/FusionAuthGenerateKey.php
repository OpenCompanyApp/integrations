<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * generate Key.
 *
 * Maps to POST /api/key/generate in the official FusionAuth OpenAPI document.
 */
class FusionAuthGenerateKey extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_generate_key',
  'class' => 'FusionAuthGenerateKey',
  'method' => 'POST',
  'path' => '/api/key/generate',
  'operation_id' => 'generateKey',
  'summary' => 'generate Key',
  'description' => 'Generate a new RSA or EC key pair or an HMAC secret.',
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
