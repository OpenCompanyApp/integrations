<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Call Event -- Get.
 *
 * Executes the official Dialpad API operation webhook_call_event_subscription.get.
 */
class DialpadWebhookCallEventSubscriptionGet extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_call_event_subscription_get';
}
