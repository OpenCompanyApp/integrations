<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI jobs for one build.
 */
class TravisCiListBuildJobs extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_build_jobs';
    protected const DESCRIPTION = 'List Travis CI jobs belonging to an individual build.';
    protected const METHOD = 'listBuildJobs';
    protected const REQUIRED = ['build_id'];
    protected const PARAMETERS = ['build_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis build id.'], 'query' => ['type' => 'object', 'description' => 'Optional include query.']];
}
