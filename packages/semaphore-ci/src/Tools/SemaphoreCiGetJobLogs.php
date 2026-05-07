<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get Semaphore job logs.
 */
class SemaphoreCiGetJobLogs extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_job_logs';
    protected const DESCRIPTION = 'Get Semaphore job logs, optionally including artifact job logs.';
    protected const METHOD = 'getJobLogs';
    protected const REQUIRED = ['job_id'];
    protected const PARAMETERS = [
        'job_id' => ['type' => 'string', 'required' => true, 'description' => 'Job UUID.'],
        'artifact_job_logs' => ['type' => 'boolean', 'description' => 'Return artifact job logs when available.'],
        'query' => ['type' => 'object', 'description' => 'Additional query parameters.'],
    ];
}
