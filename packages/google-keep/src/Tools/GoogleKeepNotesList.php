<?php

namespace OpenCompany\Integrations\GoogleKeep\Tools;

/**
 * Notes List.
 *
 * Maps to the official Google Keep endpoint GET /v1/notes.
 */
class GoogleKeepNotesList extends AbstractGoogleKeepTool
{
    protected const NAME = 'google_keep_notes_list';
    protected const DESCRIPTION = 'Notes List

Official Google Keep endpoint: GET /v1/notes
Lists notes.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Google Keep method. Known keys: pageSize, pageToken, filter.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/notes';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'filter',
);
    protected const BODY_REQUIRED = false;
}
