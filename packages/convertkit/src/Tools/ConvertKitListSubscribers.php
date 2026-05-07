<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List subscribers with cursor pagination and filters.
 */
class ConvertKitListSubscribers extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_subscribers';
    protected const TOOL_DESCRIPTION = 'List subscribers with cursor pagination and filters.';
    protected const METHOD = 'GET';
    protected const PATH = '/subscribers';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'after',  1 => 'before',  2 => 'per_page',  3 => 'include_total_count',  4 => 'email_address',  5 => 'created_after',  6 => 'created_before',  7 => 'updated_after',  8 => 'updated_before',  9 => 'state',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),  'after' =>   array (    'type' => 'string',    'description' => 'Query parameter: after.',  ),  'before' =>   array (    'type' => 'string',    'description' => 'Query parameter: before.',  ),  'per_page' =>   array (    'type' => 'string',    'description' => 'Query parameter: per page.',  ),  'include_total_count' =>   array (    'type' => 'string',    'description' => 'Query parameter: include total count.',  ),  'email_address' =>   array (    'type' => 'string',    'description' => 'Query parameter: email address.',  ),  'created_after' =>   array (    'type' => 'string',    'description' => 'Query parameter: created after.',  ),  'created_before' =>   array (    'type' => 'string',    'description' => 'Query parameter: created before.',  ),  'updated_after' =>   array (    'type' => 'string',    'description' => 'Query parameter: updated after.',  ),  'updated_before' =>   array (    'type' => 'string',    'description' => 'Query parameter: updated before.',  ),  'state' =>   array (    'type' => 'string',    'description' => 'Query parameter: state.',  ),);
    protected const DYNAMIC_PATH = false;
}
