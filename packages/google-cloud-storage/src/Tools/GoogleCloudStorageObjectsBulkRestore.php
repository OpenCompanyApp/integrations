<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Bulk Restore.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/o/bulkRestore.
 */
class GoogleCloudStorageObjectsBulkRestore extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_bulk_restore';
    protected const DESCRIPTION = 'Objects Bulk Restore

Official Cloud Storage endpoint: POST /b/{bucket}/o/bulkRestore
Initiates a long-running bulk restore operation on the specified bucket.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `BulkRestoreObjectsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/o/bulkRestore';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
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
