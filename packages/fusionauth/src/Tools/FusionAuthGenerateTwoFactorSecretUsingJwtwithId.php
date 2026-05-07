<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * generate Two Factor Secret Using JWTWith Id.
 *
 * Maps to GET /api/two-factor/secret in the official FusionAuth OpenAPI document.
 */
class FusionAuthGenerateTwoFactorSecretUsingJwtwithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_generate_two_factor_secret_using_jwtwith_id',
  'class' => 'FusionAuthGenerateTwoFactorSecretUsingJwtwithId',
  'method' => 'GET',
  'path' => '/api/two-factor/secret',
  'operation_id' => 'generateTwoFactorSecretUsingJWTWithId',
  'summary' => 'generate Two Factor Secret Using JWTWith Id',
  'description' => 'Generate a Two Factor secret that can be used to enable Two Factor authentication for a User. The response will contain both the secret and a Base32 encoded form of the secret which can be shown to a User when using a 2 Step Authentication application such as Google Authenticator.',
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
