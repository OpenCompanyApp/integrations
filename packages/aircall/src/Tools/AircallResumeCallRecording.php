<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Resume live recording on a call.
 */
class AircallResumeCallRecording extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_resume_call_recording';
    protected const TOOL_DESCRIPTION = 'Resume live recording on a call.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/calls/{call_id}/resume_recording';
    protected const PATH_KEYS = array (  0 => 'call_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'call_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for call id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
