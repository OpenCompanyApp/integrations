<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a service
 *
 * Maps to Fastly generated client operation ServiceApi::deleteService (DELETE /service/{service_id}).
 */
class FastlyServiceDeleteService extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_delete_service';
    protected const DESCRIPTION = 'Delete a service

Official Fastly client operation: ServiceApi::deleteService
Endpoint: DELETE /service/{service_id}

Delete a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_delete_service',
  'class' => 'FastlyServiceDeleteService',
  'api_class' => 'ServiceApi',
  'method_name' => 'deleteService',
  'method' => 'DELETE',
  'path' => '/service/{service_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a service',
  'description' => 'Delete a service',
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
