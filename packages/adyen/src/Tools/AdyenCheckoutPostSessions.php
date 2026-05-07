<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a payment session.
 *
 * Executes the official Adyen checkout API operation post-sessions.
 */
class AdyenCheckoutPostSessions extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_sessions';
}
