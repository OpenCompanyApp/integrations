<?php

namespace OpenCompany\Integrations\GoogleKeep\Tools;

/**
 * Notes Permissions Batch Create.
 *
 * Maps to the official Google Keep endpoint POST /v1/{+parent}/permissions:batchCreate.
 */
class GoogleKeepNotesPermissionsBatchCreate extends AbstractGoogleKeepTool
{
    protected const NAME = 'google_keep_notes_permissions_batch_create';
    protected const DESCRIPTION = 'Notes Permissions Batch Create

Official Google Keep endpoint: POST /v1/{+parent}/permissions:batchCreate
Creates one or more permissions on the note.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use official Keep resource names such as `notes/note-id`, `notes/note-id/permissions/permission-id`, or attachment names for media downloads.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Keep `BatchCreatePermissionsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/permissions:batchCreate';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
