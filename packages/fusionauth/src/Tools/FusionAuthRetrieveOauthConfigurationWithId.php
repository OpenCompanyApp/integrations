<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Oauth Configuration With Id.
 *
 * Maps to GET /api/application/{applicationId}/oauth-configuration in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveOauthConfigurationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_oauth_configuration_with_id',
  'class' => 'FusionAuthRetrieveOauthConfigurationWithId',
  'method' => 'GET',
  'path' => '/api/application/{applicationId}/oauth-configuration',
  'operation_id' => 'retrieveOauthConfigurationWithId',
  'summary' => 'retrieve Oauth Configuration With Id',
  'description' => 'Retrieves the Oauth2 configuration for the application for the given Application Id.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the Application to retrieve OAuth configuration.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
  ),
  'path_params' =>
  array (
    'applicationId' => 'application_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
