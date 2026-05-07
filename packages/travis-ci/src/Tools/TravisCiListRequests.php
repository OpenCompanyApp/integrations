<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI build requests for a repository.
 */
class TravisCiListRequests extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_requests';
    protected const DESCRIPTION = 'List Travis CI build requests for a repository.';
    protected const METHOD = 'listRequests';
    protected const REQUIRED = ['repository'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'], 'query' => ['type' => 'object', 'description' => 'Request filters and pagination query parameters.']];
}
