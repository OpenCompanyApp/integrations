<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a Logentries log endpoint
 *
 * Maps to Fastly generated client operation LoggingLogentriesApi::updateLogLogentries (PUT /service/{service_id}/version/{version_id}/logging/logentries/{logging_logentries_name}).
 */
class FastlyLoggingLogentriesUpdateLogLogentries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_logentries_update_log_logentries';
    protected const DESCRIPTION = 'Update a Logentries log endpoint

Official Fastly client operation: LoggingLogentriesApi::updateLogLogentries
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/logentries/{logging_logentries_name}

Update a Logentries log endpoint';
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
  'logging_logentries_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_logentries_name`.',
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
  'port' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `port`.',
  ),
  'token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `token`.',
  ),
  'use_tls' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `use_tls`.',
  ),
  'region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `region`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_logentries_update_log_logentries',
  'class' => 'FastlyLoggingLogentriesUpdateLogLogentries',
  'api_class' => 'LoggingLogentriesApi',
  'method_name' => 'updateLogLogentries',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/logentries/{logging_logentries_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a Logentries log endpoint',
  'description' => 'Update a Logentries log endpoint',
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
    'logging_logentries_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_logentries_name`.',
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
    'port' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `port`.',
    ),
    'token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `token`.',
    ),
    'use_tls' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `use_tls`.',
    ),
    'region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `region`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_logentries_name' => 'logging_logentries_name',
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
    'port' => 'port',
    'token' => 'token',
    'use_tls' => 'use_tls',
    'region' => 'region',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
