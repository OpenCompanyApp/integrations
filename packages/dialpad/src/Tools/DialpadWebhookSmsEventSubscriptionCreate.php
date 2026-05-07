<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * SMS Event -- Create.
 *
 * Executes the official Dialpad API operation webhook_sms_event_subscription.create.
 */
class DialpadWebhookSmsEventSubscriptionCreate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_sms_event_subscription_create';
}
