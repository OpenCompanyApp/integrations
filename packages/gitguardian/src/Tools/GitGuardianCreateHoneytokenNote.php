<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create an honeytoken note.
 *
 * Maps to the official GitGuardian endpoint POST /v1/honeytokens/{honeytoken_id}/notes.
 */
class GitGuardianCreateHoneytokenNote extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_honeytoken_note';
    protected const DESCRIPTION = 'Add a note on a honeytoken.

Official GitGuardian endpoint: POST /v1/honeytokens/{honeytoken_id}/notes.';
    protected const PARAMETERS = [
        'honeytoken_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the honeytoken to retrieve',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/honeytokens/{honeytoken_id}/notes';
    protected const PATH_PARAMS = [
        'honeytoken_id' => 'honeytoken_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
