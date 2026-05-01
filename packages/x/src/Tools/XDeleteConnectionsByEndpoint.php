<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Terminate connections by endpoint
 */
class XDeleteConnectionsByEndpoint extends XGeneratedTool
{
    protected const SLUG = 'x_delete_connections_by_endpoint';

    protected const DESCRIPTION = 'Terminate connections by endpoint';

    protected const PARAMETERS = [
        'endpoint_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The endpoint ID to terminate connections for.',
            'enum' => [
                'filtered_stream',
                'sample_stream',
                'sample10_stream',
                'firehose_stream',
                'tweets_compliance_stream',
                'users_compliance_stream',
                'tweet_label_stream',
                'firehose_stream_lang_en',
                'firehose_stream_lang_ja',
                'firehose_stream_lang_ko',
                'firehose_stream_lang_pt',
                'likes_firehose_stream',
                'likes_sample10_stream',
                'likes_compliance_stream',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteConnectionsByEndpoint',
        'method' => 'DELETE',
        'path' => '/2/connections/{endpoint_id}',
        'parameters' => [
            [
                'name' => 'endpoint_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Connections',
        ],
    ];
}
