<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Operations Cancel.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/operations/{operationId}/cancel.
 */
class GoogleCloudStorageOperationsCancel extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_operations_cancel';
    protected const DESCRIPTION = 'Operations Cancel

Official Cloud Storage endpoint: POST /b/{bucket}/operations/{operationId}/cancel
Starts asynchronous cancellation on a long-running operation. The server makes a best effort to cancel the operation, but success is not guaranteed.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/operations/{operationId}/cancel';
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
