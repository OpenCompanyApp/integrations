<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * List Travis CI repository settings.
 */
class TravisCiListSettings extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_list_settings';
    protected const DESCRIPTION = 'List Travis CI settings for a repository.';
    protected const METHOD = 'listSettings';
    protected const REQUIRED = ['repository'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'], 'query' => ['type' => 'object', 'description' => 'Optional include query.']];
}
