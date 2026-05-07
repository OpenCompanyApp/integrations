<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral workflow registrations.
 */
class MistralListWorkflowRegistrations extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_workflow_registrations';
    protected const DESCRIPTION = 'List Mistral workflow registrations.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/registrations';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
