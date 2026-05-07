<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get service details
 *
 * Maps to Fastly generated client operation ServiceApi::getServiceDetail (GET /service/{service_id}/details).
 */
class FastlyServiceGetServiceDetail extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_get_service_detail';
    protected const DESCRIPTION = 'Get service details

Official Fastly client operation: ServiceApi::getServiceDetail
Endpoint: GET /service/{service_id}/details

Get service details';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `version`.',
  ),
  'filter_versions_active' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_versions_active`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_get_service_detail',
  'class' => 'FastlyServiceGetServiceDetail',
  'api_class' => 'ServiceApi',
  'method_name' => 'getServiceDetail',
  'method' => 'GET',
  'path' => '/service/{service_id}/details',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get service details',
  'description' => 'Get service details',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `version`.',
    ),
    'filter_versions_active' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_versions_active`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
  ),
  'query_params' =>
  array (
    'version' => 'version',
    'filter[versions.active]' => 'filter_versions_active',
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
