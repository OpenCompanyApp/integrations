<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Delete a sequence.
 */
class ConvertKitDeleteSequence extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_delete_sequence';
    protected const TOOL_DESCRIPTION = 'Delete a sequence.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/sequences/{id}';
    protected const PATH_KEYS = array (  0 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
