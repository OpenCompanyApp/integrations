<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** List EmailOctopus mailing lists. */
class EmailOctopusListLists extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_list_lists';
    protected const DESCRIPTION = 'List EmailOctopus mailing lists with pagination.';
    protected const METHOD = 'listLists';
    protected const PARAMETERS = ['limit' => ['type' => 'integer', 'description' => 'Records per page, up to 100.'], 'page' => ['type' => 'integer', 'description' => 'Page number to return.']];
}
