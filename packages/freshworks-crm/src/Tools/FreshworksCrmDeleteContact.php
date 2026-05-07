<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Delete a Freshworks CRM contact.
 */
class FreshworksCrmDeleteContact extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_delete_contact';
    protected string $toolDescription = 'Delete a Freshworks CRM contact.';
    protected string $method = 'DELETE';
    protected string $path = '/api/contacts/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Contact ID to delete.'],
    ];
}
