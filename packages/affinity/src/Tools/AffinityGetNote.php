<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get a note by ID.
 */
class AffinityGetNote extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_note';
    protected const TOOL_DESCRIPTION = 'Get a note by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/notes/{note_id}';
    protected const PATH_KEYS = array (  0 => 'note_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'note_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for note id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
