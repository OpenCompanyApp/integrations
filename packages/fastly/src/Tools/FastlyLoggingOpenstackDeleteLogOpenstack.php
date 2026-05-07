<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an OpenStack log endpoint
 *
 * Maps to Fastly generated client operation LoggingOpenstackApi::deleteLogOpenstack (DELETE /service/{service_id}/version/{version_id}/logging/openstack/{logging_openstack_name}).
 */
class FastlyLoggingOpenstackDeleteLogOpenstack extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_openstack_delete_log_openstack';
    protected const DESCRIPTION = 'Delete an OpenStack log endpoint

Official Fastly client operation: LoggingOpenstackApi::deleteLogOpenstack
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/openstack/{logging_openstack_name}

Delete an OpenStack log endpoint';
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
  'logging_openstack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_openstack_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_openstack_delete_log_openstack',
  'class' => 'FastlyLoggingOpenstackDeleteLogOpenstack',
  'api_class' => 'LoggingOpenstackApi',
  'method_name' => 'deleteLogOpenstack',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/openstack/{logging_openstack_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an OpenStack log endpoint',
  'description' => 'Delete an OpenStack log endpoint',
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
    'logging_openstack_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_openstack_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_openstack_name' => 'logging_openstack_name',
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
