<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Partial update of a Custom Tag.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/custom_tags/{custom_tag_id}.
 */
class GitGuardianPartialUpdateCustomTag extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_partial_update_custom_tag';
    protected const DESCRIPTION = 'This endpoint allows you to partially update a specific custom tag. It updates only the specified fields (key or value), leaving the other fields unchanged. This does not impact other custom tags sharing the same key.

Official GitGuardian endpoint: PATCH /v1/custom_tags/{custom_tag_id}.';
    protected const PARAMETERS = [
        'custom_tag_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the custom tag',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/custom_tags/{custom_tag_id}';
    protected const PATH_PARAMS = [
        'custom_tag_id' => 'custom_tag_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
