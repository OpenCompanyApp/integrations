<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Revoke access to a secret incident.
 *
 * Maps to the official GitGuardian endpoint POST /v1/incidents/secrets/{incident_id}/revoke_access.
 */
class GitGuardianRevokeAccessIncident extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_revoke_access_incident';
    protected const DESCRIPTION = 'Revoke access to a secret incident

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/revoke_access.';
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
    protected const PATH = '/v1/incidents/secrets/{incident_id}/revoke_access';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
