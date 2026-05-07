<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List notes related to an opportunity.
 */
class AffinityListOpportunityNotes extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_opportunity_notes';
    protected const TOOL_DESCRIPTION = 'List notes related to an opportunity.';
    protected const METHOD = 'GET';
    protected const PATH = '/opportunities/{opportunity_id}/notes';
    protected const PATH_KEYS = array (  0 => 'opportunity_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'filter',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'opportunity_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for opportunity id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'filter' =>   array (    'type' => 'string',    'description' => 'Query parameter: filter.',  ),);
    protected const DYNAMIC_PATH = false;
}
