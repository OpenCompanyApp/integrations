<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * List Buildkite organizations accessible to the token.
 */
class BuildkiteListOrganizations extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_list_organizations';
    protected const DESCRIPTION = 'List Buildkite organizations accessible to the configured access token.';
    protected const METHOD = 'listOrganizations';
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
        'query' => ['type' => 'object', 'description' => 'Additional Buildkite query parameters.'],
    ];
}
