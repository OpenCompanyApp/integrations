<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Add a comment to a call.
 */
class AircallCommentCall extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_comment_call';
    protected const TOOL_DESCRIPTION = 'Add a comment to a call.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/calls/{call_id}/comments';
    protected const PATH_KEYS = array (  0 => 'call_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'content',);
    protected const PARAMETERS = array (  'call_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for call id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'content' =>   array (    'type' => 'string',    'description' => 'Body field: content.',  ),);
    protected const DYNAMIC_PATH = false;
}
