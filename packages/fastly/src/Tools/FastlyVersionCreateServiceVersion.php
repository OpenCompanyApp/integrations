<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a service version
 *
 * Maps to Fastly generated client operation VersionApi::createServiceVersion (POST /service/{service_id}/version).
 */
class FastlyVersionCreateServiceVersion extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_create_service_version';
    protected const DESCRIPTION = 'Create a service version

Official Fastly client operation: VersionApi::createServiceVersion
Endpoint: POST /service/{service_id}/version

Create a service version';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_version_create_service_version',
  'class' => 'FastlyVersionCreateServiceVersion',
  'api_class' => 'VersionApi',
  'method_name' => 'createServiceVersion',
  'method' => 'POST',
  'path' => '/service/{service_id}/version',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a service version',
  'description' => 'Create a service version',
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
