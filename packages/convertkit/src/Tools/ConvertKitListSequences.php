<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List email sequences.
 */
class ConvertKitListSequences extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_sequences';
    protected const TOOL_DESCRIPTION = 'List email sequences.';
    protected const METHOD = 'GET';
    protected const PATH = '/sequences';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
