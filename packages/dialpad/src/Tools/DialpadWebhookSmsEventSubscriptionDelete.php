<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * SMS Event -- Delete.
 *
 * Executes the official Dialpad API operation webhook_sms_event_subscription.delete.
 */
class DialpadWebhookSmsEventSubscriptionDelete extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_sms_event_subscription_delete';
}
