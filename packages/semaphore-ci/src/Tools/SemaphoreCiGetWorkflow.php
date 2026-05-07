<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get one Semaphore workflow.
 */
class SemaphoreCiGetWorkflow extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_workflow';
    protected const DESCRIPTION = 'Get a Semaphore workflow by workflow_id.';
    protected const METHOD = 'getWorkflow';
    protected const REQUIRED = ['workflow_id'];
    protected const PARAMETERS = ['workflow_id' => ['type' => 'string', 'required' => true, 'description' => 'Workflow UUID.']];
}
