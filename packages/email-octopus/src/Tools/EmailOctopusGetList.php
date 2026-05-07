<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Get one EmailOctopus mailing list. */
class EmailOctopusGetList extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_get_list';
    protected const DESCRIPTION = 'Get details for one EmailOctopus mailing list.';
    protected const METHOD = 'getList';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.']];
}
