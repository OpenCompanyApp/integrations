<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Execute a Mistral workflow registration.
 */
class MistralExecuteWorkflowRegistration extends AbstractMistralTool
{
    protected const NAME = 'mistral_execute_workflow_registration';
    protected const DESCRIPTION = 'Execute a Mistral workflow registration.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/workflows/registrations/{workflow_registration_id}/execute';
    protected const PATH_PARAMS = ['workflow_registration_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['workflow_registration_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral workflow_registration_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
