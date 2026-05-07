<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List ACL entries
 *
 * Maps to Fastly generated client operation AclEntryApi::listAclEntries (GET /service/{service_id}/acl/{acl_id}/entries).
 */
class FastlyAclEntryListAclEntries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_acl_entry_list_acl_entries';
    protected const DESCRIPTION = 'List ACL entries

Official Fastly client operation: AclEntryApi::listAclEntries
Endpoint: GET /service/{service_id}/acl/{acl_id}/entries

List ACL entries';
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
  'page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page`.',
  ),
  'per_page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `per_page`.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `direction`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_acl_entry_list_acl_entries',
  'class' => 'FastlyAclEntryListAclEntries',
  'api_class' => 'AclEntryApi',
  'method_name' => 'listAclEntries',
  'method' => 'GET',
  'path' => '/service/{service_id}/acl/{acl_id}/entries',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List ACL entries',
  'description' => 'List ACL entries',
  'type' => 'read',
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
    'page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page`.',
    ),
    'per_page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `per_page`.',
    ),
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
    ),
    'direction' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `direction`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'acl_id' => 'acl_id',
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'per_page' => 'per_page',
    'sort' => 'sort',
    'direction' => 'direction',
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
