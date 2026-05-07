<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Fetch a Freshworks CRM note.
 */
class FreshworksCrmGetNote extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_get_note';
    protected string $toolDescription = 'Get a Freshworks CRM note by ID.';
    protected string $path = '/api/notes/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Note ID.'],
    ];
}
