<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Search calls by user, number, phone number, tags, and dates.
 */
class AircallSearchCalls extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_search_calls';
    protected const TOOL_DESCRIPTION = 'Search calls by user, number, phone number, tags, and dates.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/calls/search';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'page',  1 => 'per_page',  2 => 'order',  3 => 'from',  4 => 'to',  5 => 'direction',  6 => 'user_id',  7 => 'number_id',  8 => 'phone_number',  9 => 'tags',  10 => 'fetch_contact',  11 => 'fetch_short_urls',  12 => 'fetch_ivrs',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'per_page' =>   array (    'type' => 'string',    'description' => 'Query parameter: per_page.',  ),  'order' =>   array (    'type' => 'string',    'description' => 'Query parameter: order.',  ),  'from' =>   array (    'type' => 'string',    'description' => 'Query parameter: from.',  ),  'to' =>   array (    'type' => 'string',    'description' => 'Query parameter: to.',  ),  'direction' =>   array (    'type' => 'string',    'description' => 'Query parameter: direction.',  ),  'user_id' =>   array (    'type' => 'string',    'description' => 'Query parameter: user_id.',  ),  'number_id' =>   array (    'type' => 'string',    'description' => 'Query parameter: number_id.',  ),  'phone_number' =>   array (    'type' => 'string',    'description' => 'Query parameter: phone_number.',  ),  'tags' =>   array (    'type' => 'string',    'description' => 'Query parameter: tags.',  ),  'fetch_contact' =>   array (    'type' => 'string',    'description' => 'Query parameter: fetch_contact.',  ),  'fetch_short_urls' =>   array (    'type' => 'string',    'description' => 'Query parameter: fetch_short_urls.',  ),  'fetch_ivrs' =>   array (    'type' => 'string',    'description' => 'Query parameter: fetch_ivrs.',  ),);
    protected const DYNAMIC_PATH = false;
}
