<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update multiple ACL entries
 *
 * Maps to Fastly generated client operation AclEntryApi::bulkUpdateAclEntries (PATCH /service/{service_id}/acl/{acl_id}/entries).
 */
class FastlyAclEntryBulkUpdateAclEntries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acl_entry_bulk_update_acl_entries';
    protected const DESCRIPTION = 'Update multiple ACL entries

Official Fastly client operation: AclEntryApi::bulkUpdateAclEntries
Endpoint: PATCH /service/{service_id}/acl/{acl_id}/entries

Update multiple ACL entries';
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
  'bulk_update_acl_entries_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `bulk_update_acl_entries_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acl_entry_bulk_update_acl_entries',
  'class' => 'FastlyAclEntryBulkUpdateAclEntries',
  'api_class' => 'AclEntryApi',
  'method_name' => 'bulkUpdateAclEntries',
  'method' => 'PATCH',
  'path' => '/service/{service_id}/acl/{acl_id}/entries',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update multiple ACL entries',
  'description' => 'Update multiple ACL entries',
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
    'bulk_update_acl_entries_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `bulk_update_acl_entries_request`.',
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
  'body_param' => 'bulk_update_acl_entries_request',
  'body_required' => false,
);
}
