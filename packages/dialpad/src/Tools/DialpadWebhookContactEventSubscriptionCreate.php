<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Contact Event -- Create.
 *
 * Executes the official Dialpad API operation webhook_contact_event_subscription.create.
 */
class DialpadWebhookContactEventSubscriptionCreate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_contact_event_subscription_create';
}
