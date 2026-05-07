<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Get the not-opened report for an EmailOctopus campaign. */
class EmailOctopusGetCampaignReportNotOpened extends AbstractEmailOctopusCampaignReportTool
{
    protected const NAME = 'emailoctopus_get_campaign_report_not_opened';
    protected const DESCRIPTION = 'Get the not-opened report for an EmailOctopus campaign.';
    protected const REPORT_TYPE = 'not-opened';
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.'], 'limit' => ['type' => 'integer', 'description' => 'Records per page, up to 100.'], 'page' => ['type' => 'integer', 'description' => 'Page number to return.']];
}
