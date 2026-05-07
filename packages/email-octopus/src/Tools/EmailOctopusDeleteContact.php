<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Delete one contact from an EmailOctopus list. */
class EmailOctopusDeleteContact extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_delete_contact';
    protected const DESCRIPTION = 'Delete one contact from an EmailOctopus mailing list.';
    protected const METHOD = 'deleteContact';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'member_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID or MD5 hash of the lowercase email address.']];
}
