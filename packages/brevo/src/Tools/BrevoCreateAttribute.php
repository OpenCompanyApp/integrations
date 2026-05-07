<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create a contact attribute.
 */
class BrevoCreateAttribute extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_attribute';

    protected string $toolDescription = 'Create a contact attribute.';

    protected string $method = 'POST';

    protected string $path = '/contacts/attributes/{attribute_category}/{attribute_name}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'attribute_category' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Attribute category, such as normal or transactional.',
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
