<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Jwt Public Key.
 *
 * Maps to GET /api/jwt/public-key in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveJwtPublicKey extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_jwt_public_key',
  'class' => 'FusionAuthRetrieveJwtPublicKey',
  'method' => 'GET',
  'path' => '/api/jwt/public-key',
  'operation_id' => 'retrieveJwtPublicKey',
  'summary' => 'retrieve Jwt Public Key',
  'description' => 'Retrieves the Public Key configured for verifying the JSON Web Tokens (JWT) issued by the Login API by the Application Id. OR Retrieves the Public Key configured for verifying JSON Web Tokens (JWT) by the key Id (kid).',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Id of the Application for which this key is used.',
    ),
    'key_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Id of the public key (kid).',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'applicationId' => 'application_id',
    'keyId' => 'key_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
