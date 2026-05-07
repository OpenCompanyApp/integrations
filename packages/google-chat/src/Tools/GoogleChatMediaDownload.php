<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Media Download.
 *
 * Maps to the official Google Chat endpoint GET /v1/media/{+resourceName}.
 */
class GoogleChatMediaDownload extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_media_download';
    protected const DESCRIPTION = 'Media Download

Official Google Chat endpoint: GET /v1/media/{+resourceName}
Downloads media. Download is supported on the URI `/v1/media/{+name}?alt=media`.';
    protected const PARAMETERS = array (
  'resourceName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceName` from the official Google Chat API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/media/{+resourceName}';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
