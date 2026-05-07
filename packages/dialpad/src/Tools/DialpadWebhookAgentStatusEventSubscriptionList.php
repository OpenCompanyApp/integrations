<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Agent Status -- List.
 *
 * Executes the official Dialpad API operation webhook_agent_status_event_subscription.list.
 */
class DialpadWebhookAgentStatusEventSubscriptionList extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_agent_status_event_subscription_list';
}
