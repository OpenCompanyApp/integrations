<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a Chargebee hosted page by ID.
 */
class ChargebeeGetHostedPage extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/hosted_pages/{id}';

    protected string $toolName = 'chargebee_get_hosted_page';

    protected string $toolDescription = 'Retrieve a Chargebee hosted page by ID.';
}
