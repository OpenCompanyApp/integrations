<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Compliance Jobs
 */
class XGetComplianceJobs extends XGeneratedTool
{
    protected const SLUG = 'x_get_compliance_jobs';

    protected const DESCRIPTION = 'Get Compliance Jobs';

    protected const PARAMETERS = [
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Type of Compliance Job to list.',
            'enum' => [
                'tweets',
                'users',
            ],
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Status of Compliance Job to list.',
            'enum' => [
                'created',
                'in_progress',
                'failed',
                'complete',
            ],
        ],
        'compliance_job.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of ComplianceJob fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getComplianceJobs',
        'method' => 'GET',
        'path' => '/2/compliance/jobs',
        'parameters' => [
            [
                'name' => 'type',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'status',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'compliance_job.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
        ],
        'has_body' => false,
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
