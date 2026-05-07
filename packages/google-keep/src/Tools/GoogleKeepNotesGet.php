<?php

namespace OpenCompany\Integrations\GoogleKeep\Tools;

/**
 * Notes Get.
 *
 * Maps to the official Google Keep endpoint GET /v1/{+name}.
 */
class GoogleKeepNotesGet extends AbstractGoogleKeepTool
{
    protected const NAME = 'google_keep_notes_get';
    protected const DESCRIPTION = 'Notes Get

Official Google Keep endpoint: GET /v1/{+name}
Gets a note.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use official Keep resource names such as `notes/note-id`, `notes/note-id/permissions/permission-id`, or attachment names for media downloads.',
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
);
    protected const BODY_REQUIRED = false;
}
