<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Grafana Cloud Logs log endpoints
 *
 * Maps to Fastly generated client operation LoggingGrafanacloudlogsApi::listLogGrafanacloudlogs (GET /service/{service_id}/version/{version_id}/logging/grafanacloudlogs).
 */
class FastlyLoggingGrafanacloudlogsListLogGrafanacloudlogs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_grafanacloudlogs_list_log_grafanacloudlogs';
    protected const DESCRIPTION = 'List Grafana Cloud Logs log endpoints

Official Fastly client operation: LoggingGrafanacloudlogsApi::listLogGrafanacloudlogs
Endpoint: GET /service/{service_id}/version/{version_id}/logging/grafanacloudlogs

List Grafana Cloud Logs log endpoints';
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
  'slug' => 'fastly_logging_grafanacloudlogs_list_log_grafanacloudlogs',
  'class' => 'FastlyLoggingGrafanacloudlogsListLogGrafanacloudlogs',
  'api_class' => 'LoggingGrafanacloudlogsApi',
  'method_name' => 'listLogGrafanacloudlogs',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/grafanacloudlogs',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Grafana Cloud Logs log endpoints',
  'description' => 'List Grafana Cloud Logs log endpoints',
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
