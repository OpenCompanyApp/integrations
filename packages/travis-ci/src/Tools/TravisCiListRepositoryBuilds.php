<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI builds for a repository.
 */
class TravisCiListRepositoryBuilds extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_repository_builds';
    protected const DESCRIPTION = 'List Travis CI builds for a repository with optional branch, state, event_type, include, limit, and offset query parameters.';
    protected const METHOD = 'listRepositoryBuilds';
    protected const REQUIRED = ['repository'];
    protected const PARAMETERS = [
        'repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'],
        'query' => ['type' => 'object', 'description' => 'Build filters and pagination query parameters.'],
    ];
}
