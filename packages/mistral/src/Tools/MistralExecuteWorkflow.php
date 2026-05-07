<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Execute a Mistral workflow.
 */
class MistralExecuteWorkflow extends AbstractMistralTool
{
    protected const NAME = 'mistral_execute_workflow';
    protected const DESCRIPTION = 'Execute a Mistral workflow.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/workflows/{workflow_identifier}/execute';
    protected const PATH_PARAMS = ['workflow_identifier'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['workflow_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Mistral workflow_identifier.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
