<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add organization JIT SSO connectors.
 *
 * Maps to POST /api/organizations/{id}/jit/sso-connectors in the official Logto OpenAPI source.
 */
class LogtoCreateOrganizationJitSsoConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization_jit_sso_connector',
  'class' => 'LogtoCreateOrganizationJitSsoConnector',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/jit/sso-connectors',
  'operation_id' => 'CreateOrganizationJitSsoConnector',
  'summary' => 'Add organization JIT SSO connectors',
  'description' => 'Add new enterprise SSO connectors for just-in-time provisioning of users in the organization.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
