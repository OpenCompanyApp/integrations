<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List subscriber tags.
 */
class ConvertKitListTags extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_tags';
    protected const TOOL_DESCRIPTION = 'List subscriber tags.';
    protected const METHOD = 'GET';
    protected const PATH = '/tags';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
