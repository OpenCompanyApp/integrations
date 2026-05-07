<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * List Cerebras dedicated endpoints.
 */
class CerebrasListEndpoints extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_list_endpoints';
    protected const DESCRIPTION = 'List Cerebras dedicated endpoints.';
    protected const METHOD = 'GET';
    protected const PATH = '/management/v1/orgs/{org_name}/endpoints';
    protected const PATH_PARAMS = ['org_name'];
    protected const PARAMETERS = ['org_name' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras org_name.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
