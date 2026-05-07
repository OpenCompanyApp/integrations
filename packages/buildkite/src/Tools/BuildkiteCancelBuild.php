<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Cancel a Buildkite build.
 */
class BuildkiteCancelBuild extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_cancel_build';
    protected const DESCRIPTION = 'Cancel a Buildkite build by build number.';
    protected const METHOD = 'cancelBuild';
    protected const REQUIRED = ['organization', 'pipeline', 'number'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'number' => ['type' => 'integer', 'required' => true, 'description' => 'Build number, not build UUID.'],
    ];
}
