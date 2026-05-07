<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get the brands and other details of a card.
 *
 * Executes the official Adyen checkout API operation post-cardDetails.
 */
class AdyenCheckoutPostCardDetails extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_card_details';
}
