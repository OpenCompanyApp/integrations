<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Delete a Close contact.
 */
class CloseDeleteContact extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_delete_contact';

    protected string $toolDescription = 'Delete a contact from Close. This removes the contact record but not the parent lead.';

    protected string $method = 'DELETE';

    protected string $path = '/contact/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close contact ID to delete.'],
    ];
}
