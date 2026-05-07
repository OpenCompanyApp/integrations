<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Update aliases for a Cerebras model version.
 */
class CerebrasUpdateModelVersionAliases extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_update_model_version_aliases';
    protected const DESCRIPTION = 'Update aliases for a Cerebras model version.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/management/v1/orgs/{org_name}/models/{model_arch_id}/versions/{version_id}';
    protected const PATH_PARAMS = ['org_name', 'model_arch_id', 'version_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['org_name' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras org_name.'], 'model_arch_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras model_arch_id.'], 'version_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras version_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'description' => 'Request body or multipart fields matching the Cerebras API schema.']];
}
