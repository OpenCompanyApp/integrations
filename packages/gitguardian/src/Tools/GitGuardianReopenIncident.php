<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Reopen a secret incident.
 *
 * Maps to the official GitGuardian endpoint POST /v1/incidents/secrets/{incident_id}/reopen.
 */
class GitGuardianReopenIncident extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_reopen_incident';
    protected const DESCRIPTION = 'Unresolve or unignore a secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/reopen.';
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
    protected const PATH = '/v1/incidents/secrets/{incident_id}/reopen';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
