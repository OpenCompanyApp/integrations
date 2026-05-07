<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a custom source.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/sources/custom-sources/{custom_source_id}.
 */
class GitGuardianUpdateCustomSource extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_custom_source';
    protected const DESCRIPTION = 'Update a custom source\'s name and description. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: PATCH /v1/sources/custom-sources/{custom_source_id}.';
    protected const PARAMETERS = [
        'custom_source_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the custom source to update.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/sources/custom-sources/{custom_source_id}';
    protected const PATH_PARAMS = [
        'custom_source_id' => 'custom_source_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
