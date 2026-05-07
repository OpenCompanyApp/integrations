<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get the result of a payment session.
 *
 * Executes the official Adyen checkout API operation get-sessions-sessionId.
 */
class AdyenCheckoutGetSessionsSessionId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_get_sessions_session_id';
}
