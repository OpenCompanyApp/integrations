<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of donation campaigns..
 *
 * Executes the official Adyen checkout API operation post-donationCampaigns.
 */
class AdyenCheckoutPostDonationCampaigns extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_donation_campaigns';
}
