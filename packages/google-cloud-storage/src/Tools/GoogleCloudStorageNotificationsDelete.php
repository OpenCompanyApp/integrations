<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Notifications Delete.
 *
 * Maps to the official Cloud Storage endpoint DELETE /b/{bucket}/notificationConfigs/{notification}.
 */
class GoogleCloudStorageNotificationsDelete extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_notifications_delete';
    protected const DESCRIPTION = 'Notifications Delete

Official Cloud Storage endpoint: DELETE /b/{bucket}/notificationConfigs/{notification}
Permanently deletes a notification subscription.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'notification' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `notification`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: userProject.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/b/{bucket}/notificationConfigs/{notification}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'notification',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
