<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** List unsubscribed contacts on an EmailOctopus list. */
class EmailOctopusListUnsubscribedContacts extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_list_unsubscribed_contacts';
    protected const DESCRIPTION = 'List unsubscribed contacts on an EmailOctopus mailing list.';
    protected const METHOD = 'listUnsubscribedContacts';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'limit' => ['type' => 'integer', 'description' => 'Records per page, up to 100.'], 'page' => ['type' => 'integer', 'description' => 'Page number to return.']];
}
