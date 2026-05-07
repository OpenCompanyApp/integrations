<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Grant access to a secret incident.
 *
 * Maps to the official GitGuardian endpoint POST /v1/incidents/secrets/{incident_id}/grant_access.
 */
class GitGuardianGrantAccessIncident extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_grant_access_incident';
    protected const DESCRIPTION = 'Grant a user, an existing invitee or a team access to a secret incident. DEPRECATED: This endpoint has been replaced by [this one](#tag/Members/operation/set-member-resource-access) for members, [this one](#tag/Teams/operation/set-team-resource-access) for teams, and [this one](#tag/Invitations/operation/set-invitation-resource-access) for invitations.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/grant_access.';
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
    protected const PATH = '/v1/incidents/secrets/{incident_id}/grant_access';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
