<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update a contact attribute.
 */
class BrevoUpdateAttribute extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_attribute';

    protected string $toolDescription = 'Update a contact attribute.';

    protected string $method = 'PUT';

    protected string $path = '/contacts/attributes/{attribute_category}/{attribute_name}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'attribute_category' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Attribute category.',
    ],
    'attribute_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Attribute name.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'attribute_category',
    'attribute_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
