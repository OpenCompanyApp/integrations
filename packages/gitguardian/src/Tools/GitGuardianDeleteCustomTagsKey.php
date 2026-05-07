<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete a custom tags key.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/custom_tags.
 */
class GitGuardianDeleteCustomTagsKey extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_custom_tags_key';
    protected const DESCRIPTION = 'This endpoint allows you to delete all custom tags using the given key.

Official GitGuardian endpoint: DELETE /v1/custom_tags.';
    protected const PARAMETERS = [
        'key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'key',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/custom_tags';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'key' => 'key',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
