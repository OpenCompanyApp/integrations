<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Activate a Travis CI repository.
 */
class TravisCiActivateRepository extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_activate_repository';
    protected const DESCRIPTION = 'Activate Travis CI for a repository.';
    protected const METHOD = 'activateRepository';
    protected const REQUIRED = ['repository'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.']];
}
