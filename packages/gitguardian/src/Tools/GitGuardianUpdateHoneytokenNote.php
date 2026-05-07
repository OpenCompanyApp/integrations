<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a honeytoken note.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/honeytokens/{honeytoken_id}/notes/{note_id}.
 */
class GitGuardianUpdateHoneytokenNote extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_honeytoken_note';
    protected const DESCRIPTION = 'Update an existing comment on a honeytoken. Only honeytoken notes created by the current API key can be updated.

Official GitGuardian endpoint: PATCH /v1/honeytokens/{honeytoken_id}/notes/{note_id}.';
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
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
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
