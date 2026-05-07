<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Retrieve Cerebras model version status.
 */
class CerebrasRetrieveModelVersionStatus extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_retrieve_model_version_status';
    protected const DESCRIPTION = 'Retrieve Cerebras model version status.';
    protected const METHOD = 'GET';
    protected const PATH = '/management/v1/orgs/{org_name}/models/{model_arch_id}/versions/{version_id}';
    protected const PATH_PARAMS = ['org_name', 'model_arch_id', 'version_id'];
    protected const PARAMETERS = ['org_name' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras org_name.'], 'model_arch_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras model_arch_id.'], 'version_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras version_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
