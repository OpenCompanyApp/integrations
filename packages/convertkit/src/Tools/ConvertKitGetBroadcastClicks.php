<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Get link click details for a broadcast.
 */
class ConvertKitGetBroadcastClicks extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_get_broadcast_clicks';
    protected const TOOL_DESCRIPTION = 'Get link click details for a broadcast.';
    protected const METHOD = 'GET';
    protected const PATH = '/broadcasts/{broadcast_id}/clicks';
    protected const PATH_KEYS = array (  0 => 'broadcast_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'broadcast_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for broadcast id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
