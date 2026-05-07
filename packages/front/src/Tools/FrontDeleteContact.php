<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Delete a Front contact by ID or alias.
 */
class FrontDeleteContact extends AbstractFrontTool
{
    protected const NAME = 'front_delete_contact';
    protected const DESCRIPTION = 'Delete a Front contact by ID or alias.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/contacts/{contact_id}';
    protected const REQUIRED = ['contact_id'];
    protected const PARAMETERS = [
        'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID or alias.'],
    ];
}
