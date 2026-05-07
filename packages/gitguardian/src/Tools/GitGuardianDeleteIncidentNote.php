<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete a secret incident note.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/incidents/secrets/{incident_id}/notes/{note_id}.
 */
class GitGuardianDeleteIncidentNote extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_incident_note';
    protected const DESCRIPTION = 'Delete an existing comment on a secret incident. Only incident notes created by the current API key can be deleted.

Official GitGuardian endpoint: DELETE /v1/incidents/secrets/{incident_id}/notes/{note_id}.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'note_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident note to delete',
        ],
    ];
    protected const METHOD = 'DELETE';
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
