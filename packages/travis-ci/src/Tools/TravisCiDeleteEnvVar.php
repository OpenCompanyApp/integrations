<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Delete a Travis CI repository environment variable.
 */
class TravisCiDeleteEnvVar extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_delete_env_var';
    protected const DESCRIPTION = 'Delete a Travis CI repository environment variable.';
    protected const METHOD = 'deleteEnvVar';
    protected const REQUIRED = ['repository', 'env_var_id'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'], 'env_var_id' => ['type' => 'string', 'required' => true, 'description' => 'Environment variable id.']];
}
