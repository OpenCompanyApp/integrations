<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Token.
 *
 * Maps to POST /oauth2/token in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateToken extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_token',
  'class' => 'FusionAuthCreateToken',
  'method' => 'POST',
  'path' => '/oauth2/token',
  'operation_id' => 'createToken',
  'summary' => 'create Token',
  'description' => 'Exchange User Credentials for a Token. If you will be using the Resource Owner Password Credential Grant, you will make a request to the Token endpoint to exchange the user\'s email and password for an access token. OR Exchange User Credentials for a Token. If you will be using the Resource Owner Password Credential Grant, you will make a request to the Token endpoint to exchange the user\'s email and password for an access token. OR Exchange a Refresh Token for an Access Token. If you will be usi',
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
  'type' => 'write',
);
}
