<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Recurring Billing Subscription Plan.
 *
 * Executes the official Braintree GraphQL field updateRecurringBillingSubscriptionPlan.
 */
class BraintreeUpdateRecurringBillingSubscriptionPlan extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_recurring_billing_subscription_plan';
}
