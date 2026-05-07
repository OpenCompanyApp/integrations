<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an ACL entry
 *
 * Maps to Fastly generated client operation AclEntryApi::deleteAclEntry (DELETE /service/{service_id}/acl/{acl_id}/entry/{acl_entry_id}).
 */
class FastlyAclEntryDeleteAclEntry extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acl_entry_delete_acl_entry';
    protected const DESCRIPTION = 'Delete an ACL entry

Official Fastly client operation: AclEntryApi::deleteAclEntry
Endpoint: DELETE /service/{service_id}/acl/{acl_id}/entry/{acl_entry_id}

Delete an ACL entry';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'acl_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_id`.',
  ),
  'acl_entry_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `acl_entry_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acl_entry_delete_acl_entry',
  'class' => 'FastlyAclEntryDeleteAclEntry',
  'api_class' => 'AclEntryApi',
  'method_name' => 'deleteAclEntry',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/acl/{acl_id}/entry/{acl_entry_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an ACL entry',
  'description' => 'Delete an ACL entry',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'acl_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `acl_id`.',
    ),
    'acl_entry_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `acl_entry_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'acl_id' => 'acl_id',
    'acl_entry_id' => 'acl_entry_id',
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
