<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an Azure Blob Storage log endpoint
 *
 * Maps to Fastly generated client operation LoggingAzureblobApi::updateLogAzure (PUT /service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}).
 */
class FastlyLoggingAzureblobUpdateLogAzure extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_azureblob_update_log_azure';
    protected const DESCRIPTION = 'Update an Azure Blob Storage log endpoint

Official Fastly client operation: LoggingAzureblobApi::updateLogAzure
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}

Update an Azure Blob Storage log endpoint';
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
  'logging_azureblob_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_azureblob_name`.',
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
  'message_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `message_type`.',
  ),
  'timestamp_format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `timestamp_format`.',
  ),
  'compression_codec' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `compression_codec`.',
  ),
  'period' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `period`.',
  ),
  'gzip_level' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `gzip_level`.',
  ),
  'path' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `path`.',
  ),
  'account_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `account_name`.',
  ),
  'container' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `container`.',
  ),
  'sas_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sas_token`.',
  ),
  'public_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `public_key`.',
  ),
  'file_max_bytes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `file_max_bytes`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_azureblob_update_log_azure',
  'class' => 'FastlyLoggingAzureblobUpdateLogAzure',
  'api_class' => 'LoggingAzureblobApi',
  'method_name' => 'updateLogAzure',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an Azure Blob Storage log endpoint',
  'description' => 'Update an Azure Blob Storage log endpoint',
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
    'logging_azureblob_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_azureblob_name`.',
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
    'message_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `message_type`.',
    ),
    'timestamp_format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `timestamp_format`.',
    ),
    'compression_codec' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `compression_codec`.',
    ),
    'period' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `period`.',
    ),
    'gzip_level' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `gzip_level`.',
    ),
    'path' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `path`.',
    ),
    'account_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `account_name`.',
    ),
    'container' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `container`.',
    ),
    'sas_token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sas_token`.',
    ),
    'public_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `public_key`.',
    ),
    'file_max_bytes' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `file_max_bytes`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_azureblob_name' => 'logging_azureblob_name',
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
    'message_type' => 'message_type',
    'timestamp_format' => 'timestamp_format',
    'compression_codec' => 'compression_codec',
    'period' => 'period',
    'gzip_level' => 'gzip_level',
    'path' => 'path',
    'account_name' => 'account_name',
    'container' => 'container',
    'sas_token' => 'sas_token',
    'public_key' => 'public_key',
    'file_max_bytes' => 'file_max_bytes',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
