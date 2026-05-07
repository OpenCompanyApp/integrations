<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an Azure Blob Storage log endpoint
 *
 * Maps to Fastly generated client operation LoggingAzureblobApi::getLogAzure (GET /service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}).
 */
class FastlyLoggingAzureblobGetLogAzure extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_azureblob_get_log_azure';
    protected const DESCRIPTION = 'Get an Azure Blob Storage log endpoint

Official Fastly client operation: LoggingAzureblobApi::getLogAzure
Endpoint: GET /service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}

Get an Azure Blob Storage log endpoint';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_azureblob_get_log_azure',
  'class' => 'FastlyLoggingAzureblobGetLogAzure',
  'api_class' => 'LoggingAzureblobApi',
  'method_name' => 'getLogAzure',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an Azure Blob Storage log endpoint',
  'description' => 'Get an Azure Blob Storage log endpoint',
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
    'logging_azureblob_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_azureblob_name`.',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
