<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Call a safe relative Travis CI GET path.
 */
class TravisCiApiGet extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_api_get';
    protected const DESCRIPTION = 'Call a safe relative Travis CI API V3 GET path. Prefer named tools when available.';
    protected const METHOD = 'apiGet';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Travis API path.'], 'query' => ['type' => 'object', 'description' => 'Query parameters.']];
}
