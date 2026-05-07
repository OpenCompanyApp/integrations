<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Create a company using Affinity API.
 */
class AffinityCreateOrganization extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_create_organization';
    protected const TOOL_DESCRIPTION = 'Create a company using Affinity API.';
    protected const METHOD = 'POST';
    protected const PATH = '/organizations';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',  1 => 'domain',  2 => 'domains',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'domain' =>   array (    'type' => 'string',    'description' => 'Body field: domain.',  ),  'domains' =>   array (    'type' => 'array',    'description' => 'Body field: domains.',  ),);
    protected const DYNAMIC_PATH = false;
}
