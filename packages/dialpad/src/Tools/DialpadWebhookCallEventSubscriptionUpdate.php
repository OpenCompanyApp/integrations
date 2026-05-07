<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Call Event -- Update.
 *
 * Executes the official Dialpad API operation webhook_call_event_subscription.update.
 */
class DialpadWebhookCallEventSubscriptionUpdate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_call_event_subscription_update';
}
