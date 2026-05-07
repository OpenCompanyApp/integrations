<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Delete a Freshworks CRM note.
 */
class FreshworksCrmDeleteNote extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_delete_note';
    protected string $toolDescription = 'Delete a Freshworks CRM note.';
    protected string $method = 'DELETE';
    protected string $path = '/api/notes/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Note ID to delete.'],
    ];
}
