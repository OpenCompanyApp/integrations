<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a source.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/sources/{source_id}.
 */
class GitGuardianUpdateSource extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_source';
    protected const DESCRIPTION = 'Update some source attributes such as monitored status and source criticality. The monitored status can be updated for all source types except Custom Sources. **⚠️ Note**: some sources types are supported on this endpoint, but cannot be updated yet on the dashboard. Business sources can\'t be updated if your account doesn\'t have access to them.

Official GitGuardian endpoint: PATCH /v1/sources/{source_id}.';
    protected const PARAMETERS = [
        'source_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the source to retrieve.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/sources/{source_id}';
    protected const PATH_PARAMS = [
        'source_id' => 'source_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
