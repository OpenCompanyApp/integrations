<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Assign a secret incident.
 *
 * Maps to the official GitGuardian endpoint POST /v1/incidents/secrets/{incident_id}/assign.
 */
class GitGuardianAssignIncident extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_assign_incident';
    protected const DESCRIPTION = 'Assign secret incident detected by the GitGuardian dashboard to a workspace member by email.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/assign.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'send_email' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to notify the assignee.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/incidents/secrets/{incident_id}/assign';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'send_email' => 'send_email',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
