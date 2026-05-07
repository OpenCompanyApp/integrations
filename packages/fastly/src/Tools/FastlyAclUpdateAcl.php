<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an ACL
 *
 * Maps to Fastly generated client operation AclApi::updateAcl (PUT /service/{service_id}/version/{version_id}/acl/{acl_name}).
 */
class FastlyAclUpdateAcl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acl_update_acl';
    protected const DESCRIPTION = 'Update an ACL

Official Fastly client operation: AclApi::updateAcl
Endpoint: PUT /service/{service_id}/version/{version_id}/acl/{acl_name}

Update an ACL';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acl_update_acl',
  'class' => 'FastlyAclUpdateAcl',
  'api_class' => 'AclApi',
  'method_name' => 'updateAcl',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/acl/{acl_name}',
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
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
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
    'name' => 'name',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
