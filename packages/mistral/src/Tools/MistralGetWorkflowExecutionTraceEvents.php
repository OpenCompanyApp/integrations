<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get trace events for a Mistral workflow execution.
 */
class MistralGetWorkflowExecutionTraceEvents extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow_execution_trace_events';
    protected const DESCRIPTION = 'Get trace events for a Mistral workflow execution.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/executions/{execution_id}/trace/events';
    protected const PATH_PARAMS = ['execution_id'];
    protected const PARAMETERS = ['execution_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral execution_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
