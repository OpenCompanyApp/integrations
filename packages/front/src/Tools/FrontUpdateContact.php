<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Update a Front contact by ID or alias.
 */
class FrontUpdateContact extends AbstractFrontTool
{
    protected const NAME = 'front_update_contact';
    protected const DESCRIPTION = 'Update a Front contact. Use front_add_contact_handle to add handles to an existing contact.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/contacts/{contact_id}';
    protected const REQUIRED = ['contact_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'description', 'links', 'group_names', 'list_names', 'custom_fields'];
    protected const PARAMETERS = [
        'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID or alias.'],
        'name' => ['type' => 'string', 'description' => 'Contact name.'],
        'description' => ['type' => 'string', 'description' => 'Contact description.'],
        'links' => ['type' => 'array', 'description' => 'URLs associated with the contact.'],
        'list_names' => ['type' => 'array', 'description' => 'Contact list names.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Contact custom fields.'],
        'body' => ['type' => 'object', 'description' => 'Optional raw JSON payload.'],
    ];
}
