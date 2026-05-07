<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Update an EmailOctopus mailing list. */
class EmailOctopusUpdateList extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_update_list';
    protected const DESCRIPTION = 'Update an EmailOctopus mailing list name.';
    protected const METHOD = 'updateList';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'The new list name.']];
}
