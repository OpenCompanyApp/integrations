<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI jobs for the current user.
 */
class TravisCiListJobs extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_jobs';
    protected const DESCRIPTION = 'List Travis CI jobs visible to the current user.';
    protected const METHOD = 'listJobs';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Job filters and pagination query parameters.']];
}
