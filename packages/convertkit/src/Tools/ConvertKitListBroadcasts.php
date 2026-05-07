<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List broadcasts with cursor pagination and filters.
 */
class ConvertKitListBroadcasts extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_broadcasts';
    protected const TOOL_DESCRIPTION = 'List broadcasts with cursor pagination and filters.';
    protected const METHOD = 'GET';
    protected const PATH = '/broadcasts';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
