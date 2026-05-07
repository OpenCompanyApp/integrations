<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete a custom source.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/sources/custom-sources/{custom_source_id}.
 */
class GitGuardianDeleteCustomSource extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_custom_source';
    protected const DESCRIPTION = 'Delete a custom source. This will also delete the related integration if no other sources exist. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: DELETE /v1/sources/custom-sources/{custom_source_id}.';
    protected const PARAMETERS = [
        'custom_source_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the custom source to delete.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/sources/custom-sources/{custom_source_id}';
    protected const PATH_PARAMS = [
        'custom_source_id' => 'custom_source_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
