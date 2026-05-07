<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Get one Travis CI job.
 */
class TravisCiGetJob extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_get_job';
    protected const DESCRIPTION = 'Get one Travis CI job by job id.';
    protected const METHOD = 'getJob';
    protected const REQUIRED = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis job id.'], 'query' => ['type' => 'object', 'description' => 'Optional include query.']];
}
