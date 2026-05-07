<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an ACL
 *
 * Maps to Fastly generated client operation AclApi::deleteAcl (DELETE /service/{service_id}/version/{version_id}/acl/{acl_name}).
 */
class FastlyAclDeleteAcl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acl_delete_acl';
    protected const DESCRIPTION = 'Delete an ACL

Official Fastly client operation: AclApi::deleteAcl
Endpoint: DELETE /service/{service_id}/version/{version_id}/acl/{acl_name}

Delete an ACL';
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
  'slug' => 'fastly_acl_delete_acl',
  'class' => 'FastlyAclDeleteAcl',
  'api_class' => 'AclApi',
  'method_name' => 'deleteAcl',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/acl/{acl_name}',
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
