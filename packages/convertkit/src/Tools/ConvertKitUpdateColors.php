<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Update account brand colors.
 */
class ConvertKitUpdateColors extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_update_colors';
    protected const TOOL_DESCRIPTION = 'Update account brand colors.';
    protected const METHOD = 'PUT';
    protected const PATH = '/account/colors';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'colors',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'colors' =>   array (    'type' => 'array',    'description' => 'Body field: colors.',  ),);
    protected const DYNAMIC_PATH = false;
}
