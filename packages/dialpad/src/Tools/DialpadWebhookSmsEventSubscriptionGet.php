<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * SMS Event -- Get.
 *
 * Executes the official Dialpad API operation webhook_sms_event_subscription.get.
 */
class DialpadWebhookSmsEventSubscriptionGet extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_sms_event_subscription_get';
}
