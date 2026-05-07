<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Delete a Cerebras model version.
 */
class CerebrasDeleteModelVersion extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_delete_model_version';
    protected const DESCRIPTION = 'Delete a Cerebras model version.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/management/v1/orgs/{org_name}/models/{model_arch_id}/versions/{version_id}';
    protected const PATH_PARAMS = ['org_name', 'model_arch_id', 'version_id'];
    protected const PARAMETERS = ['org_name' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras org_name.'], 'model_arch_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras model_arch_id.'], 'version_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras version_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
