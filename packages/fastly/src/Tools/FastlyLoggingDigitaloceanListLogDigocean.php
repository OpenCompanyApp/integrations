<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List DigitalOcean Spaces log endpoints
 *
 * Maps to Fastly generated client operation LoggingDigitaloceanApi::listLogDigocean (GET /service/{service_id}/version/{version_id}/logging/digitalocean).
 */
class FastlyLoggingDigitaloceanListLogDigocean extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_digitalocean_list_log_digocean';
    protected const DESCRIPTION = 'List DigitalOcean Spaces log endpoints

Official Fastly client operation: LoggingDigitaloceanApi::listLogDigocean
Endpoint: GET /service/{service_id}/version/{version_id}/logging/digitalocean

List DigitalOcean Spaces log endpoints';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_digitalocean_list_log_digocean',
  'class' => 'FastlyLoggingDigitaloceanListLogDigocean',
  'api_class' => 'LoggingDigitaloceanApi',
  'method_name' => 'listLogDigocean',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/digitalocean',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List DigitalOcean Spaces log endpoints',
  'description' => 'List DigitalOcean Spaces log endpoints',
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
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
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
