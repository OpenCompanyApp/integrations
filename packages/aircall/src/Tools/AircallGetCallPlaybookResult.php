<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve call playbook result.
 */
class AircallGetCallPlaybookResult extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_call_playbook_result';
    protected const TOOL_DESCRIPTION = 'Retrieve call playbook result.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/calls/{call_id}/playbook_result';
    protected const PATH_KEYS = array (  0 => 'call_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'call_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for call id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
