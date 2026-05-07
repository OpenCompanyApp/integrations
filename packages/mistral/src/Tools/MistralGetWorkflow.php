<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral workflow.
 */
class MistralGetWorkflow extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow';
    protected const DESCRIPTION = 'Get a Mistral workflow.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/{workflow_identifier}';
    protected const PATH_PARAMS = ['workflow_identifier'];
    protected const PARAMETERS = ['workflow_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Mistral workflow_identifier.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
