<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List subscribers with a tag.
 */
class ConvertKitListTagSubscribers extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_tag_subscribers';
    protected const TOOL_DESCRIPTION = 'List subscribers with a tag.';
    protected const METHOD = 'GET';
    protected const PATH = '/tags/{tag_id}/subscribers';
    protected const PATH_KEYS = array (  0 => 'tag_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'tag_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for tag id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
