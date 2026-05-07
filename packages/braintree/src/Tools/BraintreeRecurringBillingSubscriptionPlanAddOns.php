<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Recurring Billing Subscription Plan Add Ons.
 *
 * Executes the official Braintree GraphQL field recurringBillingSubscriptionPlanAddOns.
 */
class BraintreeRecurringBillingSubscriptionPlanAddOns extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_recurring_billing_subscription_plan_add_ons';
}
