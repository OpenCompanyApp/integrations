<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization JIT SSO connectors.
 *
 * Maps to GET /api/organizations/{id}/jit/sso-connectors in the official Logto OpenAPI source.
 */
class LogtoListOrganizationJitSsoConnectors extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_jit_sso_connectors',
  'class' => 'LogtoListOrganizationJitSsoConnectors',
  'method' => 'GET',
  'path' => '/api/organizations/{id}/jit/sso-connectors',
  'operation_id' => 'ListOrganizationJitSsoConnectors',
  'summary' => 'Get organization JIT SSO connectors',
  'description' => 'Get enterprise SSO connectors for just-in-time provisioning of users in the organization.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'page' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Page number (starts from 1).',
    ),
    'page_size' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Entries per page.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'page_size' => 'page_size',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
