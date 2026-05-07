<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Call Event -- Create.
 *
 * Executes the official Dialpad API operation webhook_call_event_subscription.create.
 */
class DialpadWebhookCallEventSubscriptionCreate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_call_event_subscription_create';
}
