<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral workflow deployments.
 */
class MistralListWorkflowDeployments extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_workflow_deployments';
    protected const DESCRIPTION = 'List Mistral workflow deployments.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/deployments';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
