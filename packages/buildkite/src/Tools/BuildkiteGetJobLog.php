<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Get Buildkite job log output.
 */
class BuildkiteGetJobLog extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_get_job_log';
    protected const DESCRIPTION = 'Get log output for one Buildkite job.';
    protected const METHOD = 'getJobLog';
    protected const REQUIRED = ['organization', 'pipeline', 'number', 'job_id'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'number' => ['type' => 'integer', 'required' => true, 'description' => 'Build number, not build UUID.'],
        'job_id' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite job UUID.'],
    ];
}
