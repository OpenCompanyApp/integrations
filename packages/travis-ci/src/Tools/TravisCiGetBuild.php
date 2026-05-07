<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Get one Travis CI build.
 */
class TravisCiGetBuild extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_get_build';
    protected const DESCRIPTION = 'Get one Travis CI build by build id.';
    protected const METHOD = 'getBuild';
    protected const REQUIRED = ['build_id'];
    protected const PARAMETERS = ['build_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis build id.'], 'query' => ['type' => 'object', 'description' => 'Optional include query.']];
}
