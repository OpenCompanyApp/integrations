<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Cancel a Travis CI build.
 */
class TravisCiCancelBuild extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_cancel_build';
    protected const DESCRIPTION = 'Cancel a currently running Travis CI build.';
    protected const METHOD = 'cancelBuild';
    protected const REQUIRED = ['build_id'];
    protected const PARAMETERS = ['build_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis build id.']];
}
