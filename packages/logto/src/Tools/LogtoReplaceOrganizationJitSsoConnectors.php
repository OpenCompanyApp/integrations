<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Replace organization JIT SSO connectors.
 *
 * Maps to PUT /api/organizations/{id}/jit/sso-connectors in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationJitSsoConnectors extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_jit_sso_connectors',
  'class' => 'LogtoReplaceOrganizationJitSsoConnectors',
  'method' => 'PUT',
  'path' => '/api/organizations/{id}/jit/sso-connectors',
  'operation_id' => 'ReplaceOrganizationJitSsoConnectors',
  'summary' => 'Replace organization JIT SSO connectors',
  'description' => 'Replace all enterprise SSO connectors for just-in-time provisioning of users in the organization with the given data.',
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
