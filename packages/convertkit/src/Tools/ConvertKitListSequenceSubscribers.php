<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List subscribers for a sequence.
 */
class ConvertKitListSequenceSubscribers extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_sequence_subscribers';
    protected const TOOL_DESCRIPTION = 'List subscribers for a sequence.';
    protected const METHOD = 'GET';
    protected const PATH = '/sequences/{sequence_id}/subscribers';
    protected const PATH_KEYS = array (  0 => 'sequence_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'sequence_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for sequence id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
