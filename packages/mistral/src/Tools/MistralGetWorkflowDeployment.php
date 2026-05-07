<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral workflow deployment.
 */
class MistralGetWorkflowDeployment extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow_deployment';
    protected const DESCRIPTION = 'Get a Mistral workflow deployment.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/deployments/{name}';
    protected const PATH_PARAMS = ['name'];
    protected const PARAMETERS = ['name' => ['type' => 'string', 'required' => true, 'description' => 'Mistral name.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
