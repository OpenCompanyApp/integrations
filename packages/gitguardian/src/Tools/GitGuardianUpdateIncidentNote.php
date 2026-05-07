<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a secret incident note.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/incidents/secrets/{incident_id}/notes/{note_id}.
 */
class GitGuardianUpdateIncidentNote extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_incident_note';
    protected const DESCRIPTION = 'Update an existing comment on a secret incident. Only incident notes created by the current API key can be updated.

Official GitGuardian endpoint: PATCH /v1/incidents/secrets/{incident_id}/notes/{note_id}.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'note_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident note to update',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/incidents/secrets/{incident_id}/notes/{note_id}';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
        'note_id' => 'note_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
