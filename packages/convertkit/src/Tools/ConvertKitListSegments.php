<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List audience segments.
 */
class ConvertKitListSegments extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_segments';
    protected const TOOL_DESCRIPTION = 'List audience segments.';
    protected const METHOD = 'GET';
    protected const PATH = '/segments';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
