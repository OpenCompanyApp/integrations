<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get personalized Trends
 */
class XGetTrendsPersonalizedTrends extends XGeneratedTool
{
    protected const SLUG = 'x_get_trends_personalized_trends';

    protected const DESCRIPTION = 'Get personalized Trends';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'getTrendsPersonalizedTrends',
        'method' => 'GET',
        'path' => '/2/users/personalized_trends',
        'parameters' => [
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Trends',
        ],
    ];
}
