<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Stop a Semaphore workflow.
 */
class SemaphoreCiStopWorkflow extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_stop_workflow';
    protected const DESCRIPTION = 'Stop a Semaphore workflow by workflow_id.';
    protected const METHOD = 'stopWorkflow';
    protected const REQUIRED = ['workflow_id'];
    protected const PARAMETERS = ['workflow_id' => ['type' => 'string', 'required' => true, 'description' => 'Workflow UUID.']];
}
