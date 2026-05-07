<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Deletion of a custom tag.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/custom_tags/{custom_tag_id}.
 */
class GitGuardianDeleteCustomTag extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_custom_tag';
    protected const DESCRIPTION = 'This endpoint allows you to delete a specific custom tag. This does not impact other custom tags sharing the same key.

Official GitGuardian endpoint: DELETE /v1/custom_tags/{custom_tag_id}.';
    protected const PARAMETERS = [
        'custom_tag_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the custom tag',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/custom_tags/{custom_tag_id}';
    protected const PATH_PARAMS = [
        'custom_tag_id' => 'custom_tag_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
