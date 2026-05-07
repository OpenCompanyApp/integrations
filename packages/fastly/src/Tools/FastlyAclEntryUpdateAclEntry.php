<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an ACL entry
 *
 * Maps to Fastly generated client operation AclEntryApi::updateAclEntry (PATCH /service/{service_id}/acl/{acl_id}/entry/{acl_entry_id}).
 */
class FastlyAclEntryUpdateAclEntry extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acl_entry_update_acl_entry';
    protected const DESCRIPTION = 'Update an ACL entry

Official Fastly client operation: AclEntryApi::updateAclEntry
Endpoint: PATCH /service/{service_id}/acl/{acl_id}/entry/{acl_entry_id}

Update an ACL entry';
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
  'acl_entry' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `acl_entry`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acl_entry_update_acl_entry',
  'class' => 'FastlyAclEntryUpdateAclEntry',
  'api_class' => 'AclEntryApi',
  'method_name' => 'updateAclEntry',
  'method' => 'PATCH',
  'path' => '/service/{service_id}/acl/{acl_id}/entry/{acl_entry_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an ACL entry',
  'description' => 'Update an ACL entry',
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
    'acl_entry' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `acl_entry`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'body_param' => 'acl_entry',
  'body_required' => false,
);
}
