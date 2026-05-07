<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Upload a Compute package.
 *
 * Maps to Fastly generated client operation PackageApi::putPackage (PUT /service/{service_id}/version/{version_id}/package).
 */
class FastlyPackagePutPackage extends AbstractFastlyTool
{
    protected const NAME = 'fastly_package_put_package';
    protected const DESCRIPTION = 'Upload a Compute package.

Official Fastly client operation: PackageApi::putPackage
Endpoint: PUT /service/{service_id}/version/{version_id}/package

Upload a Compute package.';
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
  'expect' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `expect`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_package_put_package',
  'class' => 'FastlyPackagePutPackage',
  'api_class' => 'PackageApi',
  'method_name' => 'putPackage',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/package',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Upload a Compute package.',
  'description' => 'Upload a Compute package.',
  'type' => 'write',
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
    'expect' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `expect`.',
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
    'expect' => 'expect',
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
