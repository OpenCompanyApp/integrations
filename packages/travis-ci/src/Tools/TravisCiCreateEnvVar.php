<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Create a Travis CI repository environment variable.
 */
class TravisCiCreateEnvVar extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_create_env_var';
    protected const DESCRIPTION = 'Create a Travis CI repository environment variable.';
    protected const METHOD = 'createEnvVar';
    protected const REQUIRED = ['repository', 'payload'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Environment variable payload.']];
}
