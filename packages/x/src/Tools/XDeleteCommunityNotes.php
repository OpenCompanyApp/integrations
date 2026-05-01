<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete a Community Note
 */
class XDeleteCommunityNotes extends XGeneratedTool
{
    protected const SLUG = 'x_delete_community_notes';

    protected const DESCRIPTION = 'Delete a Community Note';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The community note id to delete.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteCommunityNotes',
        'method' => 'DELETE',
        'path' => '/2/notes/{id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => false,
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
