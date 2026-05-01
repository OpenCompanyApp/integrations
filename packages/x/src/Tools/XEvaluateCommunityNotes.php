<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Evaluate a Community Note
 */
class XEvaluateCommunityNotes extends XGeneratedTool
{
    protected const SLUG = 'x_evaluate_community_notes';

    protected const DESCRIPTION = 'Evaluate a Community Note';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'evaluateCommunityNotes',
        'method' => 'POST',
        'path' => '/2/evaluate_note',
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
