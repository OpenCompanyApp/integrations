<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List OpenStack log endpoints
 *
 * Maps to Fastly generated client operation LoggingOpenstackApi::listLogOpenstack (GET /service/{service_id}/version/{version_id}/logging/openstack).
 */
class FastlyLoggingOpenstackListLogOpenstack extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_openstack_list_log_openstack';
    protected const DESCRIPTION = 'List OpenStack log endpoints

Official Fastly client operation: LoggingOpenstackApi::listLogOpenstack
Endpoint: GET /service/{service_id}/version/{version_id}/logging/openstack

List OpenStack log endpoints';
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
  'slug' => 'fastly_logging_openstack_list_log_openstack',
  'class' => 'FastlyLoggingOpenstackListLogOpenstack',
  'api_class' => 'LoggingOpenstackApi',
  'method_name' => 'listLogOpenstack',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/openstack',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List OpenStack log endpoints',
  'description' => 'List OpenStack log endpoints',
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
