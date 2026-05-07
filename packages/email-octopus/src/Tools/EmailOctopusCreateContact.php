<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Create one contact on an EmailOctopus list. */
class EmailOctopusCreateContact extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_create_contact';
    protected const DESCRIPTION = 'Create a contact on an EmailOctopus mailing list.';
    protected const METHOD = 'createContact';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'email_address' => ['type' => 'string', 'required' => true, 'description' => 'Contact email address.'], 'fields' => ['type' => 'object', 'description' => 'Field values keyed by field tag.'], 'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Tags to add.'], 'status' => ['type' => 'string', 'enum' => ['SUBSCRIBED', 'UNSUBSCRIBED', 'PENDING'], 'description' => 'Initial contact status.']];
}
