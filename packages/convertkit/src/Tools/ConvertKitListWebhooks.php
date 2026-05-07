<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List subscriber event webhooks.
 */
class ConvertKitListWebhooks extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_webhooks';
    protected const TOOL_DESCRIPTION = 'List subscriber event webhooks.';
    protected const METHOD = 'GET';
    protected const PATH = '/webhooks';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
