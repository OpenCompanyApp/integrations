<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an ACL
 *
 * Maps to Fastly generated client operation AclsInComputeApi::computeAclDeleteSAclId (DELETE /resources/acls/{acl_id}).
 */
class FastlyAclsInComputeComputeAclDeleteSaclId extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acls_in_compute_compute_acl_delete_sacl_id';
    protected const DESCRIPTION = 'Delete an ACL

Official Fastly client operation: AclsInComputeApi::computeAclDeleteSAclId
Endpoint: DELETE /resources/acls/{acl_id}

Delete an ACL';
    protected const PARAMETERS = array (
  'acl_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acls_in_compute_compute_acl_delete_sacl_id',
  'class' => 'FastlyAclsInComputeComputeAclDeleteSaclId',
  'api_class' => 'AclsInComputeApi',
  'method_name' => 'computeAclDeleteSAclId',
  'method' => 'DELETE',
  'path' => '/resources/acls/{acl_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an ACL',
  'description' => 'Delete an ACL',
  'type' => 'write',
  'parameters' =>
  array (
    'acl_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `acl_id`.',
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
  'body_param' => NULL,
  'body_required' => false,
);
}
