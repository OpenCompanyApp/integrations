<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List fragments for a transcript.
 */
class AffinityListTranscriptFragments extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_transcript_fragments';
    protected const TOOL_DESCRIPTION = 'List fragments for a transcript.';
    protected const METHOD = 'GET';
    protected const PATH = '/transcripts/{transcript_id}/fragments';
    protected const PATH_KEYS = array (  0 => 'transcript_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'transcript_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for transcript id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),);
    protected const DYNAMIC_PATH = false;
}
