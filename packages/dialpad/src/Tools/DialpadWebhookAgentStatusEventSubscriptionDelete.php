<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Agent Status -- Delete.
 *
 * Executes the official Dialpad API operation webhook_agent_status_event_subscription.delete.
 */
class DialpadWebhookAgentStatusEventSubscriptionDelete extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_agent_status_event_subscription_delete';
}
