<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a Grafana Cloud Logs log endpoint
 *
 * Maps to Fastly generated client operation LoggingGrafanacloudlogsApi::updateLogGrafanacloudlogs (PUT /service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}).
 */
class FastlyLoggingGrafanacloudlogsUpdateLogGrafanacloudlogs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_grafanacloudlogs_update_log_grafanacloudlogs';
    protected const DESCRIPTION = 'Update a Grafana Cloud Logs log endpoint

Official Fastly client operation: LoggingGrafanacloudlogsApi::updateLogGrafanacloudlogs
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}

Update a Grafana Cloud Logs log endpoint';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'placement' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `placement`.',
  ),
  'response_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `response_condition`.',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format`.',
  ),
  'log_processing_region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `log_processing_region`.',
  ),
  'format_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format_version`.',
  ),
  'user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `user`.',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `url`.',
  ),
  'token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `token`.',
  ),
  'index' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `index`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_grafanacloudlogs_update_log_grafanacloudlogs',
  'class' => 'FastlyLoggingGrafanacloudlogsUpdateLogGrafanacloudlogs',
  'api_class' => 'LoggingGrafanacloudlogsApi',
  'method_name' => 'updateLogGrafanacloudlogs',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/grafanacloudlogs/{logging_grafanacloudlogs_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a Grafana Cloud Logs log endpoint',
  'description' => 'Update a Grafana Cloud Logs log endpoint',
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
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'placement' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `placement`.',
    ),
    'response_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `response_condition`.',
    ),
    'format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format`.',
    ),
    'log_processing_region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `log_processing_region`.',
    ),
    'format_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format_version`.',
    ),
    'user' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `user`.',
    ),
    'url' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `url`.',
    ),
    'token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `token`.',
    ),
    'index' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `index`.',
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
    'name' => 'name',
    'placement' => 'placement',
    'response_condition' => 'response_condition',
    'format' => 'format',
    'log_processing_region' => 'log_processing_region',
    'format_version' => 'format_version',
    'user' => 'user',
    'url' => 'url',
    'token' => 'token',
    'index' => 'index',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
