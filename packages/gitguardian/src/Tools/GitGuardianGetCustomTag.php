<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a custom tag.
 *
 * Maps to the official GitGuardian endpoint GET /v1/custom_tags/{custom_tag_id}.
 */
class GitGuardianGetCustomTag extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_get_custom_tag';
    protected const DESCRIPTION = 'This endpoint allows you to retrieve an existing custom tag.

Official GitGuardian endpoint: GET /v1/custom_tags/{custom_tag_id}.';
    protected const PARAMETERS = [
        'custom_tag_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the custom tag',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/custom_tags/{custom_tag_id}';
    protected const PATH_PARAMS = [
        'custom_tag_id' => 'custom_tag_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
