<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * List builds for a Buildkite pipeline.
 */
class BuildkiteListBuilds extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_list_builds';
    protected const DESCRIPTION = 'List Buildkite builds for a pipeline with optional branch, commit, state, and pagination filters.';
    protected const METHOD = 'listBuilds';
    protected const REQUIRED = ['organization', 'pipeline'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'branch' => ['type' => 'string', 'description' => 'Filter by branch.'],
        'commit' => ['type' => 'string', 'description' => 'Filter by commit SHA.'],
        'state' => ['type' => 'string', 'description' => 'Filter by build state.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
        'query' => ['type' => 'object', 'description' => 'Additional Buildkite query parameters.'],
    ];
}
