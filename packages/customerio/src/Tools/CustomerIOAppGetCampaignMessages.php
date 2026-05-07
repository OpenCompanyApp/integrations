<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns information about the deliveries (instances of messages sent to individual people) sent from a campaign.
 */
class CustomerIOAppGetCampaignMessages extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_campaign_messages';
}
