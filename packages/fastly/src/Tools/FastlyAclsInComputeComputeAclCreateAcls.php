<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a new ACL
 *
 * Maps to Fastly generated client operation AclsInComputeApi::computeAclCreateAcls (POST /resources/acls).
 */
class FastlyAclsInComputeComputeAclCreateAcls extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acls_in_compute_compute_acl_create_acls';
    protected const DESCRIPTION = 'Create a new ACL

Official Fastly client operation: AclsInComputeApi::computeAclCreateAcls
Endpoint: POST /resources/acls

Create a new ACL';
    protected const PARAMETERS = array (
  'compute_acl_create_acls_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `compute_acl_create_acls_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acls_in_compute_compute_acl_create_acls',
  'class' => 'FastlyAclsInComputeComputeAclCreateAcls',
  'api_class' => 'AclsInComputeApi',
  'method_name' => 'computeAclCreateAcls',
  'method' => 'POST',
  'path' => '/resources/acls',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a new ACL',
  'description' => 'Create a new ACL',
  'type' => 'write',
  'parameters' =>
  array (
    'compute_acl_create_acls_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `compute_acl_create_acls_request`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'form_params' =>
  array (
  ),
  'body_param' => 'compute_acl_create_acls_request',
  'body_required' => false,
);
}
