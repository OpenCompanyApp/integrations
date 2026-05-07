<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get a single field value on a company.
 */
class AffinityGetOrganizationFieldValue extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_organization_field_value';
    protected const TOOL_DESCRIPTION = 'Get a single field value on a company.';
    protected const METHOD = 'GET';
    protected const PATH = '/companies/{company_id}/fields/{field_id}';
    protected const PATH_KEYS = array (  0 => 'company_id',  1 => 'field_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'company_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for company id.',  ),  'field_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for field id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
