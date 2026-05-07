<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List invitations having access to a Secret Incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/incidents/secrets/{incident_id}/invitations.
 */
class GitGuardianListIncidentInvitations extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_incident_invitations';
    protected const DESCRIPTION = 'List all the invitations having access to a Secret Incident. DEPRECATED: This endpoint has been replaced by [/v1/secret-incidents/{incident_id}/invitations](#tag/Secret-Incidents/operation/list-secret-incident-invitation-access)

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/invitations.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination cursor.',
        ],
        'invitation_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'invitation_id',
        ],
        'incident_permission' => [
            'type' => 'string',
            'required' => false,
            'description' => 'filter accesses with a specific permission.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/incidents/secrets/{incident_id}/invitations';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'invitation_id' => 'invitation_id',
        'incident_permission' => 'incident_permission',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
