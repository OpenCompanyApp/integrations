<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get trace summary for a Mistral workflow execution.
 */
class MistralGetWorkflowExecutionTraceSummary extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow_execution_trace_summary';
    protected const DESCRIPTION = 'Get trace summary for a Mistral workflow execution.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/executions/{execution_id}/trace/summary';
    protected const PATH_PARAMS = ['execution_id'];
    protected const PARAMETERS = ['execution_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral execution_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
