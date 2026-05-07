<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** List contacts on an EmailOctopus list. */
class EmailOctopusListContacts extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_list_contacts';
    protected const DESCRIPTION = 'List contacts on an EmailOctopus mailing list.';
    protected const METHOD = 'listContacts';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'limit' => ['type' => 'integer', 'description' => 'Records per page, up to 100.'], 'page' => ['type' => 'integer', 'description' => 'Page number to return.']];
}
