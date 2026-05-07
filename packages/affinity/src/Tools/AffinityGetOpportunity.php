<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get an opportunity by ID.
 */
class AffinityGetOpportunity extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_opportunity';
    protected const TOOL_DESCRIPTION = 'Get an opportunity by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/opportunities/{opportunity_id}';
    protected const PATH_KEYS = array (  0 => 'opportunity_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'opportunity_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for opportunity id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
