<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a payment link.
 *
 * Executes the official Adyen checkout API operation get-paymentLinks-linkId.
 */
class AdyenCheckoutGetPaymentLinksLinkId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_get_payment_links_link_id';
}
