<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns metrics for link clicks within a campaign, both in total and in series periods (days, weeks, etc).
 */
class CustomerIOAppCampaignLinkMetrics extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_campaign_link_metrics';
}
