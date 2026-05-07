<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create a sequence.
 */
class ConvertKitCreateSequence extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_create_sequence';
    protected const TOOL_DESCRIPTION = 'Create a sequence.';
    protected const METHOD = 'POST';
    protected const PATH = '/sequences';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),);
    protected const DYNAMIC_PATH = false;
}
