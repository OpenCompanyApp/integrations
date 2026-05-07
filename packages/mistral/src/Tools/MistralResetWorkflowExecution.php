<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Reset a Mistral workflow execution.
 */
class MistralResetWorkflowExecution extends AbstractMistralTool
{
    protected const NAME = 'mistral_reset_workflow_execution';
    protected const DESCRIPTION = 'Reset a Mistral workflow execution.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/workflows/executions/{execution_id}/reset';
    protected const PATH_PARAMS = ['execution_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['execution_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral execution_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
