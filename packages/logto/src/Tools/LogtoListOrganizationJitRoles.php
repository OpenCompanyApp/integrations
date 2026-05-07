<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization JIT default roles.
 *
 * Maps to GET /api/organizations/{id}/jit/roles in the official Logto OpenAPI source.
 */
class LogtoListOrganizationJitRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_jit_roles',
  'class' => 'LogtoListOrganizationJitRoles',
  'method' => 'GET',
  'path' => '/api/organizations/{id}/jit/roles',
  'operation_id' => 'ListOrganizationJitRoles',
  'summary' => 'Get organization JIT default roles',
  'description' => 'Get organization roles that will be assigned to users during just-in-time provisioning.',
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
