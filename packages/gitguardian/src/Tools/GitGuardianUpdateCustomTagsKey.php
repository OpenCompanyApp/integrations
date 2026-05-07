<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update custom tags key.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/custom_tags.
 */
class GitGuardianUpdateCustomTagsKey extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_custom_tags_key';
    protected const DESCRIPTION = 'This endpoint allows you to update a key for all custom tags using it.

Official GitGuardian endpoint: PATCH /v1/custom_tags.';
    protected const PARAMETERS = [
        'old_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'old_key',
        ],
        'new_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'new_key',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/custom_tags';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'old_key' => 'old_key',
        'new_key' => 'new_key',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
