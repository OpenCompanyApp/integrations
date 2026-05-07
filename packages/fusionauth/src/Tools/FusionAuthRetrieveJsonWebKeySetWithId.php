<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Json Web Key Set With Id.
 *
 * Maps to GET /.well-known/jwks.json in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveJsonWebKeySetWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_json_web_key_set_with_id',
  'class' => 'FusionAuthRetrieveJsonWebKeySetWithId',
  'method' => 'GET',
  'path' => '/.well-known/jwks.json',
  'operation_id' => 'retrieveJsonWebKeySetWithId',
  'summary' => 'retrieve Json Web Key Set With Id',
  'description' => 'Returns public keys used by FusionAuth to cryptographically verify JWTs using the JSON Web Key format.',
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
