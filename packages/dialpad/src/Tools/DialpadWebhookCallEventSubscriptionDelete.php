<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Call Event -- Delete.
 *
 * Executes the official Dialpad API operation webhook_call_event_subscription.delete.
 */
class DialpadWebhookCallEventSubscriptionDelete extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_call_event_subscription_delete';
}
