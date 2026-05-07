<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create a custom tag.
 *
 * Maps to the official GitGuardian endpoint POST /v1/custom_tags.
 */
class GitGuardianCreateCustomTag extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_custom_tag';
    protected const DESCRIPTION = 'This endpoint allows you to create a custom tag.

Official GitGuardian endpoint: POST /v1/custom_tags.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/custom_tags';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
