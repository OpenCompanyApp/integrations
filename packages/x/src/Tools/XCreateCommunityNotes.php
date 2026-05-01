<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create a Community Note
 */
class XCreateCommunityNotes extends XGeneratedTool
{
    protected const SLUG = 'x_create_community_notes';

    protected const DESCRIPTION = 'Create a Community Note';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createCommunityNotes',
        'method' => 'POST',
        'path' => '/2/notes',
        'parameters' => [
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'tweet.write',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Community Notes',
        ],
    ];
}
