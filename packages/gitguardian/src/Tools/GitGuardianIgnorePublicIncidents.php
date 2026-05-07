<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Ignore a public secret incident.
 *
 * Maps to the official GitGuardian endpoint POST /v1/public-incidents/secrets/{incident_id}/ignore.
 */
class GitGuardianIgnorePublicIncidents extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_ignore_public_incidents';
    protected const DESCRIPTION = 'Ignore a public secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/ignore.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/public-incidents/secrets/{incident_id}/ignore';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
