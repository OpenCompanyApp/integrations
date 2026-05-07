<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Restart a Travis CI job.
 */
class TravisCiRestartJob extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_restart_job';
    protected const DESCRIPTION = 'Restart a completed or canceled Travis CI job.';
    protected const METHOD = 'restartJob';
    protected const REQUIRED = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis job id.']];
}
