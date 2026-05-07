<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a company-level contact in Front.
 */
class FrontCreateContact extends AbstractFrontTool
{
    protected const NAME = 'front_create_contact';
    protected const DESCRIPTION = 'Create a new company-level Front contact. Multipart avatar uploads are not supported by this JSON helper.';
    protected const METHOD = 'POST';
    protected const PATH = '/contacts';
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'description', 'links', 'group_names', 'list_names', 'custom_fields', 'handles'];
    protected const PARAMETERS = [
        'handles' => ['type' => 'array', 'required' => true, 'description' => 'Handle objects with source and handle fields.'],
        'name' => ['type' => 'string', 'description' => 'Contact name.'],
        'description' => ['type' => 'string', 'description' => 'Contact description.'],
        'links' => ['type' => 'array', 'description' => 'URLs associated with the contact.'],
        'list_names' => ['type' => 'array', 'description' => 'Contact list names. Front creates missing lists automatically.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Contact custom fields keyed by Front custom field name.'],
    ];
}
