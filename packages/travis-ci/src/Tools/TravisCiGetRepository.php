<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Get one Travis CI repository.
 */
class TravisCiGetRepository extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_get_repository';
    protected const DESCRIPTION = 'Get a Travis CI repository by numeric id, owner/name slug, or provider/owner/name slug.';
    protected const METHOD = 'getRepository';
    protected const REQUIRED = ['repository'];
    protected const PARAMETERS = [
        'repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'],
        'query' => ['type' => 'object', 'description' => 'Optional include query.'],
    ];
}
