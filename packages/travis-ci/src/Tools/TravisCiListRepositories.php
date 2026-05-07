<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI repositories for the current user.
 */
class TravisCiListRepositories extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_repositories';
    protected const DESCRIPTION = 'List Travis CI repositories visible to the current user.';
    protected const METHOD = 'listRepositories';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Pagination, include, filter, and sort query parameters.']];
}
