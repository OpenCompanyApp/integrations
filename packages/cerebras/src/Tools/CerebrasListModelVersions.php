<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * List Cerebras model versions.
 */
class CerebrasListModelVersions extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_list_model_versions';
    protected const DESCRIPTION = 'List Cerebras model versions.';
    protected const METHOD = 'GET';
    protected const PATH = '/management/v1/orgs/{org_name}/models/{model_arch_id}/versions';
    protected const PATH_PARAMS = ['org_name', 'model_arch_id'];
    protected const PARAMETERS = ['org_name' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras org_name.'], 'model_arch_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras model_arch_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
