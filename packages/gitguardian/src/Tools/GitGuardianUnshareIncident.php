<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Unshare a secret incident.
 *
 * Maps to the official GitGuardian endpoint POST /v1/incidents/secrets/{incident_id}/unshare.
 */
class GitGuardianUnshareIncident extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_unshare_incident';
    protected const DESCRIPTION = 'Unshare a secret incident by revoking its public link.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/unshare.';
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
    protected const PATH = '/v1/incidents/secrets/{incident_id}/unshare';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
