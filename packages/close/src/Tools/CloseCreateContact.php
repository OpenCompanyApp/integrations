<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Create a contact on an existing Close lead.
 */
class CloseCreateContact extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_create_contact';

    protected string $toolDescription = 'Create a Close contact on an existing lead with name, title, emails, phones, URLs, and custom fields.';

    protected string $method = 'POST';

    protected string $path = '/contact/';

    /** @var list<string> */
    protected array $required = ['lead_id', 'name'];

    /** @var list<string> */
    protected array $bodyParams = ['lead_id', 'name', 'title', 'emails', 'phones', 'urls', 'custom'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Close lead ID to attach the contact to.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Contact full name.'],
        'title' => ['type' => 'string', 'description' => 'Contact job title.'],
        'emails' => ['type' => 'array', 'description' => 'Email objects, for example [{"email":"person@example.test","type":"office"}].'],
        'phones' => ['type' => 'array', 'description' => 'Phone objects, for example [{"phone":"+15550101010","type":"office"}].'],
        'urls' => ['type' => 'array', 'description' => 'URL objects associated with this contact.'],
        'custom' => ['type' => 'object', 'description' => 'Custom contact fields keyed by Close custom field name or ID.'],
    ];
}
