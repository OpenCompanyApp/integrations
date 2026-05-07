<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add organization JIT default roles.
 *
 * Maps to POST /api/organizations/{id}/jit/roles in the official Logto OpenAPI source.
 */
class LogtoCreateOrganizationJitRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization_jit_role',
  'class' => 'LogtoCreateOrganizationJitRole',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/jit/roles',
  'operation_id' => 'CreateOrganizationJitRole',
  'summary' => 'Add organization JIT default roles',
  'description' => 'Add new organization roles that will be assigned to users during just-in-time provisioning.',
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
