<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get a transcript by ID.
 */
class AffinityGetTranscript extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_transcript';
    protected const TOOL_DESCRIPTION = 'Get a transcript by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/transcripts/{transcript_id}';
    protected const PATH_KEYS = array (  0 => 'transcript_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'transcript_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for transcript id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
