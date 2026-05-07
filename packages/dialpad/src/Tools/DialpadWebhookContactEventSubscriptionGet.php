<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Contact Event -- Get.
 *
 * Executes the official Dialpad API operation webhook_contact_event_subscription.get.
 */
class DialpadWebhookContactEventSubscriptionGet extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_contact_event_subscription_get';
}
