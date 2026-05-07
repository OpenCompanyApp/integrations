<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a New Relic log endpoint
 *
 * Maps to Fastly generated client operation LoggingNewrelicotlpApi::updateLogNewrelicotlp (PUT /service/{service_id}/version/{version_id}/logging/newrelicotlp/{logging_newrelicotlp_name}).
 */
class FastlyLoggingNewrelicotlpUpdateLogNewrelicotlp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_newrelicotlp_update_log_newrelicotlp';
    protected const DESCRIPTION = 'Update a New Relic log endpoint

Official Fastly client operation: LoggingNewrelicotlpApi::updateLogNewrelicotlp
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/newrelicotlp/{logging_newrelicotlp_name}

Update a New Relic log endpoint';
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
  'logging_newrelicotlp_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_newrelicotlp_name`.',
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
  'token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `token`.',
  ),
  'region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `region`.',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `url`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_newrelicotlp_update_log_newrelicotlp',
  'class' => 'FastlyLoggingNewrelicotlpUpdateLogNewrelicotlp',
  'api_class' => 'LoggingNewrelicotlpApi',
  'method_name' => 'updateLogNewrelicotlp',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/newrelicotlp/{logging_newrelicotlp_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a New Relic log endpoint',
  'description' => 'Update a New Relic log endpoint',
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
    'logging_newrelicotlp_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_newrelicotlp_name`.',
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
    'token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `token`.',
    ),
    'region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `region`.',
    ),
    'url' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `url`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_newrelicotlp_name' => 'logging_newrelicotlp_name',
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
    'token' => 'token',
    'region' => 'region',
    'url' => 'url',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
