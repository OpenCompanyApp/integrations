<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update a Mistral workflow.
 */
class MistralUpdateWorkflow extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_workflow';
    protected const DESCRIPTION = 'Update a Mistral workflow.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/workflows/{workflow_identifier}';
    protected const PATH_PARAMS = ['workflow_identifier'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['workflow_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Mistral workflow_identifier.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
