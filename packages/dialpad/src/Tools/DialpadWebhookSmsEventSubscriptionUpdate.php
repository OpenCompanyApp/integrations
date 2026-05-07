<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * SMS Event -- Update.
 *
 * Executes the official Dialpad API operation webhook_sms_event_subscription.update.
 */
class DialpadWebhookSmsEventSubscriptionUpdate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_sms_event_subscription_update';
}
