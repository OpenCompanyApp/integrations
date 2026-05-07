<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral workflow schedule.
 */
class MistralUnscheduleWorkflow extends AbstractMistralTool
{
    protected const NAME = 'mistral_unschedule_workflow';
    protected const DESCRIPTION = 'Delete a Mistral workflow schedule.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/workflows/schedules/{schedule_id}';
    protected const PATH_PARAMS = ['schedule_id'];
    protected const PARAMETERS = ['schedule_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral schedule_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
