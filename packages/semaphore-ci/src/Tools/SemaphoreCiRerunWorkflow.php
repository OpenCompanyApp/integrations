<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Rerun a Semaphore workflow.
 */
class SemaphoreCiRerunWorkflow extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_rerun_workflow';
    protected const DESCRIPTION = 'Rerun a Semaphore workflow with a request_token idempotency value.';
    protected const METHOD = 'rerunWorkflow';
    protected const REQUIRED = ['workflow_id', 'request_token'];
    protected const PARAMETERS = ['workflow_id' => ['type' => 'string', 'required' => true, 'description' => 'Workflow UUID.'], 'request_token' => ['type' => 'string', 'required' => true, 'description' => 'Idempotency token.']];
}
