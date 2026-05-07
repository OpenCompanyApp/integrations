<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Get the summary report for an EmailOctopus campaign. */
class EmailOctopusGetCampaignReportSummary extends AbstractEmailOctopusCampaignReportTool
{
    protected const NAME = 'emailoctopus_get_campaign_report_summary';
    protected const DESCRIPTION = 'Get the summary report for an EmailOctopus campaign.';
    protected const REPORT_TYPE = 'summary';
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.']];
}
