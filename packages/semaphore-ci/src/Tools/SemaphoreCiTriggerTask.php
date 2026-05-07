<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Trigger a Semaphore task.
 */
class SemaphoreCiTriggerTask extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_trigger_task';
    protected const DESCRIPTION = 'Trigger a Semaphore task immediately with optional reference, pipeline_file, and parameters.';
    protected const METHOD = 'triggerTask';
    protected const REQUIRED = ['task_id'];
    protected const PARAMETERS = ['task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task UUID.'], 'payload' => ['type' => 'object', 'description' => 'Optional task run payload.']];
}
