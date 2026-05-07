<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Change Log -- List.
 *
 * Executes the official Dialpad API operation webhook_change_log_event_subscription.list.
 */
class DialpadWebhookChangeLogEventSubscriptionList extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_change_log_event_subscription_list';
}
