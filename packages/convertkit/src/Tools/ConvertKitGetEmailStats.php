<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Get account email stats for the recent reporting window.
 */
class ConvertKitGetEmailStats extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_get_email_stats';
    protected const TOOL_DESCRIPTION = 'Get account email stats for the recent reporting window.';
    protected const METHOD = 'GET';
    protected const PATH = '/account/email_stats';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
