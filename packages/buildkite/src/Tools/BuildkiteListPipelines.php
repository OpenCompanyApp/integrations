<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * List pipelines in a Buildkite organization.
 */
class BuildkiteListPipelines extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_list_pipelines';
    protected const DESCRIPTION = 'List Buildkite pipelines in an organization.';
    protected const METHOD = 'listPipelines';
    protected const REQUIRED = ['organization'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
        'query' => ['type' => 'object', 'description' => 'Additional Buildkite query parameters.'],
    ];
}
