<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Diff two service versions
 *
 * Maps to Fastly generated client operation DiffApi::diffServiceVersions (GET /service/{service_id}/diff/from/{from_version_id}/to/{to_version_id}).
 */
class FastlyDiffDiffServiceVersions extends AbstractFastlyTool
{
    protected const NAME = 'fastly_diff_diff_service_versions';
    protected const DESCRIPTION = 'Diff two service versions

Official Fastly client operation: DiffApi::diffServiceVersions
Endpoint: GET /service/{service_id}/diff/from/{from_version_id}/to/{to_version_id}

Diff two service versions';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'from_version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `from_version_id`.',
  ),
  'to_version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `to_version_id`.',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_diff_diff_service_versions',
  'class' => 'FastlyDiffDiffServiceVersions',
  'api_class' => 'DiffApi',
  'method_name' => 'diffServiceVersions',
  'method' => 'GET',
  'path' => '/service/{service_id}/diff/from/{from_version_id}/to/{to_version_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Diff two service versions',
  'description' => 'Diff two service versions',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'from_version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `from_version_id`.',
    ),
    'to_version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `to_version_id`.',
    ),
    'format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'from_version_id' => 'from_version_id',
    'to_version_id' => 'to_version_id',
  ),
  'query_params' =>
  array (
    'format' => 'format',
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
