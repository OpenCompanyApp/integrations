<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Restart a Travis CI build.
 */
class TravisCiRestartBuild extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_restart_build';
    protected const DESCRIPTION = 'Restart a completed or canceled Travis CI build.';
    protected const METHOD = 'restartBuild';
    protected const REQUIRED = ['build_id'];
    protected const PARAMETERS = ['build_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis build id.']];
}
