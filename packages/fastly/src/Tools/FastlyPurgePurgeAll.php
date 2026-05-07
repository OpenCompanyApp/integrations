<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Purge everything from a service
 *
 * Maps to Fastly generated client operation PurgeApi::purgeAll (POST /service/{service_id}/purge_all).
 */
class FastlyPurgePurgeAll extends AbstractFastlyTool
{
    protected const NAME = 'fastly_purge_purge_all';
    protected const DESCRIPTION = 'Purge everything from a service

Official Fastly client operation: PurgeApi::purgeAll
Endpoint: POST /service/{service_id}/purge_all

Purge everything from a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_purge_purge_all',
  'class' => 'FastlyPurgePurgeAll',
  'api_class' => 'PurgeApi',
  'method_name' => 'purgeAll',
  'method' => 'POST',
  'path' => '/service/{service_id}/purge_all',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Purge everything from a service',
  'description' => 'Purge everything from a service',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
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
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
