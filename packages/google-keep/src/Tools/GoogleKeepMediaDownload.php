<?php

namespace OpenCompany\Integrations\GoogleKeep\Tools;

/**
 * Media Download.
 *
 * Maps to the official Google Keep endpoint GET /v1/{+name}.
 */
class GoogleKeepMediaDownload extends AbstractGoogleKeepTool
{
    protected const NAME = 'google_keep_media_download';
    protected const DESCRIPTION = 'Media Download

Official Google Keep endpoint: GET /v1/{+name}
Gets an attachment.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use official Keep resource names such as `notes/note-id`, `notes/note-id/permissions/permission-id`, or attachment names for media downloads.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Google Keep method. Known keys: mimeType.',
  ),
  'mimeType' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `mimeType`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'mimeType',
);
    protected const BODY_REQUIRED = false;
}
