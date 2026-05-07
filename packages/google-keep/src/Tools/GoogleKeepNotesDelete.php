<?php

namespace OpenCompany\Integrations\GoogleKeep\Tools;

/**
 * Notes Delete.
 *
 * Maps to the official Google Keep endpoint DELETE /v1/{+name}.
 */
class GoogleKeepNotesDelete extends AbstractGoogleKeepTool
{
    protected const NAME = 'google_keep_notes_delete';
    protected const DESCRIPTION = 'Notes Delete

Official Google Keep endpoint: DELETE /v1/{+name}
Deletes a note.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use official Keep resource names such as `notes/note-id`, `notes/note-id/permissions/permission-id`, or attachment names for media downloads.',
  ),
);
    protected const METHOD = 'DELETE';
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
