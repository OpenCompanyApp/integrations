<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove organization JIT SSO connector.
 *
 * Maps to DELETE /api/organizations/{id}/jit/sso-connectors/{ssoConnectorId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationJitSsoConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_jit_sso_connector',
  'class' => 'LogtoDeleteOrganizationJitSsoConnector',
  'method' => 'DELETE',
  'path' => '/api/organizations/{id}/jit/sso-connectors/{ssoConnectorId}',
  'operation_id' => 'DeleteOrganizationJitSsoConnector',
  'summary' => 'Remove organization JIT SSO connector',
  'description' => 'Remove an enterprise SSO connector for just-in-time provisioning of users in the organization.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'sso_connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the sso connector.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'ssoConnectorId' => 'sso_connector_id',
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
