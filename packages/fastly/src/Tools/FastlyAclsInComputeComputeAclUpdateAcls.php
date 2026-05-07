<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an ACL
 *
 * Maps to Fastly generated client operation AclsInComputeApi::computeAclUpdateAcls (PATCH /resources/acls/{acl_id}/entries).
 */
class FastlyAclsInComputeComputeAclUpdateAcls extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acls_in_compute_compute_acl_update_acls';
    protected const DESCRIPTION = 'Update an ACL

Official Fastly client operation: AclsInComputeApi::computeAclUpdateAcls
Endpoint: PATCH /resources/acls/{acl_id}/entries

Update an ACL';
    protected const PARAMETERS = array (
  'acl_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_id`.',
  ),
  'compute_acl_update' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `compute_acl_update`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acls_in_compute_compute_acl_update_acls',
  'class' => 'FastlyAclsInComputeComputeAclUpdateAcls',
  'api_class' => 'AclsInComputeApi',
  'method_name' => 'computeAclUpdateAcls',
  'method' => 'PATCH',
  'path' => '/resources/acls/{acl_id}/entries',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an ACL',
  'description' => 'Update an ACL',
  'type' => 'write',
  'parameters' =>
  array (
    'acl_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `acl_id`.',
    ),
    'compute_acl_update' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `compute_acl_update`.',
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
    'acl_id' => 'acl_id',
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
  'body_param' => 'compute_acl_update',
  'body_required' => false,
);
}
