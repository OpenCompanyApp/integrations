<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List list entries for a company.
 */
class AffinityListOrganizationListEntries extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_organization_list_entries';
    protected const TOOL_DESCRIPTION = 'List list entries for a company.';
    protected const METHOD = 'GET';
    protected const PATH = '/companies/{company_id}/list-entries';
    protected const PATH_KEYS = array (  0 => 'company_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'fieldIds',  3 => 'fieldTypes',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'company_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for company id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'fieldIds' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldIds.',  ),  'fieldTypes' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldTypes.',  ),);
    protected const DYNAMIC_PATH = false;
}
