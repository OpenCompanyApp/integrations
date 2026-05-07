<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List replies for a note.
 */
class AffinityListNoteReplies extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_note_replies';
    protected const TOOL_DESCRIPTION = 'List replies for a note.';
    protected const METHOD = 'GET';
    protected const PATH = '/notes/{note_id}/replies';
    protected const PATH_KEYS = array (  0 => 'note_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'filter',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'note_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for note id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'filter' =>   array (    'type' => 'string',    'description' => 'Query parameter: filter.',  ),);
    protected const DYNAMIC_PATH = false;
}
