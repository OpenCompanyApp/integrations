<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Archive a call.
 */
class AircallArchiveCall extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_archive_call';
    protected const TOOL_DESCRIPTION = 'Archive a call.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/calls/{call_id}/archive';
    protected const PATH_KEYS = array (  0 => 'call_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'call_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for call id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
