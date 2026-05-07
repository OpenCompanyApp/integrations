<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Add a handle to an existing Front contact.
 */
class FrontAddContactHandle extends AbstractFrontTool
{
    protected const NAME = 'front_add_contact_handle';
    protected const DESCRIPTION = 'Add a new email, phone, or social handle to an existing Front contact.';
    protected const METHOD = 'POST';
    protected const PATH = '/contacts/{contact_id}/handles';
    protected const REQUIRED = ['contact_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['handle', 'source'];
    protected const PARAMETERS = [
        'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID or alias.'],
        'handle' => ['type' => 'string', 'required' => true, 'description' => 'Handle value, such as person@example.test.'],
        'source' => ['type' => 'string', 'required' => true, 'description' => 'Handle source, such as email, phone, twitter, or custom.'],
    ];
}
