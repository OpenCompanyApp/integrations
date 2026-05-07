<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Fetch a Copper person by email address.
 */
class CopperGetContactByEmail extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_get_contact_by_email';

    protected string $toolDescription = 'Fetch a Copper person by email address.';

    protected string $method = 'POST';

    protected string $path = '/people/fetch_by_email';

    /** @var list<string> */
    protected array $required = ['email'];

    /** @var list<string> */
    protected array $bodyParams = ['email'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address to look up.'],
    ];
}
