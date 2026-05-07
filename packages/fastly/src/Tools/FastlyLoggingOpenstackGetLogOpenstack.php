<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an OpenStack log endpoint
 *
 * Maps to Fastly generated client operation LoggingOpenstackApi::getLogOpenstack (GET /service/{service_id}/version/{version_id}/logging/openstack/{logging_openstack_name}).
 */
class FastlyLoggingOpenstackGetLogOpenstack extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_openstack_get_log_openstack';
    protected const DESCRIPTION = 'Get an OpenStack log endpoint

Official Fastly client operation: LoggingOpenstackApi::getLogOpenstack
Endpoint: GET /service/{service_id}/version/{version_id}/logging/openstack/{logging_openstack_name}

Get an OpenStack log endpoint';
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
  'slug' => 'fastly_logging_openstack_get_log_openstack',
  'class' => 'FastlyLoggingOpenstackGetLogOpenstack',
  'api_class' => 'LoggingOpenstackApi',
  'method_name' => 'getLogOpenstack',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/openstack/{logging_openstack_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an OpenStack log endpoint',
  'description' => 'Get an OpenStack log endpoint',
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
