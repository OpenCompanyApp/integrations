<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Recurring Billing Subscription Plans.
 *
 * Executes the official Braintree GraphQL field recurringBillingSubscriptionPlans.
 */
class BraintreeRecurringBillingSubscriptionPlans extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_recurring_billing_subscription_plans';
}
