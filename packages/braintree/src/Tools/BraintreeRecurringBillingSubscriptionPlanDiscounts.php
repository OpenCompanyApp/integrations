<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Recurring Billing Subscription Plan Discounts.
 *
 * Executes the official Braintree GraphQL field recurringBillingSubscriptionPlanDiscounts.
 */
class BraintreeRecurringBillingSubscriptionPlanDiscounts extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_recurring_billing_subscription_plan_discounts';
}
