<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Cancel a Travis CI job.
 */
class TravisCiCancelJob extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_cancel_job';
    protected const DESCRIPTION = 'Cancel a currently running Travis CI job.';
    protected const METHOD = 'cancelJob';
    protected const REQUIRED = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis job id.']];
}
