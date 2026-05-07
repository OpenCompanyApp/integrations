<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List lists where a company appears.
 */
class AffinityListOrganizationLists extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_organization_lists';
    protected const TOOL_DESCRIPTION = 'List lists where a company appears.';
    protected const METHOD = 'GET';
    protected const PATH = '/companies/{company_id}/lists';
    protected const PATH_KEYS = array (  0 => 'company_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'company_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for company id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),);
    protected const DYNAMIC_PATH = false;
}
