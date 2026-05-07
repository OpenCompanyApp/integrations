<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Update fields on an existing Close contact.
 */
class CloseUpdateContact extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_update_contact';

    protected string $toolDescription = 'Update an existing Close contact. Send only fields that should change.';

    protected string $method = 'PUT';

    protected string $path = '/contact/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['lead_id', 'name', 'title', 'emails', 'phones', 'urls', 'custom'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close contact ID to update.'],
        'lead_id' => ['type' => 'string', 'description' => 'Move the contact to another Close lead.'],
        'name' => ['type' => 'string', 'description' => 'Updated contact full name.'],
        'title' => ['type' => 'string', 'description' => 'Updated job title.'],
        'emails' => ['type' => 'array', 'description' => 'Replacement email objects.'],
        'phones' => ['type' => 'array', 'description' => 'Replacement phone objects.'],
        'urls' => ['type' => 'array', 'description' => 'Replacement URL objects.'],
        'custom' => ['type' => 'object', 'description' => 'Custom contact fields to set.'],
    ];
}
