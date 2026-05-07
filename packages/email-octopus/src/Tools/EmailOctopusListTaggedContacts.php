<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** List contacts on an EmailOctopus list by tag. */
class EmailOctopusListTaggedContacts extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_list_tagged_contacts';
    protected const DESCRIPTION = 'List contacts on an EmailOctopus mailing list by tag.';
    protected const METHOD = 'listTaggedContacts';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'Tag name.'], 'limit' => ['type' => 'integer', 'description' => 'Records per page, up to 100.'], 'page' => ['type' => 'integer', 'description' => 'Page number to return.']];
}
