<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Create a Freshworks CRM note.
 */
class FreshworksCrmCreateNote extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_create_note';
    protected string $toolDescription = 'Create a note on a Freshworks CRM record.';
    protected string $method = 'POST';
    protected string $path = '/api/notes';
    protected string $bodyRoot = 'note';
    protected array $required = ['description', 'targetable_id', 'targetable_type'];
    protected array $bodyParams = ['description', 'targetable_id', 'targetable_type', 'owner_id'];
    protected array $parameters = [
        'description' => ['type' => 'string', 'required' => true, 'description' => 'Note body.'],
        'targetable_id' => ['type' => 'integer', 'required' => true, 'description' => 'Related record ID.'],
        'targetable_type' => ['type' => 'string', 'required' => true, 'description' => 'Related record type such as Contact, Deal, or SalesAccount.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
    ];
}
