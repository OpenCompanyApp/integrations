<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Contact Event -- Update.
 *
 * Executes the official Dialpad API operation webhook_contact_event_subscription.update.
 */
class DialpadWebhookContactEventSubscriptionUpdate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_contact_event_subscription_update';
}
