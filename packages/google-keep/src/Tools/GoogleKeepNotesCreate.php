<?php

namespace OpenCompany\Integrations\GoogleKeep\Tools;

/**
 * Notes Create.
 *
 * Maps to the official Google Keep endpoint POST /v1/notes.
 */
class GoogleKeepNotesCreate extends AbstractGoogleKeepTool
{
    protected const NAME = 'google_keep_notes_create';
    protected const DESCRIPTION = 'Notes Create

Official Google Keep endpoint: POST /v1/notes
Creates a new note.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Keep `Note` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/notes';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
