<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * About Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/about.
 */
class GoogleDriveAboutGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_about_get';
    protected const DESCRIPTION = 'About Get

Official Google Drive endpoint: GET /drive/v3/about
Gets information about the user, the user\'s Drive, and system capabilities. For more information, see [Return user info](https://developers.google.com/workspace/drive/api/guides/user-info). Required: The `fields` parameter must be set. To return the exact fields you need, see [Return specific fields](https://developers.google.com/workspace/drive/api/guides/fields-parameter).';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/about';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
