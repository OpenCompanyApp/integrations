<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Get account subscriber growth stats for a date range.
 */
class ConvertKitGetGrowthStats extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_get_growth_stats';
    protected const TOOL_DESCRIPTION = 'Get account subscriber growth stats for a date range.';
    protected const METHOD = 'GET';
    protected const PATH = '/account/growth_stats';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'starting',  1 => 'ending',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),  'starting' =>   array (    'type' => 'string',    'description' => 'Query parameter: starting.',  ),  'ending' =>   array (    'type' => 'string',    'description' => 'Query parameter: ending.',  ),);
    protected const DYNAMIC_PATH = false;
}
