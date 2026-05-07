<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete the Grafana Cloud Logs log endpoint
 *
 * Maps to Fastly generated client operation LoggingGrafanacloudlogsApi::deleteLogGrafanacloudlogs (DELETE /service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}).
 */
class FastlyLoggingGrafanacloudlogsDeleteLogGrafanacloudlogs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_grafanacloudlogs_delete_log_grafanacloudlogs';
    protected const DESCRIPTION = 'Delete the Grafana Cloud Logs log endpoint

Official Fastly client operation: LoggingGrafanacloudlogsApi::deleteLogGrafanacloudlogs
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}

Delete the Grafana Cloud Logs log endpoint';
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
  'slug' => 'fastly_logging_grafanacloudlogs_delete_log_grafanacloudlogs',
  'class' => 'FastlyLoggingGrafanacloudlogsDeleteLogGrafanacloudlogs',
  'api_class' => 'LoggingGrafanacloudlogsApi',
  'method_name' => 'deleteLogGrafanacloudlogs',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete the Grafana Cloud Logs log endpoint',
  'description' => 'Delete the Grafana Cloud Logs log endpoint',
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
