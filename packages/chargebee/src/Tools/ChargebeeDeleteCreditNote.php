<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Delete a Chargebee credit note.
 */
class ChargebeeDeleteCreditNote extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/credit_notes/{id}/delete';

    protected string $toolName = 'chargebee_delete_credit_note';

    protected string $toolDescription = 'Delete a Chargebee credit note.';
}
