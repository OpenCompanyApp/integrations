<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Fetch a single Close contact by ID.
 */
class CloseGetContact extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_get_contact';

    protected string $toolDescription = 'Fetch a single Close contact by ID, including emails, phones, lead association, and custom fields.';

    protected string $path = '/contact/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close contact ID, for example cont_abc123.'],
    ];
}
