<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral workflow schedules.
 */
class MistralListWorkflowSchedules extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_workflow_schedules';
    protected const DESCRIPTION = 'List Mistral workflow schedules.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/schedules';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
