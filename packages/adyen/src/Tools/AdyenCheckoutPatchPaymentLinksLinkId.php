<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update the status of a payment link.
 *
 * Executes the official Adyen checkout API operation patch-paymentLinks-linkId.
 */
class AdyenCheckoutPatchPaymentLinksLinkId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_patch_payment_links_link_id';
}
