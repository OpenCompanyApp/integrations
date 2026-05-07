<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Make a donation.
 *
 * Executes the official Adyen checkout API operation post-donations.
 */
class AdyenCheckoutPostDonations extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_donations';
}
