<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * List all the supported SSO connector provider details.
 *
 * Maps to GET /api/sso-connector-providers in the official Logto OpenAPI source.
 */
class LogtoListSsoConnectorProviders extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_sso_connector_providers',
  'class' => 'LogtoListSsoConnectorProviders',
  'method' => 'GET',
  'path' => '/api/sso-connector-providers',
  'operation_id' => 'ListSsoConnectorProviders',
  'summary' => 'List all the supported SSO connector provider details',
  'description' => 'Get a complete list of supported SSO connector providers.',
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
