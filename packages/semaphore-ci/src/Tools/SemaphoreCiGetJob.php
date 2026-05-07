<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get one Semaphore job.
 */
class SemaphoreCiGetJob extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_job';
    protected const DESCRIPTION = 'Get a Semaphore job by job_id.';
    protected const METHOD = 'getJob';
    protected const REQUIRED = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'string', 'required' => true, 'description' => 'Job UUID.']];
}
