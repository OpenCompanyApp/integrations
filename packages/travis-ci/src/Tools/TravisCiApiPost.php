<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Call a safe relative Travis CI POST path.
 */
class TravisCiApiPost extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_api_post';
    protected const DESCRIPTION = 'Call a safe relative Travis CI API V3 POST path. Prefer named tools when available.';
    protected const METHOD = 'apiPost';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Travis API path.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.']];
}
