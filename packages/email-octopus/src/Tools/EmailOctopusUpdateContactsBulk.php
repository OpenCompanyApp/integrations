<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Update multiple contacts on an EmailOctopus list. */
class EmailOctopusUpdateContactsBulk extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_update_contacts_bulk';
    protected const DESCRIPTION = 'Update up to 100 contacts on an EmailOctopus mailing list.';
    protected const METHOD = 'updateContactsBulk';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'data' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Contact update objects, up to 100.']];
}
