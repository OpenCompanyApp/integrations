<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Call a safe relative Travis CI DELETE path.
 */
class TravisCiApiDelete extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_api_delete';
    protected const DESCRIPTION = 'Call a safe relative Travis CI API V3 DELETE path. Prefer named tools when available.';
    protected const METHOD = 'apiDelete';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Travis API path.'], 'query' => ['type' => 'object', 'description' => 'Query parameters.']];
}
