<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI repositories for one owner.
 */
class TravisCiListOwnerRepositories extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_owner_repositories';
    protected const DESCRIPTION = 'List repositories for an owner login and provider.';
    protected const METHOD = 'listOwnerRepositories';
    protected const REQUIRED = ['login'];
    protected const PARAMETERS = [
        'login' => ['type' => 'string', 'required' => true, 'description' => 'Owner login.'],
        'provider' => ['type' => 'string', 'description' => 'VCS provider. Defaults to github.'],
        'query' => ['type' => 'object', 'description' => 'Pagination, include, filter, and sort query parameters.'],
    ];
}
