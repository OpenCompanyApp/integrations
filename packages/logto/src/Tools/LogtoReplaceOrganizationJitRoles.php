<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Replace organization JIT default roles.
 *
 * Maps to PUT /api/organizations/{id}/jit/roles in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationJitRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_jit_roles',
  'class' => 'LogtoReplaceOrganizationJitRoles',
  'method' => 'PUT',
  'path' => '/api/organizations/{id}/jit/roles',
  'operation_id' => 'ReplaceOrganizationJitRoles',
  'summary' => 'Replace organization JIT default roles',
  'description' => 'Replace all organization roles that will be assigned to users during just-in-time provisioning with the given data.',
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
