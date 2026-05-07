<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Trigger a Travis CI build request.
 */
class TravisCiCreateRequest extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_create_request';
    protected const DESCRIPTION = 'Trigger a Travis CI build request for a repository using the official request payload.';
    protected const METHOD = 'createRequest';
    protected const REQUIRED = ['repository', 'payload'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Travis request payload.']];
}
