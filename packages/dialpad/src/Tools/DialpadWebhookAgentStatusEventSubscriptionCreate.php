<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Agent Status -- Create.
 *
 * Executes the official Dialpad API operation webhook_agent_status_event_subscription.create.
 */
class DialpadWebhookAgentStatusEventSubscriptionCreate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_agent_status_event_subscription_create';
}
