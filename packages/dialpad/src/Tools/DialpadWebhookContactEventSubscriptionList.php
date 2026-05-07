<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Contact Event -- List.
 *
 * Executes the official Dialpad API operation webhook_contact_event_subscription.list.
 */
class DialpadWebhookContactEventSubscriptionList extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_webhook_contact_event_subscription_list';
}
