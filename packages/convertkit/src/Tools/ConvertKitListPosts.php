<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List public posts from the account.
 */
class ConvertKitListPosts extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_posts';
    protected const TOOL_DESCRIPTION = 'List public posts from the account.';
    protected const METHOD = 'GET';
    protected const PATH = '/posts';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
