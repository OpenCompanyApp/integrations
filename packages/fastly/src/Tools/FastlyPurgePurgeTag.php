<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Purge by surrogate key tag
 *
 * Maps to Fastly generated client operation PurgeApi::purgeTag (POST /service/{service_id}/purge/{surrogate_key}).
 */
class FastlyPurgePurgeTag extends AbstractFastlyTool
{
    protected const NAME = 'fastly_purge_purge_tag';
    protected const DESCRIPTION = 'Purge by surrogate key tag

Official Fastly client operation: PurgeApi::purgeTag
Endpoint: POST /service/{service_id}/purge/{surrogate_key}

Purge by surrogate key tag';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'fastly_soft_purge' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `fastly_soft_purge`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_purge_purge_tag',
  'class' => 'FastlyPurgePurgeTag',
  'api_class' => 'PurgeApi',
  'method_name' => 'purgeTag',
  'method' => 'POST',
  'path' => '/service/{service_id}/purge/{surrogate_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Purge by surrogate key tag',
  'description' => 'Purge by surrogate key tag',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'fastly_soft_purge' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `fastly_soft_purge`.',
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
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
