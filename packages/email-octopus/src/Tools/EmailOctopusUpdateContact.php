<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Update one contact on an EmailOctopus list. */
class EmailOctopusUpdateContact extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_update_contact';
    protected const DESCRIPTION = 'Update one contact on an EmailOctopus mailing list.';
    protected const METHOD = 'updateContact';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'member_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID or MD5 hash of the lowercase email address.'], 'email_address' => ['type' => 'string', 'description' => 'New email address.'], 'fields' => ['type' => 'object', 'description' => 'Field values keyed by field tag.'], 'tags' => ['type' => 'object', 'description' => 'Tag names mapped to true to add or false to remove.'], 'status' => ['type' => 'string', 'enum' => ['SUBSCRIBED', 'UNSUBSCRIBED', 'PENDING'], 'description' => 'New contact status.']];
}
