<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Search for Community Notes Written
 */
class XSearchCommunityNotesWritten extends XGeneratedTool
{
    protected const SLUG = 'x_search_community_notes_written';

    protected const DESCRIPTION = 'Search for Community Notes Written';

    protected const PARAMETERS = [
        'test_mode' => [
            'type' => 'boolean',
            'required' => true,
            'description' => 'If true, return the notes the caller wrote for the test. If false, return the notes the caller wrote on the product.',
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
        'note.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Note fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'searchCommunityNotesWritten',
        'method' => 'GET',
        'path' => '/2/notes/search/notes_written',
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
                'name' => 'note.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
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
