<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral workflow schedule.
 */
class MistralScheduleWorkflow extends AbstractMistralTool
{
    protected const NAME = 'mistral_schedule_workflow';
    protected const DESCRIPTION = 'Create a Mistral workflow schedule.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/workflows/schedules';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
