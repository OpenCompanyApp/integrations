<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List ACLs
 *
 * Maps to Fastly generated client operation AclApi::listAcls (GET /service/{service_id}/version/{version_id}/acl).
 */
class FastlyAclListAcls extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acl_list_acls';
    protected const DESCRIPTION = 'List ACLs

Official Fastly client operation: AclApi::listAcls
Endpoint: GET /service/{service_id}/version/{version_id}/acl

List ACLs';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `version_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acl_list_acls',
  'class' => 'FastlyAclListAcls',
  'api_class' => 'AclApi',
  'method_name' => 'listAcls',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/acl',
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
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `version_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
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
