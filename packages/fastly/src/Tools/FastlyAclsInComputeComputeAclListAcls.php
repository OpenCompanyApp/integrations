<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List ACLs
 *
 * Maps to Fastly generated client operation AclsInComputeApi::computeAclListAcls (GET /resources/acls).
 */
class FastlyAclsInComputeComputeAclListAcls extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acls_in_compute_compute_acl_list_acls';
    protected const DESCRIPTION = 'List ACLs

Official Fastly client operation: AclsInComputeApi::computeAclListAcls
Endpoint: GET /resources/acls

List ACLs';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_acls_in_compute_compute_acl_list_acls',
  'class' => 'FastlyAclsInComputeComputeAclListAcls',
  'api_class' => 'AclsInComputeApi',
  'method_name' => 'computeAclListAcls',
  'method' => 'GET',
  'path' => '/resources/acls',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List ACLs',
  'description' => 'List ACLs',
  'type' => 'read',
  'parameters' =>
  array (
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
  'body_param' => NULL,
  'body_required' => false,
);
}
