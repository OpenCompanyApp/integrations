<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete a honeytoken note.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/honeytokens/{honeytoken_id}/notes/{note_id}.
 */
class GitGuardianDeleteHoneytokenNote extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_honeytoken_note';
    protected const DESCRIPTION = 'Delete an existing comment on a honeytoken. Only honeytoken notes created by the current API key can be deleted.

Official GitGuardian endpoint: DELETE /v1/honeytokens/{honeytoken_id}/notes/{note_id}.';
    protected const PARAMETERS = [
        'honeytoken_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the honeytoken to retrieve',
        ],
        'note_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the honeytoken note to update',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/honeytokens/{honeytoken_id}/notes/{note_id}';
    protected const PATH_PARAMS = [
        'honeytoken_id' => 'honeytoken_id',
        'note_id' => 'note_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
