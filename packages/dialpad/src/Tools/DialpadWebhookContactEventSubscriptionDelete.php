<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Contact Event -- Delete.
 *
 * Executes the official Dialpad API operation webhook_contact_event_subscription.delete.
 */
class DialpadWebhookContactEventSubscriptionDelete extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_contact_event_subscription_delete';
}
