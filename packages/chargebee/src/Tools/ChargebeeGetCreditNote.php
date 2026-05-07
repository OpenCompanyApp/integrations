<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a Chargebee credit note by ID.
 */
class ChargebeeGetCreditNote extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/credit_notes/{id}';

    protected string $toolName = 'chargebee_get_credit_note';

    protected string $toolDescription = 'Retrieve a Chargebee credit note by ID.';
}
