<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List brand colors configured for the account.
 */
class ConvertKitListColors extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_colors';
    protected const TOOL_DESCRIPTION = 'List brand colors configured for the account.';
    protected const METHOD = 'GET';
    protected const PATH = '/account/colors';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
