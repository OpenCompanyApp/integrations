<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List forms and landing pages.
 */
class ConvertKitListForms extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_forms';
    protected const TOOL_DESCRIPTION = 'List forms and landing pages.';
    protected const METHOD = 'GET';
    protected const PATH = '/forms';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'status',  1 => 'type',  2 => 'after',  3 => 'before',  4 => 'per_page',  5 => 'include_total_count',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),  'status' =>   array (    'type' => 'string',    'description' => 'Query parameter: status.',  ),  'type' =>   array (    'type' => 'string',    'description' => 'Query parameter: type.',  ),  'after' =>   array (    'type' => 'string',    'description' => 'Query parameter: after.',  ),  'before' =>   array (    'type' => 'string',    'description' => 'Query parameter: before.',  ),  'per_page' =>   array (    'type' => 'string',    'description' => 'Query parameter: per page.',  ),  'include_total_count' =>   array (    'type' => 'string',    'description' => 'Query parameter: include total count.',  ),);
    protected const DYNAMIC_PATH = false;
}
