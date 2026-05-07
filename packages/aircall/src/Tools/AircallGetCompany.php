<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve company information.
 */
class AircallGetCompany extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_company';
    protected const TOOL_DESCRIPTION = 'Retrieve company information.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/company';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
