<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a secret incident.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/incidents/secrets/{incident_id}.
 */
class GitGuardianUpdateSecretIncident extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_secret_incident';
    protected const DESCRIPTION = 'Update a secret incident.

Official GitGuardian endpoint: PATCH /v1/incidents/secrets/{incident_id}.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/incidents/secrets/{incident_id}';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
