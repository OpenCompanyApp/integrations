<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Batch cancel Mistral workflow executions.
 */
class MistralBatchCancelWorkflowExecutions extends AbstractMistralTool
{
    protected const NAME = 'mistral_batch_cancel_workflow_executions';
    protected const DESCRIPTION = 'Batch cancel Mistral workflow executions.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/workflows/executions/cancel';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
