<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI repository environment variables.
 */
class TravisCiListEnvVars extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_env_vars';
    protected const DESCRIPTION = 'List Travis CI environment variables for a repository.';
    protected const METHOD = 'listEnvVars';
    protected const REQUIRED = ['repository'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'], 'query' => ['type' => 'object', 'description' => 'Optional include query.']];
}
