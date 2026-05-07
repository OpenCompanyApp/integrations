<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * start Identity Provider Login With Id.
 *
 * Maps to POST /api/identity-provider/start in the official FusionAuth OpenAPI document.
 */
class FusionAuthStartIdentityProviderLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_start_identity_provider_login_with_id',
  'class' => 'FusionAuthStartIdentityProviderLoginWithId',
  'method' => 'POST',
  'path' => '/api/identity-provider/start',
  'operation_id' => 'startIdentityProviderLoginWithId',
  'summary' => 'start Identity Provider Login With Id',
  'description' => 'Begins a login request for a 3rd party login that requires user interaction such as HYPR.',
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
