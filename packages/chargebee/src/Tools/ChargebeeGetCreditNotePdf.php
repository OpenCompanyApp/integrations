<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve credit note PDF metadata and download URL.
 */
class ChargebeeGetCreditNotePdf extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = ['limit', 'offset'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/credit_notes/{id}/pdf';

    protected string $toolName = 'chargebee_get_credit_note_pdf';

    protected string $toolDescription = 'Retrieve credit note PDF metadata and download URL.';
}
