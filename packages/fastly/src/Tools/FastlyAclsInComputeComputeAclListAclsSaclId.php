<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Describe an ACL
 *
 * Maps to Fastly generated client operation AclsInComputeApi::computeAclListAclsSAclId (GET /resources/acls/{acl_id}).
 */
class FastlyAclsInComputeComputeAclListAclsSaclId extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acls_in_compute_compute_acl_list_acls_sacl_id';
    protected const DESCRIPTION = 'Describe an ACL

Official Fastly client operation: AclsInComputeApi::computeAclListAclsSAclId
Endpoint: GET /resources/acls/{acl_id}

Describe an ACL';
    protected const PARAMETERS = array (
  'acl_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acls_in_compute_compute_acl_list_acls_sacl_id',
  'class' => 'FastlyAclsInComputeComputeAclListAclsSaclId',
  'api_class' => 'AclsInComputeApi',
  'method_name' => 'computeAclListAclsSAclId',
  'method' => 'GET',
  'path' => '/resources/acls/{acl_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Describe an ACL',
  'description' => 'Describe an ACL',
  'type' => 'read',
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
