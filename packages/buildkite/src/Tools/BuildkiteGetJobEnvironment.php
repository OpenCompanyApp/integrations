<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Get Buildkite job environment variables.
 */
class BuildkiteGetJobEnvironment extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_get_job_environment';
    protected const DESCRIPTION = 'Get environment variables for one Buildkite job.';
    protected const METHOD = 'getJobEnvironment';
    protected const REQUIRED = ['organization', 'pipeline', 'number', 'job_id'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'number' => ['type' => 'integer', 'required' => true, 'description' => 'Build number, not build UUID.'],
        'job_id' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite job UUID.'],
    ];
}
