<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Stop a Semaphore job.
 */
class SemaphoreCiStopJob extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_stop_job';
    protected const DESCRIPTION = 'Stop a Semaphore job by job_id.';
    protected const METHOD = 'stopJob';
    protected const REQUIRED = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'string', 'required' => true, 'description' => 'Job UUID.']];
}
