<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get a company by ID.
 */
class AffinityGetOrganization extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_organization';
    protected const TOOL_DESCRIPTION = 'Get a company by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/companies/{company_id}';
    protected const PATH_KEYS = array (  0 => 'company_id',);
    protected const QUERY_KEYS = array (  0 => 'fieldIds',  1 => 'fieldTypes',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'company_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for company id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'fieldIds' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldIds.',  ),  'fieldTypes' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldTypes.',  ),);
    protected const DYNAMIC_PATH = false;
}
