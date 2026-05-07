<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get details of the service's Compute package.
 *
 * Maps to Fastly generated client operation PackageApi::getPackage (GET /service/{service_id}/version/{version_id}/package).
 */
class FastlyPackageGetPackage extends AbstractFastlyTool
{
    protected const NAME = 'fastly_package_get_package';
    protected const DESCRIPTION = 'Get details of the service\'s Compute package.

Official Fastly client operation: PackageApi::getPackage
Endpoint: GET /service/{service_id}/version/{version_id}/package

Get details of the service\'s Compute package.';
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
  'slug' => 'fastly_package_get_package',
  'class' => 'FastlyPackageGetPackage',
  'api_class' => 'PackageApi',
  'method_name' => 'getPackage',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/package',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get details of the service\'s Compute package.',
  'description' => 'Get details of the service\'s Compute package.',
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
