<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly contact.
 */
class InsightlyDeleteContact extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_contact';
    protected string $toolDescription = 'Delete an Insightly contact.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Contacts/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly contact ID to delete.'],
    ];
}
