<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Deactivate a Travis CI repository.
 */
class TravisCiDeactivateRepository extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_deactivate_repository';
    protected const DESCRIPTION = 'Deactivate Travis CI for a repository.';
    protected const METHOD = 'deactivateRepository';
    protected const REQUIRED = ['repository'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.']];
}
