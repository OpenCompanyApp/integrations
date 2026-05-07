<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Azure Blob Storage log endpoints
 *
 * Maps to Fastly generated client operation LoggingAzureblobApi::listLogAzure (GET /service/{service_id}/version/{version_id}/logging/azureblob).
 */
class FastlyLoggingAzureblobListLogAzure extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_azureblob_list_log_azure';
    protected const DESCRIPTION = 'List Azure Blob Storage log endpoints

Official Fastly client operation: LoggingAzureblobApi::listLogAzure
Endpoint: GET /service/{service_id}/version/{version_id}/logging/azureblob

List Azure Blob Storage log endpoints';
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
  'slug' => 'fastly_logging_azureblob_list_log_azure',
  'class' => 'FastlyLoggingAzureblobListLogAzure',
  'api_class' => 'LoggingAzureblobApi',
  'method_name' => 'listLogAzure',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/azureblob',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Azure Blob Storage log endpoints',
  'description' => 'List Azure Blob Storage log endpoints',
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
