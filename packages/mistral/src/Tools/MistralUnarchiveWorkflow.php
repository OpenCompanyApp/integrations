<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Unarchive a Mistral workflow.
 */
class MistralUnarchiveWorkflow extends AbstractMistralTool
{
    protected const NAME = 'mistral_unarchive_workflow';
    protected const DESCRIPTION = 'Unarchive a Mistral workflow.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/workflows/{workflow_identifier}/unarchive';
    protected const PATH_PARAMS = ['workflow_identifier'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['workflow_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Mistral workflow_identifier.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
