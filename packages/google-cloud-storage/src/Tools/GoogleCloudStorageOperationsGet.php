<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Operations Get.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/operations/{operationId}.
 */
class GoogleCloudStorageOperationsGet extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_operations_get';
    protected const DESCRIPTION = 'Operations Get

Official Cloud Storage endpoint: GET /b/{bucket}/operations/{operationId}
Gets the latest state of a long-running operation.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'operationId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `operationId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/operations/{operationId}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'operationId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
