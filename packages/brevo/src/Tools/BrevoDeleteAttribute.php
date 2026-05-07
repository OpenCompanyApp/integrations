<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a contact attribute.
 */
class BrevoDeleteAttribute extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_attribute';

    protected string $toolDescription = 'Delete a contact attribute.';

    protected string $method = 'DELETE';

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
];
}
