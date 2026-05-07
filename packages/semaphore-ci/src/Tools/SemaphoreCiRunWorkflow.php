<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Run a Semaphore workflow.
 */
class SemaphoreCiRunWorkflow extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_run_workflow';
    protected const DESCRIPTION = 'Run a Semaphore workflow for a project and git reference.';
    protected const METHOD = 'runWorkflow';
    protected const REQUIRED = ['payload'];
    protected const PARAMETERS = ['payload' => ['type' => 'object', 'required' => true, 'description' => 'Workflow payload with project_id, reference, optional commit_sha, pipeline_file, and parameters.']];
}
