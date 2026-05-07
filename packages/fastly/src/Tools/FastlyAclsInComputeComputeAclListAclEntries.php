<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List an ACL
 *
 * Maps to Fastly generated client operation AclsInComputeApi::computeAclListAclEntries (GET /resources/acls/{acl_id}/entries).
 */
class FastlyAclsInComputeComputeAclListAclEntries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acls_in_compute_compute_acl_list_acl_entries';
    protected const DESCRIPTION = 'List an ACL

Official Fastly client operation: AclsInComputeApi::computeAclListAclEntries
Endpoint: GET /resources/acls/{acl_id}/entries

List an ACL';
    protected const PARAMETERS = array (
  'acl_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_id`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acls_in_compute_compute_acl_list_acl_entries',
  'class' => 'FastlyAclsInComputeComputeAclListAclEntries',
  'api_class' => 'AclsInComputeApi',
  'method_name' => 'computeAclListAclEntries',
  'method' => 'GET',
  'path' => '/resources/acls/{acl_id}/entries',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List an ACL',
  'description' => 'List an ACL',
  'type' => 'read',
  'parameters' =>
  array (
    'acl_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `acl_id`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
  ),
  'path_params' =>
  array (
    'acl_id' => 'acl_id',
  ),
  'query_params' =>
  array (
    'cursor' => 'cursor',
    'limit' => 'limit',
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
