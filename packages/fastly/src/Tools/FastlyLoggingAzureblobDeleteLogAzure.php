<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete the Azure Blob Storage log endpoint
 *
 * Maps to Fastly generated client operation LoggingAzureblobApi::deleteLogAzure (DELETE /service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}).
 */
class FastlyLoggingAzureblobDeleteLogAzure extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_azureblob_delete_log_azure';
    protected const DESCRIPTION = 'Delete the Azure Blob Storage log endpoint

Official Fastly client operation: LoggingAzureblobApi::deleteLogAzure
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}

Delete the Azure Blob Storage log endpoint';
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
  'slug' => 'fastly_logging_azureblob_delete_log_azure',
  'class' => 'FastlyLoggingAzureblobDeleteLogAzure',
  'api_class' => 'LoggingAzureblobApi',
  'method_name' => 'deleteLogAzure',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/azureblob/{logging_azureblob_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete the Azure Blob Storage log endpoint',
  'description' => 'Delete the Azure Blob Storage log endpoint',
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
