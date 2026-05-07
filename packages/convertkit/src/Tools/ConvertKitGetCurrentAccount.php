<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Get the authenticated Kit user and account.
 */
class ConvertKitGetCurrentAccount extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_get_current_account';
    protected const TOOL_DESCRIPTION = 'Get the authenticated Kit user and account.';
    protected const METHOD = 'GET';
    protected const PATH = '/account';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
