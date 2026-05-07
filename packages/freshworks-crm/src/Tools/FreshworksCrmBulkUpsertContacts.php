<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Bulk upsert Freshworks CRM contacts.
 */
class FreshworksCrmBulkUpsertContacts extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_bulk_upsert_contacts';
    protected string $toolDescription = 'Bulk upsert Freshworks CRM contacts.';
    protected string $method = 'POST';
    protected string $path = '/api/contacts/bulk_upsert';
    protected array $required = ['contacts'];
    protected array $bodyParams = ['contacts', 'unique_identifier'];
    protected array $parameters = [
        'contacts' => ['type' => 'array', 'required' => true, 'description' => 'Contact payloads.'],
        'unique_identifier' => ['type' => 'string', 'description' => 'Unique identifier field.'],
    ];
}
