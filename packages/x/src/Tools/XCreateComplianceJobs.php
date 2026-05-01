<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create Compliance Job
 */
class XCreateComplianceJobs extends XGeneratedTool
{
    protected const SLUG = 'x_create_compliance_jobs';

    protected const DESCRIPTION = 'Create Compliance Job';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'name' => [
                    'type' => 'string',
                    'description' => 'User-provided name for a compliance job.',
                    'required' => false,
                ],
                'resumable' => [
                    'type' => 'boolean',
                    'description' => 'If true, this endpoint will return a pre-signed URL with resumable uploads enabled.',
                    'required' => false,
                ],
                'type' => [
                    'type' => 'string',
                    'description' => 'Type of compliance job to list.',
                    'enum' => [
                        'tweets',
                        'users',
                    ],
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'createComplianceJobs',
        'method' => 'POST',
        'path' => '/2/compliance/jobs',
        'parameters' => [
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'async_job',
        'tags' => [
            'Compliance',
        ],
    ];
}
