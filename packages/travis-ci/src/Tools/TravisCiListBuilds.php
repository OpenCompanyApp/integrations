<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI builds for the current user.
 */
class TravisCiListBuilds extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_builds';
    protected const DESCRIPTION = 'List Travis CI builds visible to the current user.';
    protected const METHOD = 'listBuilds';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Pagination, include, and sort query parameters.']];
}
