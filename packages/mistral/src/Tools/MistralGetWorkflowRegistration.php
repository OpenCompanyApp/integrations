<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral workflow registration.
 */
class MistralGetWorkflowRegistration extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow_registration';
    protected const DESCRIPTION = 'Get a Mistral workflow registration.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/registrations/{workflow_registration_id}';
    protected const PATH_PARAMS = ['workflow_registration_id'];
    protected const PARAMETERS = ['workflow_registration_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral workflow_registration_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
