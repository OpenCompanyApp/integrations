<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Search for Posts Eligible for Community Notes
 */
class XSearchEligiblePosts extends XGeneratedTool
{
    protected const SLUG = 'x_search_eligible_posts';

    protected const DESCRIPTION = 'Search for Posts Eligible for Community Notes';

    protected const PARAMETERS = [
        'test_mode' => [
            'type' => 'boolean',
            'required' => true,
            'description' => 'If true, return a list of posts that are for the test. If false, return a list of posts that the bots can write proposed notes on the product.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination token to get next set of posts eligible for notes.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Max results to return.',
        ],
        'post_selection' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The selection of posts to return. Valid values are \'feed_size: [small|large|xl|xxl], feed_lang: [en|es|...|all]\'. Default (if not specified) is \'feed_size: small, feed_lang: en\'. Only top AI writers have access to large, xl, and xxl size feeds.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'searchEligiblePosts',
        'method' => 'GET',
        'path' => '/2/notes/search/posts_eligible_for_notes',
        'parameters' => [
            [
                'name' => 'test_mode',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'pagination_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'max_results',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'post_selection',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
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
            'tweet.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Community Notes',
        ],
    ];
}
