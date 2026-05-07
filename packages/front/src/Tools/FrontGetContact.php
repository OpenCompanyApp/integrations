<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Fetch a single Front contact by ID or alias.
 */
class FrontGetContact extends AbstractFrontTool
{
    protected const NAME = 'front_get_contact';
    protected const DESCRIPTION = 'Get details of a specific Front contact by ID or alias.';
    protected const METHOD = 'GET';
    protected const PATH = '/contacts/{contact_id}';
    protected const REQUIRED = ['contact_id'];
    protected const ALIASES = ['contact_id' => ['id']];
    protected const PARAMETERS = [
        'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID, such as crd_123abc, or alias such as alt:email:person@example.test.'],
        'id' => ['type' => 'string', 'description' => 'Deprecated alias. Use contact_id.'],
    ];
}
