<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Compliance Job by ID
 */
class XGetComplianceJobsById extends XGeneratedTool
{
    protected const SLUG = 'x_get_compliance_jobs_by_id';

    protected const DESCRIPTION = 'Get Compliance Job by ID';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Compliance Job to retrieve.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getComplianceJobsById',
        'method' => 'GET',
        'path' => '/2/compliance/jobs/{id}',
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
