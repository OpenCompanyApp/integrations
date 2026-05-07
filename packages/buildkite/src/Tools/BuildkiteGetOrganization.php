<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Get one Buildkite organization.
 */
class BuildkiteGetOrganization extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_get_organization';
    protected const DESCRIPTION = 'Get a Buildkite organization by slug.';
    protected const METHOD = 'getOrganization';
    protected const REQUIRED = ['organization'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
    ];
}
