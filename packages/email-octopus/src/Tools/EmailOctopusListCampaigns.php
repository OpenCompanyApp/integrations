<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** List EmailOctopus campaigns. */
class EmailOctopusListCampaigns extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_list_campaigns';
    protected const DESCRIPTION = 'List EmailOctopus campaigns with pagination.';
    protected const METHOD = 'listCampaigns';
    protected const PARAMETERS = ['limit' => ['type' => 'integer', 'description' => 'Records per page, up to 100.'], 'page' => ['type' => 'integer', 'description' => 'Page number to return.']];
}
