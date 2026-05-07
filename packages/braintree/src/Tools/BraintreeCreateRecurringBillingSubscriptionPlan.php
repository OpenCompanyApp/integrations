<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Recurring Billing Subscription Plan.
 *
 * Executes the official Braintree GraphQL field createRecurringBillingSubscriptionPlan.
 */
class BraintreeCreateRecurringBillingSubscriptionPlan extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_recurring_billing_subscription_plan';
}
