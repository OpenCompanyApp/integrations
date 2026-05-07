<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Lookup an ACL
 *
 * Maps to Fastly generated client operation AclsInComputeApi::computeAclLookupAcls (GET /resources/acls/{acl_id}/entry/{acl_ip}).
 */
class FastlyAclsInComputeComputeAclLookupAcls extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acls_in_compute_compute_acl_lookup_acls';
    protected const DESCRIPTION = 'Lookup an ACL

Official Fastly client operation: AclsInComputeApi::computeAclLookupAcls
Endpoint: GET /resources/acls/{acl_id}/entry/{acl_ip}

Lookup an ACL';
    protected const PARAMETERS = array (
  'acl_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_id`.',
  ),
  'acl_ip' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_ip`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acls_in_compute_compute_acl_lookup_acls',
  'class' => 'FastlyAclsInComputeComputeAclLookupAcls',
  'api_class' => 'AclsInComputeApi',
  'method_name' => 'computeAclLookupAcls',
  'method' => 'GET',
  'path' => '/resources/acls/{acl_id}/entry/{acl_ip}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Lookup an ACL',
  'description' => 'Lookup an ACL',
  'type' => 'read',
  'parameters' =>
  array (
    'acl_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `acl_id`.',
    ),
    'acl_ip' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `acl_ip`.',
    ),
  ),
  'path_params' =>
  array (
    'acl_id' => 'acl_id',
    'acl_ip' => 'acl_ip',
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
