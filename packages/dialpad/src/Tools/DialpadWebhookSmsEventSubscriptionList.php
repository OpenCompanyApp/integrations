<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * SMS Event -- List.
 *
 * Executes the official Dialpad API operation webhook_sms_event_subscription.list.
 */
class DialpadWebhookSmsEventSubscriptionList extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_sms_event_subscription_list';
}
