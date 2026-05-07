<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Get the links report for an EmailOctopus campaign. */
class EmailOctopusGetCampaignReportLinks extends AbstractEmailOctopusCampaignReportTool
{
    protected const NAME = 'emailoctopus_get_campaign_report_links';
    protected const DESCRIPTION = 'Get the links report for an EmailOctopus campaign.';
    protected const REPORT_TYPE = 'links';
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.']];
}
