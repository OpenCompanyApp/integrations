<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Delete an EmailOctopus mailing list. */
class EmailOctopusDeleteList extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_delete_list';
    protected const DESCRIPTION = 'Delete an EmailOctopus mailing list.';
    protected const METHOD = 'deleteList';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.']];
}
