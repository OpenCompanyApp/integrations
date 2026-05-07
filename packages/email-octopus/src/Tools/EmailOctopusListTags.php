<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** List tags on an EmailOctopus list. */
class EmailOctopusListTags extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_list_tags';
    protected const DESCRIPTION = 'List tags on an EmailOctopus mailing list.';
    protected const METHOD = 'listTags';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.']];
}
