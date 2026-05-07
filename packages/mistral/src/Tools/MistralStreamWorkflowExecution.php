<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Read stream response for a Mistral workflow execution.
 */
class MistralStreamWorkflowExecution extends AbstractMistralTool
{
    protected const NAME = 'mistral_stream_workflow_execution';
    protected const DESCRIPTION = 'Read stream response for a Mistral workflow execution.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/executions/{execution_id}/stream';
    protected const PATH_PARAMS = ['execution_id'];
    protected const PARAMETERS = ['execution_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral execution_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
