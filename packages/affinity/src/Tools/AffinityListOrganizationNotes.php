<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List notes related to a company.
 */
class AffinityListOrganizationNotes extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_organization_notes';
    protected const TOOL_DESCRIPTION = 'List notes related to a company.';
    protected const METHOD = 'GET';
    protected const PATH = '/companies/{company_id}/notes';
    protected const PATH_KEYS = array (  0 => 'company_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'filter',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'company_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for company id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'filter' =>   array (    'type' => 'string',    'description' => 'Query parameter: filter.',  ),);
    protected const DYNAMIC_PATH = false;
}
