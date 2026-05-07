<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Operations Advance Relocate Bucket.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/operations/{operationId}/advanceRelocateBucket.
 */
class GoogleCloudStorageOperationsAdvanceRelocateBucket extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_operations_advance_relocate_bucket';
    protected const DESCRIPTION = 'Operations Advance Relocate Bucket

Official Cloud Storage endpoint: POST /b/{bucket}/operations/{operationId}/advanceRelocateBucket
Starts asynchronous advancement of the relocate bucket operation in the case of required write downtime, to allow it to lock the bucket at the source location, and proceed with the bucket location swap. The server makes a best effort to advance the relocate bucket operation, but success is not guaranteed.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `AdvanceRelocateBucketOperationRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/operations/{operationId}/advanceRelocateBucket';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'operationId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
