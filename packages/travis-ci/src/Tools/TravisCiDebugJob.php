<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Restart a Travis CI job in debug mode.
 */
class TravisCiDebugJob extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_debug_job';
    protected const DESCRIPTION = 'Restart a Travis CI job in debug mode, where available.';
    protected const METHOD = 'debugJob';
    protected const REQUIRED = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis job id.']];
}
