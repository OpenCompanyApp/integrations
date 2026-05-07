<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Update a Freshworks CRM note.
 */
class FreshworksCrmUpdateNote extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_update_note';
    protected string $toolDescription = 'Update a Freshworks CRM note.';
    protected string $method = 'PUT';
    protected string $path = '/api/notes/{id}';
    protected string $bodyRoot = 'note';
    protected array $required = ['id'];
    protected array $bodyParams = ['description'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Note ID.'],
        'description' => ['type' => 'string', 'description' => 'Updated note body.'],
    ];
}
