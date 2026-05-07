<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Identity Provider.
 *
 * Maps to POST /api/identity-provider in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateIdentityProvider extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_identity_provider',
  'class' => 'FusionAuthCreateIdentityProvider',
  'method' => 'POST',
  'path' => '/api/identity-provider',
  'operation_id' => 'createIdentityProvider',
  'summary' => 'create Identity Provider',
  'description' => 'Creates an identity provider. You can optionally specify an Id for the identity provider, if not provided one will be generated.',
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
