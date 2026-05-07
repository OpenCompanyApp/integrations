<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Batch upsert custom object records.
 */
class BrevoBatchUpsertCustomObjectRecords extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_batch_upsert_custom_object_records';

    protected string $toolDescription = 'Batch upsert custom object records.';

    protected string $method = 'POST';

    protected string $path = '/objects/{object_type}/batch/upsert';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'object_type' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Custom object type.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'object_type',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
