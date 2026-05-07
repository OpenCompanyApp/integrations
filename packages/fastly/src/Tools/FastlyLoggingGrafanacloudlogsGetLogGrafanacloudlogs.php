<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Grafana Cloud Logs log endpoint
 *
 * Maps to Fastly generated client operation LoggingGrafanacloudlogsApi::getLogGrafanacloudlogs (GET /service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}).
 */
class FastlyLoggingGrafanacloudlogsGetLogGrafanacloudlogs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_grafanacloudlogs_get_log_grafanacloudlogs';
    protected const DESCRIPTION = 'Get a Grafana Cloud Logs log endpoint

Official Fastly client operation: LoggingGrafanacloudlogsApi::getLogGrafanacloudlogs
Endpoint: GET /service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}

Get a Grafana Cloud Logs log endpoint';
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
  'logging_grafanacloudlogs_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_grafanacloudlogs_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_grafanacloudlogs_get_log_grafanacloudlogs',
  'class' => 'FastlyLoggingGrafanacloudlogsGetLogGrafanacloudlogs',
  'api_class' => 'LoggingGrafanacloudlogsApi',
  'method_name' => 'getLogGrafanacloudlogs',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Grafana Cloud Logs log endpoint',
  'description' => 'Get a Grafana Cloud Logs log endpoint',
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
    'logging_grafanacloudlogs_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_grafanacloudlogs_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_grafanacloudlogs_name' => 'logging_grafanacloudlogs_name',
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
