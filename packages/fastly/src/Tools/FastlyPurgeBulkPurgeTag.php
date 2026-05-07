<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Purge multiple surrogate key tags
 *
 * Maps to Fastly generated client operation PurgeApi::bulkPurgeTag (POST /service/{service_id}/purge).
 */
class FastlyPurgeBulkPurgeTag extends AbstractFastlyTool
{
    protected const NAME = 'fastly_purge_bulk_purge_tag';
    protected const DESCRIPTION = 'Purge multiple surrogate key tags

Official Fastly client operation: PurgeApi::bulkPurgeTag
Endpoint: POST /service/{service_id}/purge

Purge multiple surrogate key tags';
    protected const PARAMETERS = array (
  'fastly_soft_purge' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `fastly_soft_purge`.',
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'surrogate_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `surrogate_key`.',
  ),
  'purge_response' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `purge_response`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_purge_bulk_purge_tag',
  'class' => 'FastlyPurgeBulkPurgeTag',
  'api_class' => 'PurgeApi',
  'method_name' => 'bulkPurgeTag',
  'method' => 'POST',
  'path' => '/service/{service_id}/purge',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Purge multiple surrogate key tags',
  'description' => 'Purge multiple surrogate key tags',
  'type' => 'write',
  'parameters' =>
  array (
    'fastly_soft_purge' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `fastly_soft_purge`.',
    ),
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'surrogate_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `surrogate_key`.',
    ),
    'purge_response' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `purge_response`.',
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
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
    'fastly-soft-purge' => 'fastly_soft_purge',
    'surrogate-key' => 'surrogate_key',
  ),
  'form_params' =>
  array (
  ),
  'body_param' => 'purge_response',
  'body_required' => false,
);
}
