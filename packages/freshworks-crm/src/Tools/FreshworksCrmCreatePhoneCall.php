<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Create a manual Freshworks CRM phone call log.
 */
class FreshworksCrmCreatePhoneCall extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_create_phone_call';
    protected string $toolDescription = 'Create a manual phone call log in Freshworks CRM.';
    protected string $method = 'POST';
    protected string $path = '/api/phone_calls';
    protected string $bodyRoot = 'phone_call';
    protected array $required = ['targetable_id', 'targetable_type'];
    protected array $bodyParams = ['targetable_id', 'targetable_type', 'phone_number', 'direction', 'call_status', 'note', 'owner_id'];
    protected array $parameters = [
        'targetable_id' => ['type' => 'integer', 'required' => true, 'description' => 'Related record ID.'],
        'targetable_type' => ['type' => 'string', 'required' => true, 'description' => 'Related record type.'],
        'phone_number' => ['type' => 'string', 'description' => 'Phone number.'],
        'direction' => ['type' => 'string', 'description' => 'Call direction.'],
        'call_status' => ['type' => 'string', 'description' => 'Call status.'],
        'note' => ['type' => 'string', 'description' => 'Call note.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
    ];
}
