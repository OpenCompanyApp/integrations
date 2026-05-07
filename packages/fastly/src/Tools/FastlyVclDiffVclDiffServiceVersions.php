<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a comparison of the VCL changes between two service versions
 *
 * Maps to Fastly generated client operation VclDiffApi::vclDiffServiceVersions (GET /service/{service_id}/vcl/diff/from/{from_version_id}/to/{to_version_id}).
 */
class FastlyVclDiffVclDiffServiceVersions extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_diff_vcl_diff_service_versions';
    protected const DESCRIPTION = 'Get a comparison of the VCL changes between two service versions

Official Fastly client operation: VclDiffApi::vclDiffServiceVersions
Endpoint: GET /service/{service_id}/vcl/diff/from/{from_version_id}/to/{to_version_id}

Get a comparison of the VCL changes between two service versions';
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
  'slug' => 'fastly_vcl_diff_vcl_diff_service_versions',
  'class' => 'FastlyVclDiffVclDiffServiceVersions',
  'api_class' => 'VclDiffApi',
  'method_name' => 'vclDiffServiceVersions',
  'method' => 'GET',
  'path' => '/service/{service_id}/vcl/diff/from/{from_version_id}/to/{to_version_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a comparison of the VCL changes between two service versions',
  'description' => 'Get a comparison of the VCL changes between two service versions',
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
