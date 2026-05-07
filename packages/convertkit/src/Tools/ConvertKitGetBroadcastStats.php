<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Get stats for a single broadcast.
 */
class ConvertKitGetBroadcastStats extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_get_broadcast_stats';
    protected const TOOL_DESCRIPTION = 'Get stats for a single broadcast.';
    protected const METHOD = 'GET';
    protected const PATH = '/broadcasts/{broadcast_id}/stats';
    protected const PATH_KEYS = array (  0 => 'broadcast_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'broadcast_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for broadcast id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
