<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Get one contact from an EmailOctopus list. */
class EmailOctopusGetContact extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_get_contact';
    protected const DESCRIPTION = 'Get one contact from an EmailOctopus mailing list by member ID or email MD5.';
    protected const METHOD = 'getContact';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'member_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID or MD5 hash of the lowercase email address.']];
}
