<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Agent Status -- Update.
 *
 * Executes the official Dialpad API operation webhook_agent_status_event_subscription.update.
 */
class DialpadWebhookAgentStatusEventSubscriptionUpdate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_agent_status_event_subscription_update';
}
