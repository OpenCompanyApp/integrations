<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Call a safe relative Travis CI PATCH path.
 */
class TravisCiApiPatch extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_api_patch';
    protected const DESCRIPTION = 'Call a safe relative Travis CI API V3 PATCH path. Prefer named tools when available.';
    protected const METHOD = 'apiPatch';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Travis API path.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.']];
}
