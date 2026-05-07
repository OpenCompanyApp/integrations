<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get an Apple Pay session.
 *
 * Executes the official Adyen checkout API operation post-applePay-sessions.
 */
class AdyenCheckoutPostApplePaySessions extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_apple_pay_sessions';
}
