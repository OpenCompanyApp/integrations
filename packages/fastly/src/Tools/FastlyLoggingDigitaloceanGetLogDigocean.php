<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a DigitalOcean Spaces log endpoint
 *
 * Maps to Fastly generated client operation LoggingDigitaloceanApi::getLogDigocean (GET /service/{service_id}/version/{version_id}/logging/digitalocean/{logging_digitalocean_name}).
 */
class FastlyLoggingDigitaloceanGetLogDigocean extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_digitalocean_get_log_digocean';
    protected const DESCRIPTION = 'Get a DigitalOcean Spaces log endpoint

Official Fastly client operation: LoggingDigitaloceanApi::getLogDigocean
Endpoint: GET /service/{service_id}/version/{version_id}/logging/digitalocean/{logging_digitalocean_name}

Get a DigitalOcean Spaces log endpoint';
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
  'logging_digitalocean_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_digitalocean_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_digitalocean_get_log_digocean',
  'class' => 'FastlyLoggingDigitaloceanGetLogDigocean',
  'api_class' => 'LoggingDigitaloceanApi',
  'method_name' => 'getLogDigocean',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/digitalocean/{logging_digitalocean_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a DigitalOcean Spaces log endpoint',
  'description' => 'Get a DigitalOcean Spaces log endpoint',
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
    'logging_digitalocean_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_digitalocean_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_digitalocean_name' => 'logging_digitalocean_name',
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
