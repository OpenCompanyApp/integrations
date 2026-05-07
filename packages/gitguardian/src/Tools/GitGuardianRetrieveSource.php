<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a source.
 *
 * Maps to the official GitGuardian endpoint GET /v1/sources/{source_id}.
 */
class GitGuardianRetrieveSource extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_source';
    protected const DESCRIPTION = 'Retrieve a source known by GitGuardian.

Official GitGuardian endpoint: GET /v1/sources/{source_id}.';
    protected const PARAMETERS = [
        'source_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the source to retrieve.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/sources/{source_id}';
    protected const PATH_PARAMS = [
        'source_id' => 'source_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
