<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Call Event -- List.
 *
 * Executes the official Dialpad API operation webhook_call_event_subscription.list.
 */
class DialpadWebhookCallEventSubscriptionList extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_call_event_subscription_list';
}
