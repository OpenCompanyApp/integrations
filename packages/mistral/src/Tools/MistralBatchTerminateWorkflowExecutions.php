<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Batch terminate Mistral workflow executions.
 */
class MistralBatchTerminateWorkflowExecutions extends AbstractMistralTool
{
    protected const NAME = 'mistral_batch_terminate_workflow_executions';
    protected const DESCRIPTION = 'Batch terminate Mistral workflow executions.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/workflows/executions/terminate';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
