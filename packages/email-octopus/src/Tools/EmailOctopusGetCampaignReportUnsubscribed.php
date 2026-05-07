<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Get the unsubscribed report for an EmailOctopus campaign. */
class EmailOctopusGetCampaignReportUnsubscribed extends AbstractEmailOctopusCampaignReportTool
{
    protected const NAME = 'emailoctopus_get_campaign_report_unsubscribed';
    protected const DESCRIPTION = 'Get the unsubscribed report for an EmailOctopus campaign.';
    protected const REPORT_TYPE = 'unsubscribed';
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.'], 'limit' => ['type' => 'integer', 'description' => 'Records per page, up to 100.'], 'page' => ['type' => 'integer', 'description' => 'Page number to return.']];
}
