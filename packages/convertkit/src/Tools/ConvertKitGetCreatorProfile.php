<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Get Creator Profile details for the account.
 */
class ConvertKitGetCreatorProfile extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_get_creator_profile';
    protected const TOOL_DESCRIPTION = 'Get Creator Profile details for the account.';
    protected const METHOD = 'GET';
    protected const PATH = '/account/creator_profile';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
