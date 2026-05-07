<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * List Cerebras model architectures.
 */
class CerebrasListModelArchitectures extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_list_model_architectures';
    protected const DESCRIPTION = 'List Cerebras model architectures.';
    protected const METHOD = 'GET';
    protected const PATH = '/management/v1/orgs/{org_name}/models';
    protected const PATH_PARAMS = ['org_name'];
    protected const PARAMETERS = ['org_name' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras org_name.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
