<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Describe an ACL
 *
 * Maps to Fastly generated client operation AclApi::getAcl (GET /service/{service_id}/version/{version_id}/acl/{acl_name}).
 */
class FastlyAclGetAcl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acl_get_acl';
    protected const DESCRIPTION = 'Describe an ACL

Official Fastly client operation: AclApi::getAcl
Endpoint: GET /service/{service_id}/version/{version_id}/acl/{acl_name}

Describe an ACL';
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
  'acl_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acl_get_acl',
  'class' => 'FastlyAclGetAcl',
  'api_class' => 'AclApi',
  'method_name' => 'getAcl',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/acl/{acl_name}',
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
    'acl_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `acl_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'acl_name' => 'acl_name',
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
