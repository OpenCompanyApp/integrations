<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List persons attached to a note.
 */
class AffinityListNotePersons extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_note_persons';
    protected const TOOL_DESCRIPTION = 'List persons attached to a note.';
    protected const METHOD = 'GET';
    protected const PATH = '/notes/{note_id}/persons';
    protected const PATH_KEYS = array (  0 => 'note_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'note_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for note id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),);
    protected const DYNAMIC_PATH = false;
}
