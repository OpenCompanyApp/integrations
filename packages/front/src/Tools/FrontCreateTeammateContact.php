<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a private contact for a Front teammate.
 */
class FrontCreateTeammateContact extends AbstractFrontTool
{
    protected const NAME = 'front_create_teammate_contact';
    protected const DESCRIPTION = 'Create a Front contact for a teammate. Multipart avatar uploads are not supported by this JSON helper.';
    protected const METHOD = 'POST';
    protected const PATH = '/teammates/{teammate_id}/contacts';
    protected const REQUIRED = ['teammate_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'description', 'links', 'group_names', 'list_names', 'custom_fields', 'handles'];
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
        'handles' => ['type' => 'array', 'required' => true, 'description' => 'Handle objects with source and handle fields.'],
        'name' => ['type' => 'string', 'description' => 'Contact name.'],
        'description' => ['type' => 'string', 'description' => 'Contact description.'],
        'links' => ['type' => 'array', 'description' => 'URLs associated with the contact.'],
        'list_names' => ['type' => 'array', 'description' => 'Contact list names.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Contact custom fields.'],
    ];
}
