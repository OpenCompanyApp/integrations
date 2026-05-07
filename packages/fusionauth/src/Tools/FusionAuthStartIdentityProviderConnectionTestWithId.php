<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * start Identity Provider Connection Test With Id.
 *
 * Maps to POST /api/identity-provider/test in the official FusionAuth OpenAPI document.
 */
class FusionAuthStartIdentityProviderConnectionTestWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_start_identity_provider_connection_test_with_id',
  'class' => 'FusionAuthStartIdentityProviderConnectionTestWithId',
  'method' => 'POST',
  'path' => '/api/identity-provider/test',
  'operation_id' => 'startIdentityProviderConnectionTestWithId',
  'summary' => 'start Identity Provider Connection Test With Id',
  'description' => 'Begins an identity provider connection test.',
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
