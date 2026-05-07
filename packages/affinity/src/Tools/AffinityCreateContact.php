<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Create a person using Affinity API.
 */
class AffinityCreateContact extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_create_contact';
    protected const TOOL_DESCRIPTION = 'Create a person using Affinity API.';
    protected const METHOD = 'POST';
    protected const PATH = '/persons';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'firstName',  1 => 'lastName',  2 => 'emails',  3 => 'organizationIds',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'firstName' =>   array (    'type' => 'string',    'description' => 'Body field: firstName.',  ),  'lastName' =>   array (    'type' => 'string',    'description' => 'Body field: lastName.',  ),  'emails' =>   array (    'type' => 'array',    'description' => 'Body field: emails.',  ),  'organizationIds' =>   array (    'type' => 'array',    'description' => 'Body field: organizationIds.',  ),);
    protected const DYNAMIC_PATH = false;
}
