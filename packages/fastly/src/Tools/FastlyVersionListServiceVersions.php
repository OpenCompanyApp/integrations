<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List versions of a service
 *
 * Maps to Fastly generated client operation VersionApi::listServiceVersions (GET /service/{service_id}/version).
 */
class FastlyVersionListServiceVersions extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_list_service_versions';
    protected const DESCRIPTION = 'List versions of a service

Official Fastly client operation: VersionApi::listServiceVersions
Endpoint: GET /service/{service_id}/version

List versions of a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_version_list_service_versions',
  'class' => 'FastlyVersionListServiceVersions',
  'api_class' => 'VersionApi',
  'method_name' => 'listServiceVersions',
  'method' => 'GET',
  'path' => '/service/{service_id}/version',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List versions of a service',
  'description' => 'List versions of a service',
  'type' => 'read',
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
