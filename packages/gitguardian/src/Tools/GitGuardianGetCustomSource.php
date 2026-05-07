<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Get a custom source.
 *
 * Maps to the official GitGuardian endpoint GET /v1/sources/custom-sources/{custom_source_id}.
 */
class GitGuardianGetCustomSource extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_get_custom_source';
    protected const DESCRIPTION = 'Get a custom source by ID. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: GET /v1/sources/custom-sources/{custom_source_id}.';
    protected const PARAMETERS = [
        'custom_source_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the custom source to retrieve.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/sources/custom-sources/{custom_source_id}';
    protected const PATH_PARAMS = [
        'custom_source_id' => 'custom_source_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
