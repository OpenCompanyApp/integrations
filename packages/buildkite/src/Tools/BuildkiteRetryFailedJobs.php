<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Retry failed jobs for a Buildkite build.
 */
class BuildkiteRetryFailedJobs extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_retry_failed_jobs';
    protected const DESCRIPTION = 'Retry failed jobs for a Buildkite build. Optionally provide payload.states such as failed,soft_failed.';
    protected const METHOD = 'retryFailedJobs';
    protected const REQUIRED = ['organization', 'pipeline', 'number'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'number' => ['type' => 'integer', 'required' => true, 'description' => 'Build number, not build UUID.'],
        'payload' => ['type' => 'object', 'description' => 'Optional payload, for example {"states":"failed,soft_failed"}.'],
    ];
}
