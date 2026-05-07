<?php

namespace OpenCompany\Integrations\Braintree;

/**
 * Official Braintree GraphQL operation metadata.
 *
 * Source: https://github.com/braintree/graphql-api/blob/master/schema.graphql.
 */
class BraintreeOperations
{
    /**
     * Return all supported Braintree GraphQL operation fields.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
  0 =>
  [
    'operation' => 'report_paymentLevelFees',
    'slug' => 'braintree_report_payment_level_fees',
    'class' => 'BraintreeReportPaymentLevelFees',
    'scope' => 'report',
    'graphql_kind' => 'query',
    'field' => 'paymentLevelFees',
    'return_type' => 'PaymentLevelFeeReport',
    'return_graphql_type' => 'PaymentLevelFeeReport',
    'returns_scalar' => false,
    'name' => 'Report Payment Level Fees',
    'description' => 'Execute official Braintree GraphQL query field `paymentLevelFees` under `report`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'date',
        'param' => 'date',
        'graphql_type' => 'Date!',
        'type' => 'string',
        'required' => true,
        'description' => 'GraphQL variable `date` of type Date!.',
      ],
      1 =>
      [
        'name' => 'merchantAccountId',
        'param' => 'merchant_account_id',
        'graphql_type' => 'ID',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `merchantAccountId` of type ID.',
      ],
    ],
  ],
  1 =>
  [
    'operation' => 'report_transactionLevelFees',
    'slug' => 'braintree_report_transaction_level_fees',
    'class' => 'BraintreeReportTransactionLevelFees',
    'scope' => 'report',
    'graphql_kind' => 'query',
    'field' => 'transactionLevelFees',
    'return_type' => 'TransactionLevelFeeReport',
    'return_graphql_type' => 'TransactionLevelFeeReport',
    'returns_scalar' => false,
    'name' => 'Report Transaction Level Fees',
    'description' => 'Execute official Braintree GraphQL query field `transactionLevelFees` under `report`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'date',
        'param' => 'date',
        'graphql_type' => 'Date!',
        'type' => 'string',
        'required' => true,
        'description' => 'GraphQL variable `date` of type Date!.',
      ],
      1 =>
      [
        'name' => 'merchantAccountId',
        'param' => 'merchant_account_id',
        'graphql_type' => 'ID',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `merchantAccountId` of type ID.',
      ],
    ],
  ],
  2 =>
  [
    'operation' => 'applePayRegisteredDomains',
    'slug' => 'braintree_apple_pay_registered_domains',
    'class' => 'BraintreeApplePayRegisteredDomains',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'applePayRegisteredDomains',
    'return_type' => 'ApplePayRegisteredDomainsPayload',
    'return_graphql_type' => 'ApplePayRegisteredDomainsPayload',
    'returns_scalar' => false,
    'name' => 'Apple Pay Registered Domains',
    'description' => 'Execute official Braintree GraphQL query field `applePayRegisteredDomains`.',
    'type' => 'read',
    'parameters' =>
    [
    ],
  ],
  3 =>
  [
    'operation' => 'clientConfiguration',
    'slug' => 'braintree_client_configuration',
    'class' => 'BraintreeClientConfiguration',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'clientConfiguration',
    'return_type' => 'ClientConfiguration',
    'return_graphql_type' => 'ClientConfiguration',
    'returns_scalar' => false,
    'name' => 'Client Configuration',
    'description' => 'Execute official Braintree GraphQL query field `clientConfiguration`.',
    'type' => 'read',
    'parameters' =>
    [
    ],
  ],
  4 =>
  [
    'operation' => 'idFromLegacyId',
    'slug' => 'braintree_id_from_legacy_id',
    'class' => 'BraintreeIdFromLegacyId',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'idFromLegacyId',
    'return_type' => 'ID',
    'return_graphql_type' => 'ID!',
    'returns_scalar' => true,
    'name' => 'Id From Legacy Id',
    'description' => 'Execute official Braintree GraphQL query field `idFromLegacyId`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'legacyId',
        'param' => 'legacy_id',
        'graphql_type' => 'ID!',
        'type' => 'string',
        'required' => true,
        'description' => 'GraphQL variable `legacyId` of type ID!.',
      ],
      1 =>
      [
        'name' => 'type',
        'param' => 'type',
        'graphql_type' => 'LegacyIdType!',
        'type' => 'string',
        'required' => true,
        'description' => 'GraphQL variable `type` of type LegacyIdType!.',
      ],
    ],
  ],
  5 =>
  [
    'operation' => 'idsFromLegacyIds',
    'slug' => 'braintree_ids_from_legacy_ids',
    'class' => 'BraintreeIdsFromLegacyIds',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'idsFromLegacyIds',
    'return_type' => 'ID',
    'return_graphql_type' => '[ID]!',
    'returns_scalar' => true,
    'name' => 'Ids From Legacy Ids',
    'description' => 'Execute official Braintree GraphQL query field `idsFromLegacyIds`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'IdsFromLegacyIdsInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type IdsFromLegacyIdsInput!.',
      ],
    ],
  ],
  6 =>
  [
    'operation' => 'inStoreLocations',
    'slug' => 'braintree_in_store_locations',
    'class' => 'BraintreeInStoreLocations',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'inStoreLocations',
    'return_type' => 'InStoreLocationConnection',
    'return_graphql_type' => 'InStoreLocationConnection',
    'returns_scalar' => false,
    'name' => 'In Store Locations',
    'description' => 'Execute official Braintree GraphQL query field `inStoreLocations`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      1 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  7 =>
  [
    'operation' => 'node',
    'slug' => 'braintree_node',
    'class' => 'BraintreeNode',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'node',
    'return_type' => 'Node',
    'return_graphql_type' => 'Node',
    'returns_scalar' => false,
    'name' => 'Node',
    'description' => 'Execute official Braintree GraphQL query field `node`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'graphql_type' => 'ID!',
        'type' => 'string',
        'required' => true,
        'description' => 'GraphQL variable `id` of type ID!.',
      ],
    ],
  ],
  8 =>
  [
    'operation' => 'paypalBillingAgreementDetails',
    'slug' => 'braintree_paypal_billing_agreement_details',
    'class' => 'BraintreePaypalBillingAgreementDetails',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'paypalBillingAgreementDetails',
    'return_type' => 'PayPalBillingAgreementDetailsPayload',
    'return_graphql_type' => 'PayPalBillingAgreementDetailsPayload',
    'returns_scalar' => false,
    'name' => 'Paypal Billing Agreement Details',
    'description' => 'Execute official Braintree GraphQL query field `paypalBillingAgreementDetails`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'PayPalBillingAgreementDetailsInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type PayPalBillingAgreementDetailsInput!.',
      ],
    ],
  ],
  9 =>
  [
    'operation' => 'paypalOrderDetails',
    'slug' => 'braintree_paypal_order_details',
    'class' => 'BraintreePaypalOrderDetails',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'paypalOrderDetails',
    'return_type' => 'PayPalOrderDetailsPayload',
    'return_graphql_type' => 'PayPalOrderDetailsPayload',
    'returns_scalar' => false,
    'name' => 'Paypal Order Details',
    'description' => 'Execute official Braintree GraphQL query field `paypalOrderDetails`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'PayPalOrderDetailsInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type PayPalOrderDetailsInput!.',
      ],
    ],
  ],
  10 =>
  [
    'operation' => 'ping',
    'slug' => 'braintree_ping',
    'class' => 'BraintreePing',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'ping',
    'return_type' => 'String',
    'return_graphql_type' => 'String!',
    'returns_scalar' => true,
    'name' => 'Ping',
    'description' => 'Execute official Braintree GraphQL query field `ping`.',
    'type' => 'read',
    'parameters' =>
    [
    ],
  ],
  11 =>
  [
    'operation' => 'pingInStoreReader',
    'slug' => 'braintree_ping_in_store_reader',
    'class' => 'BraintreePingInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'pingInStoreReader',
    'return_type' => 'InStoreReader',
    'return_graphql_type' => 'InStoreReader',
    'returns_scalar' => false,
    'name' => 'Ping In Store Reader',
    'description' => 'Execute official Braintree GraphQL query field `pingInStoreReader`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'readerId',
        'param' => 'reader_id',
        'graphql_type' => 'ID!',
        'type' => 'string',
        'required' => true,
        'description' => 'GraphQL variable `readerId` of type ID!.',
      ],
    ],
  ],
  12 =>
  [
    'operation' => 'recurringBillingSubscriptionPlanAddOns',
    'slug' => 'braintree_recurring_billing_subscription_plan_add_ons',
    'class' => 'BraintreeRecurringBillingSubscriptionPlanAddOns',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'recurringBillingSubscriptionPlanAddOns',
    'return_type' => 'RecurringBillingSubscriptionPlanAddOnsPayload',
    'return_graphql_type' => 'RecurringBillingSubscriptionPlanAddOnsPayload',
    'returns_scalar' => false,
    'name' => 'Recurring Billing Subscription Plan Add Ons',
    'description' => 'Execute official Braintree GraphQL query field `recurringBillingSubscriptionPlanAddOns`.',
    'type' => 'read',
    'parameters' =>
    [
    ],
  ],
  13 =>
  [
    'operation' => 'recurringBillingSubscriptionPlanDiscounts',
    'slug' => 'braintree_recurring_billing_subscription_plan_discounts',
    'class' => 'BraintreeRecurringBillingSubscriptionPlanDiscounts',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'recurringBillingSubscriptionPlanDiscounts',
    'return_type' => 'RecurringBillingSubscriptionPlanDiscountsPayload',
    'return_graphql_type' => 'RecurringBillingSubscriptionPlanDiscountsPayload',
    'returns_scalar' => false,
    'name' => 'Recurring Billing Subscription Plan Discounts',
    'description' => 'Execute official Braintree GraphQL query field `recurringBillingSubscriptionPlanDiscounts`.',
    'type' => 'read',
    'parameters' =>
    [
    ],
  ],
  14 =>
  [
    'operation' => 'recurringBillingSubscriptionPlans',
    'slug' => 'braintree_recurring_billing_subscription_plans',
    'class' => 'BraintreeRecurringBillingSubscriptionPlans',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'recurringBillingSubscriptionPlans',
    'return_type' => 'RecurringBillingSubscriptionPlansPayload',
    'return_graphql_type' => 'RecurringBillingSubscriptionPlansPayload',
    'returns_scalar' => false,
    'name' => 'Recurring Billing Subscription Plans',
    'description' => 'Execute official Braintree GraphQL query field `recurringBillingSubscriptionPlans`.',
    'type' => 'read',
    'parameters' =>
    [
    ],
  ],
  15 =>
  [
    'operation' => 'viewer',
    'slug' => 'braintree_viewer',
    'class' => 'BraintreeViewer',
    'scope' => 'root',
    'graphql_kind' => 'query',
    'field' => 'viewer',
    'return_type' => 'Viewer',
    'return_graphql_type' => 'Viewer',
    'returns_scalar' => false,
    'name' => 'Viewer',
    'description' => 'Execute official Braintree GraphQL query field `viewer`.',
    'type' => 'read',
    'parameters' =>
    [
    ],
  ],
  16 =>
  [
    'operation' => 'search_businessAccountCreationRequests',
    'slug' => 'braintree_search_business_account_creation_requests',
    'class' => 'BraintreeSearchBusinessAccountCreationRequests',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'businessAccountCreationRequests',
    'return_type' => 'BusinessAccountCreationRequestConnection',
    'return_graphql_type' => 'BusinessAccountCreationRequestConnection',
    'returns_scalar' => false,
    'name' => 'Search Business Account Creation Requests',
    'description' => 'Execute official Braintree GraphQL query field `businessAccountCreationRequests` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'BusinessAccountCreationRequestSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type BusinessAccountCreationRequestSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  17 =>
  [
    'operation' => 'search_customers',
    'slug' => 'braintree_search_customers',
    'class' => 'BraintreeSearchCustomers',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'customers',
    'return_type' => 'CustomerConnection',
    'return_graphql_type' => 'CustomerConnection',
    'returns_scalar' => false,
    'name' => 'Search Customers',
    'description' => 'Execute official Braintree GraphQL query field `customers` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CustomerSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CustomerSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  18 =>
  [
    'operation' => 'search_disputes',
    'slug' => 'braintree_search_disputes',
    'class' => 'BraintreeSearchDisputes',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'disputes',
    'return_type' => 'DisputeConnection',
    'return_graphql_type' => 'DisputeConnection',
    'returns_scalar' => false,
    'name' => 'Search Disputes',
    'description' => 'Execute official Braintree GraphQL query field `disputes` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'DisputeSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type DisputeSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  19 =>
  [
    'operation' => 'search_inStoreLocations',
    'slug' => 'braintree_search_in_store_locations',
    'class' => 'BraintreeSearchInStoreLocations',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'inStoreLocations',
    'return_type' => 'InStoreLocationSearchConnection',
    'return_graphql_type' => 'InStoreLocationSearchConnection',
    'returns_scalar' => false,
    'name' => 'Search In Store Locations',
    'description' => 'Execute official Braintree GraphQL query field `inStoreLocations` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'InStoreLocationSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type InStoreLocationSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  20 =>
  [
    'operation' => 'search_inStoreReaders',
    'slug' => 'braintree_search_in_store_readers',
    'class' => 'BraintreeSearchInStoreReaders',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'inStoreReaders',
    'return_type' => 'InStoreReaderConnection',
    'return_graphql_type' => 'InStoreReaderConnection',
    'returns_scalar' => false,
    'name' => 'Search In Store Readers',
    'description' => 'Execute official Braintree GraphQL query field `inStoreReaders` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'InStoreReaderSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type InStoreReaderSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  21 =>
  [
    'operation' => 'search_payments',
    'slug' => 'braintree_search_payments',
    'class' => 'BraintreeSearchPayments',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'payments',
    'return_type' => 'PaymentConnection',
    'return_graphql_type' => 'PaymentConnection',
    'returns_scalar' => false,
    'name' => 'Search Payments',
    'description' => 'Execute official Braintree GraphQL query field `payments` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'PaymentSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type PaymentSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  22 =>
  [
    'operation' => 'search_refunds',
    'slug' => 'braintree_search_refunds',
    'class' => 'BraintreeSearchRefunds',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'refunds',
    'return_type' => 'RefundConnection',
    'return_graphql_type' => 'RefundConnection',
    'returns_scalar' => false,
    'name' => 'Search Refunds',
    'description' => 'Execute official Braintree GraphQL query field `refunds` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RefundSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RefundSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  23 =>
  [
    'operation' => 'search_roles',
    'slug' => 'braintree_search_roles',
    'class' => 'BraintreeSearchRoles',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'roles',
    'return_type' => 'RoleSearchConnection',
    'return_graphql_type' => 'RoleSearchConnection',
    'returns_scalar' => false,
    'name' => 'Search Roles',
    'description' => 'Execute official Braintree GraphQL query field `roles` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RoleSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RoleSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  24 =>
  [
    'operation' => 'search_transactions',
    'slug' => 'braintree_search_transactions',
    'class' => 'BraintreeSearchTransactions',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'transactions',
    'return_type' => 'TransactionConnection',
    'return_graphql_type' => 'TransactionConnection',
    'returns_scalar' => false,
    'name' => 'Search Transactions',
    'description' => 'Execute official Braintree GraphQL query field `transactions` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TransactionSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TransactionSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  25 =>
  [
    'operation' => 'search_verifications',
    'slug' => 'braintree_search_verifications',
    'class' => 'BraintreeSearchVerifications',
    'scope' => 'search',
    'graphql_kind' => 'query',
    'field' => 'verifications',
    'return_type' => 'VerificationConnection',
    'return_graphql_type' => 'VerificationConnection',
    'returns_scalar' => false,
    'name' => 'Search Verifications',
    'description' => 'Execute official Braintree GraphQL query field `verifications` under `search`.',
    'type' => 'read',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VerificationSearchInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VerificationSearchInput!.',
      ],
      1 =>
      [
        'name' => 'first',
        'param' => 'first',
        'graphql_type' => 'Int',
        'type' => 'integer',
        'required' => false,
        'description' => 'GraphQL variable `first` of type Int.',
      ],
      2 =>
      [
        'name' => 'after',
        'param' => 'after',
        'graphql_type' => 'String',
        'type' => 'string',
        'required' => false,
        'description' => 'GraphQL variable `after` of type String.',
      ],
    ],
  ],
  26 =>
  [
    'operation' => 'acceptDispute',
    'slug' => 'braintree_accept_dispute',
    'class' => 'BraintreeAcceptDispute',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'acceptDispute',
    'return_type' => 'AcceptDisputePayload',
    'return_graphql_type' => 'AcceptDisputePayload',
    'returns_scalar' => false,
    'name' => 'Accept Dispute',
    'description' => 'Execute official Braintree GraphQL mutation field `acceptDispute`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'AcceptDisputeInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type AcceptDisputeInput!.',
      ],
    ],
  ],
  27 =>
  [
    'operation' => 'authorizeCreditCard',
    'slug' => 'braintree_authorize_credit_card',
    'class' => 'BraintreeAuthorizeCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'authorizeCreditCard',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Authorize Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `authorizeCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'AuthorizeCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type AuthorizeCreditCardInput!.',
      ],
    ],
  ],
  28 =>
  [
    'operation' => 'authorizeInStoreCreditCard',
    'slug' => 'braintree_authorize_in_store_credit_card',
    'class' => 'BraintreeAuthorizeInStoreCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'authorizeInStoreCreditCard',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Authorize In Store Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `authorizeInStoreCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'AuthorizeInStoreCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type AuthorizeInStoreCreditCardInput!.',
      ],
    ],
  ],
  29 =>
  [
    'operation' => 'authorizePayPalAccount',
    'slug' => 'braintree_authorize_pay_pal_account',
    'class' => 'BraintreeAuthorizePayPalAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'authorizePayPalAccount',
    'return_type' => 'PayPalTransactionPayload',
    'return_graphql_type' => 'PayPalTransactionPayload',
    'returns_scalar' => false,
    'name' => 'Authorize Pay Pal Account',
    'description' => 'Execute official Braintree GraphQL mutation field `authorizePayPalAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'AuthorizePayPalAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type AuthorizePayPalAccountInput!.',
      ],
    ],
  ],
  30 =>
  [
    'operation' => 'authorizePaymentMethod',
    'slug' => 'braintree_authorize_payment_method',
    'class' => 'BraintreeAuthorizePaymentMethod',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'authorizePaymentMethod',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Authorize Payment Method',
    'description' => 'Execute official Braintree GraphQL mutation field `authorizePaymentMethod`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'AuthorizePaymentMethodInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type AuthorizePaymentMethodInput!.',
      ],
    ],
  ],
  31 =>
  [
    'operation' => 'authorizeVenmoAccount',
    'slug' => 'braintree_authorize_venmo_account',
    'class' => 'BraintreeAuthorizeVenmoAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'authorizeVenmoAccount',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Authorize Venmo Account',
    'description' => 'Execute official Braintree GraphQL mutation field `authorizeVenmoAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'AuthorizeVenmoAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type AuthorizeVenmoAccountInput!.',
      ],
    ],
  ],
  32 =>
  [
    'operation' => 'captureTransaction',
    'slug' => 'braintree_capture_transaction',
    'class' => 'BraintreeCaptureTransaction',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'captureTransaction',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Capture Transaction',
    'description' => 'Execute official Braintree GraphQL mutation field `captureTransaction`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CaptureTransactionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CaptureTransactionInput!.',
      ],
    ],
  ],
  33 =>
  [
    'operation' => 'chargeCreditCard',
    'slug' => 'braintree_charge_credit_card',
    'class' => 'BraintreeChargeCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'chargeCreditCard',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Charge Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `chargeCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ChargeCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ChargeCreditCardInput!.',
      ],
    ],
  ],
  34 =>
  [
    'operation' => 'chargeInStoreCreditCard',
    'slug' => 'braintree_charge_in_store_credit_card',
    'class' => 'BraintreeChargeInStoreCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'chargeInStoreCreditCard',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Charge In Store Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `chargeInStoreCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ChargeInStoreCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ChargeInStoreCreditCardInput!.',
      ],
    ],
  ],
  35 =>
  [
    'operation' => 'chargePayPalAccount',
    'slug' => 'braintree_charge_pay_pal_account',
    'class' => 'BraintreeChargePayPalAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'chargePayPalAccount',
    'return_type' => 'PayPalTransactionPayload',
    'return_graphql_type' => 'PayPalTransactionPayload',
    'returns_scalar' => false,
    'name' => 'Charge Pay Pal Account',
    'description' => 'Execute official Braintree GraphQL mutation field `chargePayPalAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ChargePayPalAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ChargePayPalAccountInput!.',
      ],
    ],
  ],
  36 =>
  [
    'operation' => 'chargePaymentMethod',
    'slug' => 'braintree_charge_payment_method',
    'class' => 'BraintreeChargePaymentMethod',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'chargePaymentMethod',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Charge Payment Method',
    'description' => 'Execute official Braintree GraphQL mutation field `chargePaymentMethod`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ChargePaymentMethodInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ChargePaymentMethodInput!.',
      ],
    ],
  ],
  37 =>
  [
    'operation' => 'chargeUsBankAccount',
    'slug' => 'braintree_charge_us_bank_account',
    'class' => 'BraintreeChargeUsBankAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'chargeUsBankAccount',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Charge Us Bank Account',
    'description' => 'Execute official Braintree GraphQL mutation field `chargeUsBankAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ChargeUsBankAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ChargeUsBankAccountInput!.',
      ],
    ],
  ],
  38 =>
  [
    'operation' => 'chargeVenmoAccount',
    'slug' => 'braintree_charge_venmo_account',
    'class' => 'BraintreeChargeVenmoAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'chargeVenmoAccount',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Charge Venmo Account',
    'description' => 'Execute official Braintree GraphQL mutation field `chargeVenmoAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ChargeVenmoAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ChargeVenmoAccountInput!.',
      ],
    ],
  ],
  39 =>
  [
    'operation' => 'confirmMicroTransferAmounts',
    'slug' => 'braintree_confirm_micro_transfer_amounts',
    'class' => 'BraintreeConfirmMicroTransferAmounts',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'confirmMicroTransferAmounts',
    'return_type' => 'ConfirmMicroTransferAmountsPayload',
    'return_graphql_type' => 'ConfirmMicroTransferAmountsPayload',
    'returns_scalar' => false,
    'name' => 'Confirm Micro Transfer Amounts',
    'description' => 'Execute official Braintree GraphQL mutation field `confirmMicroTransferAmounts`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ConfirmMicroTransferAmountsInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ConfirmMicroTransferAmountsInput!.',
      ],
    ],
  ],
  40 =>
  [
    'operation' => 'createApplePayWebSession',
    'slug' => 'braintree_create_apple_pay_web_session',
    'class' => 'BraintreeCreateApplePayWebSession',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createApplePayWebSession',
    'return_type' => 'CreateApplePayWebSessionPayload',
    'return_graphql_type' => 'CreateApplePayWebSessionPayload',
    'returns_scalar' => false,
    'name' => 'Create Apple Pay Web Session',
    'description' => 'Execute official Braintree GraphQL mutation field `createApplePayWebSession`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateApplePayWebSessionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateApplePayWebSessionInput!.',
      ],
    ],
  ],
  41 =>
  [
    'operation' => 'createBillingAgreementJwt',
    'slug' => 'braintree_create_billing_agreement_jwt',
    'class' => 'BraintreeCreateBillingAgreementJwt',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createBillingAgreementJwt',
    'return_type' => 'CreateBillingAgreementJwtPayload',
    'return_graphql_type' => 'CreateBillingAgreementJwtPayload',
    'returns_scalar' => false,
    'name' => 'Create Billing Agreement Jwt',
    'description' => 'Execute official Braintree GraphQL mutation field `createBillingAgreementJwt`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateBillingAgreementJwtInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateBillingAgreementJwtInput!.',
      ],
    ],
  ],
  42 =>
  [
    'operation' => 'createClientToken',
    'slug' => 'braintree_create_client_token',
    'class' => 'BraintreeCreateClientToken',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createClientToken',
    'return_type' => 'CreateClientTokenPayload',
    'return_graphql_type' => 'CreateClientTokenPayload',
    'returns_scalar' => false,
    'name' => 'Create Client Token',
    'description' => 'Execute official Braintree GraphQL mutation field `createClientToken`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateClientTokenInput',
        'type' => 'object',
        'required' => false,
        'description' => 'GraphQL variable `input` of type CreateClientTokenInput.',
      ],
    ],
  ],
  43 =>
  [
    'operation' => 'createCustomer',
    'slug' => 'braintree_create_customer',
    'class' => 'BraintreeCreateCustomer',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createCustomer',
    'return_type' => 'CreateCustomerPayload',
    'return_graphql_type' => 'CreateCustomerPayload',
    'returns_scalar' => false,
    'name' => 'Create Customer',
    'description' => 'Execute official Braintree GraphQL mutation field `createCustomer`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateCustomerInput',
        'type' => 'object',
        'required' => false,
        'description' => 'GraphQL variable `input` of type CreateCustomerInput.',
      ],
    ],
  ],
  44 =>
  [
    'operation' => 'createDisputeFileEvidence',
    'slug' => 'braintree_create_dispute_file_evidence',
    'class' => 'BraintreeCreateDisputeFileEvidence',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createDisputeFileEvidence',
    'return_type' => 'CreateDisputeFileEvidencePayload',
    'return_graphql_type' => 'CreateDisputeFileEvidencePayload',
    'returns_scalar' => false,
    'name' => 'Create Dispute File Evidence',
    'description' => 'Execute official Braintree GraphQL mutation field `createDisputeFileEvidence`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateDisputeFileEvidenceInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateDisputeFileEvidenceInput!.',
      ],
    ],
  ],
  45 =>
  [
    'operation' => 'createDisputeTextEvidence',
    'slug' => 'braintree_create_dispute_text_evidence',
    'class' => 'BraintreeCreateDisputeTextEvidence',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createDisputeTextEvidence',
    'return_type' => 'CreateDisputeTextEvidencePayload',
    'return_graphql_type' => 'CreateDisputeTextEvidencePayload',
    'returns_scalar' => false,
    'name' => 'Create Dispute Text Evidence',
    'description' => 'Execute official Braintree GraphQL mutation field `createDisputeTextEvidence`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateDisputeTextEvidenceInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateDisputeTextEvidenceInput!.',
      ],
    ],
  ],
  46 =>
  [
    'operation' => 'createInStoreLocation',
    'slug' => 'braintree_create_in_store_location',
    'class' => 'BraintreeCreateInStoreLocation',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createInStoreLocation',
    'return_type' => 'CreateInStoreLocationPayload',
    'return_graphql_type' => 'CreateInStoreLocationPayload',
    'returns_scalar' => false,
    'name' => 'Create In Store Location',
    'description' => 'Execute official Braintree GraphQL mutation field `createInStoreLocation`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateInStoreLocationInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateInStoreLocationInput!.',
      ],
    ],
  ],
  47 =>
  [
    'operation' => 'createLocalPaymentContext',
    'slug' => 'braintree_create_local_payment_context',
    'class' => 'BraintreeCreateLocalPaymentContext',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createLocalPaymentContext',
    'return_type' => 'CreateLocalPaymentContextPayload',
    'return_graphql_type' => 'CreateLocalPaymentContextPayload',
    'returns_scalar' => false,
    'name' => 'Create Local Payment Context',
    'description' => 'Execute official Braintree GraphQL mutation field `createLocalPaymentContext`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateLocalPaymentContextInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateLocalPaymentContextInput!.',
      ],
    ],
  ],
  48 =>
  [
    'operation' => 'createNonInstantLocalPaymentContext',
    'slug' => 'braintree_create_non_instant_local_payment_context',
    'class' => 'BraintreeCreateNonInstantLocalPaymentContext',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createNonInstantLocalPaymentContext',
    'return_type' => 'CreateNonInstantLocalPaymentContextPayload',
    'return_graphql_type' => 'CreateNonInstantLocalPaymentContextPayload',
    'returns_scalar' => false,
    'name' => 'Create Non Instant Local Payment Context',
    'description' => 'Execute official Braintree GraphQL mutation field `createNonInstantLocalPaymentContext`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateNonInstantLocalPaymentContextInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateNonInstantLocalPaymentContextInput!.',
      ],
    ],
  ],
  49 =>
  [
    'operation' => 'createOAuthClientSecret',
    'slug' => 'braintree_create_oauth_client_secret',
    'class' => 'BraintreeCreateOAuthClientSecret',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createOAuthClientSecret',
    'return_type' => 'CreateOAuthClientSecretPayload',
    'return_graphql_type' => 'CreateOAuthClientSecretPayload',
    'returns_scalar' => false,
    'name' => 'Create Oauth Client Secret',
    'description' => 'Execute official Braintree GraphQL mutation field `createOAuthClientSecret`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateOAuthClientSecretInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateOAuthClientSecretInput!.',
      ],
    ],
  ],
  50 =>
  [
    'operation' => 'createOfflineDeclinedTransaction',
    'slug' => 'braintree_create_offline_declined_transaction',
    'class' => 'BraintreeCreateOfflineDeclinedTransaction',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createOfflineDeclinedTransaction',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Create Offline Declined Transaction',
    'description' => 'Execute official Braintree GraphQL mutation field `createOfflineDeclinedTransaction`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateOfflineDeclinedTransactionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateOfflineDeclinedTransactionInput!.',
      ],
    ],
  ],
  51 =>
  [
    'operation' => 'createPayPalBillingAgreement',
    'slug' => 'braintree_create_pay_pal_billing_agreement',
    'class' => 'BraintreeCreatePayPalBillingAgreement',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createPayPalBillingAgreement',
    'return_type' => 'CreatePayPalBillingAgreementPayload',
    'return_graphql_type' => 'CreatePayPalBillingAgreementPayload',
    'returns_scalar' => false,
    'name' => 'Create Pay Pal Billing Agreement',
    'description' => 'Execute official Braintree GraphQL mutation field `createPayPalBillingAgreement`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreatePayPalBillingAgreementInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreatePayPalBillingAgreementInput!.',
      ],
    ],
  ],
  52 =>
  [
    'operation' => 'createPayPalOneTimePayment',
    'slug' => 'braintree_create_pay_pal_one_time_payment',
    'class' => 'BraintreeCreatePayPalOneTimePayment',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createPayPalOneTimePayment',
    'return_type' => 'CreatePayPalOneTimePaymentPayload',
    'return_graphql_type' => 'CreatePayPalOneTimePaymentPayload',
    'returns_scalar' => false,
    'name' => 'Create Pay Pal One Time Payment',
    'description' => 'Execute official Braintree GraphQL mutation field `createPayPalOneTimePayment`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreatePayPalOneTimePaymentInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreatePayPalOneTimePaymentInput!.',
      ],
    ],
  ],
  53 =>
  [
    'operation' => 'createRecurringBillingSubscriptionPlan',
    'slug' => 'braintree_create_recurring_billing_subscription_plan',
    'class' => 'BraintreeCreateRecurringBillingSubscriptionPlan',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createRecurringBillingSubscriptionPlan',
    'return_type' => 'RecurringBillingSubscriptionPlanPayload',
    'return_graphql_type' => 'RecurringBillingSubscriptionPlanPayload',
    'returns_scalar' => false,
    'name' => 'Create Recurring Billing Subscription Plan',
    'description' => 'Execute official Braintree GraphQL mutation field `createRecurringBillingSubscriptionPlan`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateRecurringBillingSubscriptionPlanInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateRecurringBillingSubscriptionPlanInput!.',
      ],
    ],
  ],
  54 =>
  [
    'operation' => 'createTransactionPackageTracking',
    'slug' => 'braintree_create_transaction_package_tracking',
    'class' => 'BraintreeCreateTransactionPackageTracking',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createTransactionPackageTracking',
    'return_type' => 'CreateTransactionPackageTrackingPayload',
    'return_graphql_type' => 'CreateTransactionPackageTrackingPayload',
    'returns_scalar' => false,
    'name' => 'Create Transaction Package Tracking',
    'description' => 'Execute official Braintree GraphQL mutation field `createTransactionPackageTracking`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateTransactionPackageTrackingInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateTransactionPackageTrackingInput!.',
      ],
    ],
  ],
  55 =>
  [
    'operation' => 'createTransactionRiskContext',
    'slug' => 'braintree_create_transaction_risk_context',
    'class' => 'BraintreeCreateTransactionRiskContext',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createTransactionRiskContext',
    'return_type' => 'TransactionRiskContextPayload',
    'return_graphql_type' => 'TransactionRiskContextPayload',
    'returns_scalar' => false,
    'name' => 'Create Transaction Risk Context',
    'description' => 'Execute official Braintree GraphQL mutation field `createTransactionRiskContext`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateTransactionRiskContextInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateTransactionRiskContextInput!.',
      ],
    ],
  ],
  56 =>
  [
    'operation' => 'createUniversalAccessToken',
    'slug' => 'braintree_create_universal_access_token',
    'class' => 'BraintreeCreateUniversalAccessToken',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createUniversalAccessToken',
    'return_type' => 'CreateUniversalAccessTokenPayload',
    'return_graphql_type' => 'CreateUniversalAccessTokenPayload',
    'returns_scalar' => false,
    'name' => 'Create Universal Access Token',
    'description' => 'Execute official Braintree GraphQL mutation field `createUniversalAccessToken`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateUniversalAccessTokenInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateUniversalAccessTokenInput!.',
      ],
    ],
  ],
  57 =>
  [
    'operation' => 'createVenmoPaymentContext',
    'slug' => 'braintree_create_venmo_payment_context',
    'class' => 'BraintreeCreateVenmoPaymentContext',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'createVenmoPaymentContext',
    'return_type' => 'VenmoPaymentContextPayload',
    'return_graphql_type' => 'VenmoPaymentContextPayload',
    'returns_scalar' => false,
    'name' => 'Create Venmo Payment Context',
    'description' => 'Execute official Braintree GraphQL mutation field `createVenmoPaymentContext`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'CreateVenmoPaymentContextInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type CreateVenmoPaymentContextInput!.',
      ],
    ],
  ],
  58 =>
  [
    'operation' => 'deleteCustomer',
    'slug' => 'braintree_delete_customer',
    'class' => 'BraintreeDeleteCustomer',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'deleteCustomer',
    'return_type' => 'DeleteCustomerPayload',
    'return_graphql_type' => 'DeleteCustomerPayload',
    'returns_scalar' => false,
    'name' => 'Delete Customer',
    'description' => 'Execute official Braintree GraphQL mutation field `deleteCustomer`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'DeleteCustomerInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type DeleteCustomerInput!.',
      ],
    ],
  ],
  59 =>
  [
    'operation' => 'deleteDisputeEvidence',
    'slug' => 'braintree_delete_dispute_evidence',
    'class' => 'BraintreeDeleteDisputeEvidence',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'deleteDisputeEvidence',
    'return_type' => 'DeleteDisputeEvidencePayload',
    'return_graphql_type' => 'DeleteDisputeEvidencePayload',
    'returns_scalar' => false,
    'name' => 'Delete Dispute Evidence',
    'description' => 'Execute official Braintree GraphQL mutation field `deleteDisputeEvidence`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'DeleteDisputeEvidenceInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type DeleteDisputeEvidenceInput!.',
      ],
    ],
  ],
  60 =>
  [
    'operation' => 'deleteInStoreLocation',
    'slug' => 'braintree_delete_in_store_location',
    'class' => 'BraintreeDeleteInStoreLocation',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'deleteInStoreLocation',
    'return_type' => 'DeleteInStoreLocationPayload',
    'return_graphql_type' => 'DeleteInStoreLocationPayload',
    'returns_scalar' => false,
    'name' => 'Delete In Store Location',
    'description' => 'Execute official Braintree GraphQL mutation field `deleteInStoreLocation`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'DeleteInStoreLocationInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type DeleteInStoreLocationInput!.',
      ],
    ],
  ],
  61 =>
  [
    'operation' => 'deleteOAuthClientSecret',
    'slug' => 'braintree_delete_oauth_client_secret',
    'class' => 'BraintreeDeleteOAuthClientSecret',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'deleteOAuthClientSecret',
    'return_type' => 'DeleteOAuthClientSecretPayload',
    'return_graphql_type' => 'DeleteOAuthClientSecretPayload',
    'returns_scalar' => false,
    'name' => 'Delete Oauth Client Secret',
    'description' => 'Execute official Braintree GraphQL mutation field `deleteOAuthClientSecret`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'DeleteOAuthClientSecretInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type DeleteOAuthClientSecretInput!.',
      ],
    ],
  ],
  62 =>
  [
    'operation' => 'deletePaymentMethodFromSingleUseToken',
    'slug' => 'braintree_delete_payment_method_from_single_use_token',
    'class' => 'BraintreeDeletePaymentMethodFromSingleUseToken',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'deletePaymentMethodFromSingleUseToken',
    'return_type' => 'DeletePaymentMethodFromSingleUseTokenPayload',
    'return_graphql_type' => 'DeletePaymentMethodFromSingleUseTokenPayload',
    'returns_scalar' => false,
    'name' => 'Delete Payment Method From Single Use Token',
    'description' => 'Execute official Braintree GraphQL mutation field `deletePaymentMethodFromSingleUseToken`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'DeletePaymentMethodFromSingleUseTokenInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type DeletePaymentMethodFromSingleUseTokenInput!.',
      ],
    ],
  ],
  63 =>
  [
    'operation' => 'deletePaymentMethodFromVault',
    'slug' => 'braintree_delete_payment_method_from_vault',
    'class' => 'BraintreeDeletePaymentMethodFromVault',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'deletePaymentMethodFromVault',
    'return_type' => 'DeletePaymentMethodFromVaultPayload',
    'return_graphql_type' => 'DeletePaymentMethodFromVaultPayload',
    'returns_scalar' => false,
    'name' => 'Delete Payment Method From Vault',
    'description' => 'Execute official Braintree GraphQL mutation field `deletePaymentMethodFromVault`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'DeletePaymentMethodFromVaultInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type DeletePaymentMethodFromVaultInput!.',
      ],
    ],
  ],
  64 =>
  [
    'operation' => 'disableOAuthClientSecret',
    'slug' => 'braintree_disable_oauth_client_secret',
    'class' => 'BraintreeDisableOAuthClientSecret',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'disableOAuthClientSecret',
    'return_type' => 'DisableOAuthClientSecretPayload',
    'return_graphql_type' => 'DisableOAuthClientSecretPayload',
    'returns_scalar' => false,
    'name' => 'Disable Oauth Client Secret',
    'description' => 'Execute official Braintree GraphQL mutation field `disableOAuthClientSecret`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'DisableOAuthClientSecretInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type DisableOAuthClientSecretInput!.',
      ],
    ],
  ],
  65 =>
  [
    'operation' => 'evaluateTransactionRisk',
    'slug' => 'braintree_evaluate_transaction_risk',
    'class' => 'BraintreeEvaluateTransactionRisk',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'evaluateTransactionRisk',
    'return_type' => 'TransactionRiskEvaluatePayload',
    'return_graphql_type' => 'TransactionRiskEvaluatePayload',
    'returns_scalar' => false,
    'name' => 'Evaluate Transaction Risk',
    'description' => 'Execute official Braintree GraphQL mutation field `evaluateTransactionRisk`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'EvaluateTransactionRiskInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type EvaluateTransactionRiskInput!.',
      ],
    ],
  ],
  66 =>
  [
    'operation' => 'finalizeDispute',
    'slug' => 'braintree_finalize_dispute',
    'class' => 'BraintreeFinalizeDispute',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'finalizeDispute',
    'return_type' => 'FinalizeDisputePayload',
    'return_graphql_type' => 'FinalizeDisputePayload',
    'returns_scalar' => false,
    'name' => 'Finalize Dispute',
    'description' => 'Execute official Braintree GraphQL mutation field `finalizeDispute`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'FinalizeDisputeInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type FinalizeDisputeInput!.',
      ],
    ],
  ],
  67 =>
  [
    'operation' => 'generateEditFundingInstrumentUrl',
    'slug' => 'braintree_generate_edit_funding_instrument_url',
    'class' => 'BraintreeGenerateEditFundingInstrumentUrl',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'generateEditFundingInstrumentUrl',
    'return_type' => 'GenerateEditFundingInstrumentUrlPayload',
    'return_graphql_type' => 'GenerateEditFundingInstrumentUrlPayload',
    'returns_scalar' => false,
    'name' => 'Generate Edit Funding Instrument Url',
    'description' => 'Execute official Braintree GraphQL mutation field `generateEditFundingInstrumentUrl`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'GenerateEditFundingInstrumentUrlInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type GenerateEditFundingInstrumentUrlInput!.',
      ],
    ],
  ],
  68 =>
  [
    'operation' => 'generateExchangeRateQuote',
    'slug' => 'braintree_generate_exchange_rate_quote',
    'class' => 'BraintreeGenerateExchangeRateQuote',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'generateExchangeRateQuote',
    'return_type' => 'ExchangeRateQuotePayload',
    'return_graphql_type' => 'ExchangeRateQuotePayload',
    'returns_scalar' => false,
    'name' => 'Generate Exchange Rate Quote',
    'description' => 'Execute official Braintree GraphQL mutation field `generateExchangeRateQuote`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'GenerateExchangeRateQuoteInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type GenerateExchangeRateQuoteInput!.',
      ],
    ],
  ],
  69 =>
  [
    'operation' => 'pairInStoreReader',
    'slug' => 'braintree_pair_in_store_reader',
    'class' => 'BraintreePairInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'pairInStoreReader',
    'return_type' => 'InStoreReaderPayload',
    'return_graphql_type' => 'InStoreReaderPayload',
    'returns_scalar' => false,
    'name' => 'Pair In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `pairInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'PairInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type PairInStoreReaderInput!.',
      ],
    ],
  ],
  70 =>
  [
    'operation' => 'partialCaptureTransaction',
    'slug' => 'braintree_partial_capture_transaction',
    'class' => 'BraintreePartialCaptureTransaction',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'partialCaptureTransaction',
    'return_type' => 'PartialCaptureTransactionPayload',
    'return_graphql_type' => 'PartialCaptureTransactionPayload',
    'returns_scalar' => false,
    'name' => 'Partial Capture Transaction',
    'description' => 'Execute official Braintree GraphQL mutation field `partialCaptureTransaction`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'PartialCaptureTransactionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type PartialCaptureTransactionInput!.',
      ],
    ],
  ],
  71 =>
  [
    'operation' => 'performThreeDSecureLookup',
    'slug' => 'braintree_perform_three_dsecure_lookup',
    'class' => 'BraintreePerformThreeDSecureLookup',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'performThreeDSecureLookup',
    'return_type' => 'PerformThreeDSecureLookupPayload',
    'return_graphql_type' => 'PerformThreeDSecureLookupPayload',
    'returns_scalar' => false,
    'name' => 'Perform Three Dsecure Lookup',
    'description' => 'Execute official Braintree GraphQL mutation field `performThreeDSecureLookup`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'PerformThreeDSecureLookupInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type PerformThreeDSecureLookupInput!.',
      ],
    ],
  ],
  72 =>
  [
    'operation' => 'refundCreditCard',
    'slug' => 'braintree_refund_credit_card',
    'class' => 'BraintreeRefundCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'refundCreditCard',
    'return_type' => 'RefundCreditCardPayload',
    'return_graphql_type' => 'RefundCreditCardPayload',
    'returns_scalar' => false,
    'name' => 'Refund Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `refundCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RefundCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RefundCreditCardInput!.',
      ],
    ],
  ],
  73 =>
  [
    'operation' => 'refundInStoreCreditCard',
    'slug' => 'braintree_refund_in_store_credit_card',
    'class' => 'BraintreeRefundInStoreCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'refundInStoreCreditCard',
    'return_type' => 'RefundCreditCardPayload',
    'return_graphql_type' => 'RefundCreditCardPayload',
    'returns_scalar' => false,
    'name' => 'Refund In Store Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `refundInStoreCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RefundInStoreCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RefundInStoreCreditCardInput!.',
      ],
    ],
  ],
  74 =>
  [
    'operation' => 'refundTransaction',
    'slug' => 'braintree_refund_transaction',
    'class' => 'BraintreeRefundTransaction',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'refundTransaction',
    'return_type' => 'RefundTransactionPayload',
    'return_graphql_type' => 'RefundTransactionPayload',
    'returns_scalar' => false,
    'name' => 'Refund Transaction',
    'description' => 'Execute official Braintree GraphQL mutation field `refundTransaction`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RefundTransactionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RefundTransactionInput!.',
      ],
    ],
  ],
  75 =>
  [
    'operation' => 'refundUsBankAccount',
    'slug' => 'braintree_refund_us_bank_account',
    'class' => 'BraintreeRefundUsBankAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'refundUsBankAccount',
    'return_type' => 'RefundUsBankAccountPayload',
    'return_graphql_type' => 'RefundUsBankAccountPayload',
    'returns_scalar' => false,
    'name' => 'Refund Us Bank Account',
    'description' => 'Execute official Braintree GraphQL mutation field `refundUsBankAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RefundUsBankAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RefundUsBankAccountInput!.',
      ],
    ],
  ],
  76 =>
  [
    'operation' => 'registerApplePayDomains',
    'slug' => 'braintree_register_apple_pay_domains',
    'class' => 'BraintreeRegisterApplePayDomains',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'registerApplePayDomains',
    'return_type' => 'RegisterApplePayDomainsPayload',
    'return_graphql_type' => 'RegisterApplePayDomainsPayload',
    'returns_scalar' => false,
    'name' => 'Register Apple Pay Domains',
    'description' => 'Execute official Braintree GraphQL mutation field `registerApplePayDomains`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RegisterApplePayDomainsInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RegisterApplePayDomainsInput!.',
      ],
    ],
  ],
  77 =>
  [
    'operation' => 'requestAmountPromptFromInStoreReader',
    'slug' => 'braintree_request_amount_prompt_from_in_store_reader',
    'class' => 'BraintreeRequestAmountPromptFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestAmountPromptFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Amount Prompt From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestAmountPromptFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestAmountPromptFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestAmountPromptFromInStoreReaderInput!.',
      ],
    ],
  ],
  78 =>
  [
    'operation' => 'requestAuthorizeFromInStoreReader',
    'slug' => 'braintree_request_authorize_from_in_store_reader',
    'class' => 'BraintreeRequestAuthorizeFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestAuthorizeFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Authorize From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestAuthorizeFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestAuthorizeFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestAuthorizeFromInStoreReaderInput!.',
      ],
    ],
  ],
  79 =>
  [
    'operation' => 'requestCancelFromInStoreReader',
    'slug' => 'braintree_request_cancel_from_in_store_reader',
    'class' => 'BraintreeRequestCancelFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestCancelFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Cancel From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestCancelFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestCancelFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestCancelFromInStoreReaderInput!.',
      ],
    ],
  ],
  80 =>
  [
    'operation' => 'requestChargeFromInStoreReader',
    'slug' => 'braintree_request_charge_from_in_store_reader',
    'class' => 'BraintreeRequestChargeFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestChargeFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Charge From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestChargeFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestChargeFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestChargeFromInStoreReaderInput!.',
      ],
    ],
  ],
  81 =>
  [
    'operation' => 'requestConfirmationPromptFromInStoreReader',
    'slug' => 'braintree_request_confirmation_prompt_from_in_store_reader',
    'class' => 'BraintreeRequestConfirmationPromptFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestConfirmationPromptFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Confirmation Prompt From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestConfirmationPromptFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestConfirmationPromptFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestConfirmationPromptFromInStoreReaderInput!.',
      ],
    ],
  ],
  82 =>
  [
    'operation' => 'requestFirmwareUpdateFromInStoreReader',
    'slug' => 'braintree_request_firmware_update_from_in_store_reader',
    'class' => 'BraintreeRequestFirmwareUpdateFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestFirmwareUpdateFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Firmware Update From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestFirmwareUpdateFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestFirmwareUpdateFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestFirmwareUpdateFromInStoreReaderInput!.',
      ],
    ],
  ],
  83 =>
  [
    'operation' => 'requestItemDisplayFromInStoreReader',
    'slug' => 'braintree_request_item_display_from_in_store_reader',
    'class' => 'BraintreeRequestItemDisplayFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestItemDisplayFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Item Display From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestItemDisplayFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestItemDisplayFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestItemDisplayFromInStoreReaderInput!.',
      ],
    ],
  ],
  84 =>
  [
    'operation' => 'requestMultiChoiceSingleSelectPromptFromInStoreReader',
    'slug' => 'braintree_request_multi_choice_single_select_prompt_from_in_store_reader',
    'class' => 'BraintreeRequestMultiChoiceSingleSelectPromptFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestMultiChoiceSingleSelectPromptFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Multi Choice Single Select Prompt From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestMultiChoiceSingleSelectPromptFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestMultiChoiceSingleSelectPromptFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestMultiChoiceSingleSelectPromptFromInStoreReaderInput!.',
      ],
    ],
  ],
  85 =>
  [
    'operation' => 'requestNonPciCardDataFromInStoreReader',
    'slug' => 'braintree_request_non_pci_card_data_from_in_store_reader',
    'class' => 'BraintreeRequestNonPciCardDataFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestNonPciCardDataFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Non Pci Card Data From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestNonPciCardDataFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestNonPciCardDataFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestNonPciCardDataFromInStoreReaderInput!.',
      ],
    ],
  ],
  86 =>
  [
    'operation' => 'requestPrintFromInStoreReader',
    'slug' => 'braintree_request_print_from_in_store_reader',
    'class' => 'BraintreeRequestPrintFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestPrintFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Print From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestPrintFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestPrintFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestPrintFromInStoreReaderInput!.',
      ],
    ],
  ],
  87 =>
  [
    'operation' => 'requestRefundFromInStoreReader',
    'slug' => 'braintree_request_refund_from_in_store_reader',
    'class' => 'BraintreeRequestRefundFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestRefundFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Refund From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestRefundFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestRefundFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestRefundFromInStoreReaderInput!.',
      ],
    ],
  ],
  88 =>
  [
    'operation' => 'requestSignaturePromptFromInStoreReader',
    'slug' => 'braintree_request_signature_prompt_from_in_store_reader',
    'class' => 'BraintreeRequestSignaturePromptFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestSignaturePromptFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Signature Prompt From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestSignaturePromptFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestSignaturePromptFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestSignaturePromptFromInStoreReaderInput!.',
      ],
    ],
  ],
  89 =>
  [
    'operation' => 'requestTextDisplayFromInStoreReader',
    'slug' => 'braintree_request_text_display_from_in_store_reader',
    'class' => 'BraintreeRequestTextDisplayFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestTextDisplayFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Text Display From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestTextDisplayFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestTextDisplayFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestTextDisplayFromInStoreReaderInput!.',
      ],
    ],
  ],
  90 =>
  [
    'operation' => 'requestTextPromptFromInStoreReader',
    'slug' => 'braintree_request_text_prompt_from_in_store_reader',
    'class' => 'BraintreeRequestTextPromptFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestTextPromptFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Text Prompt From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestTextPromptFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestTextPromptFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestTextPromptFromInStoreReaderInput!.',
      ],
    ],
  ],
  91 =>
  [
    'operation' => 'requestVaultFromInStoreReader',
    'slug' => 'braintree_request_vault_from_in_store_reader',
    'class' => 'BraintreeRequestVaultFromInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'requestVaultFromInStoreReader',
    'return_type' => 'InStoreContextPayload',
    'return_graphql_type' => 'InStoreContextPayload',
    'returns_scalar' => false,
    'name' => 'Request Vault From In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `requestVaultFromInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'RequestVaultFromInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type RequestVaultFromInStoreReaderInput!.',
      ],
    ],
  ],
  92 =>
  [
    'operation' => 'reverseEmvTransaction',
    'slug' => 'braintree_reverse_emv_transaction',
    'class' => 'BraintreeReverseEmvTransaction',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'reverseEmvTransaction',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Reverse Emv Transaction',
    'description' => 'Execute official Braintree GraphQL mutation field `reverseEmvTransaction`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ReverseEmvTransactionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ReverseEmvTransactionInput!.',
      ],
    ],
  ],
  93 =>
  [
    'operation' => 'reverseRefund',
    'slug' => 'braintree_reverse_refund',
    'class' => 'BraintreeReverseRefund',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'reverseRefund',
    'return_type' => 'RefundTransactionPayload',
    'return_graphql_type' => 'RefundTransactionPayload',
    'returns_scalar' => false,
    'name' => 'Reverse Refund',
    'description' => 'Execute official Braintree GraphQL mutation field `reverseRefund`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ReverseRefundInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ReverseRefundInput!.',
      ],
    ],
  ],
  94 =>
  [
    'operation' => 'reverseTransaction',
    'slug' => 'braintree_reverse_transaction',
    'class' => 'BraintreeReverseTransaction',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'reverseTransaction',
    'return_type' => 'ReverseTransactionPayload',
    'return_graphql_type' => 'ReverseTransactionPayload',
    'returns_scalar' => false,
    'name' => 'Reverse Transaction',
    'description' => 'Execute official Braintree GraphQL mutation field `reverseTransaction`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'ReverseTransactionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type ReverseTransactionInput!.',
      ],
    ],
  ],
  95 =>
  [
    'operation' => 'sandboxSettleTransaction',
    'slug' => 'braintree_sandbox_settle_transaction',
    'class' => 'BraintreeSandboxSettleTransaction',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'sandboxSettleTransaction',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Sandbox Settle Transaction',
    'description' => 'Execute official Braintree GraphQL mutation field `sandboxSettleTransaction`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'SandboxSettleTransactionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type SandboxSettleTransactionInput!.',
      ],
    ],
  ],
  96 =>
  [
    'operation' => 'submitDisputeFeedback',
    'slug' => 'braintree_submit_dispute_feedback',
    'class' => 'BraintreeSubmitDisputeFeedback',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'submitDisputeFeedback',
    'return_type' => 'SubmitFeedbackPayload',
    'return_graphql_type' => 'SubmitFeedbackPayload',
    'returns_scalar' => false,
    'name' => 'Submit Dispute Feedback',
    'description' => 'Execute official Braintree GraphQL mutation field `submitDisputeFeedback`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'SubmitDisputeFeedbackInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type SubmitDisputeFeedbackInput!.',
      ],
    ],
  ],
  97 =>
  [
    'operation' => 'submitTransactionFeedback',
    'slug' => 'braintree_submit_transaction_feedback',
    'class' => 'BraintreeSubmitTransactionFeedback',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'submitTransactionFeedback',
    'return_type' => 'SubmitFeedbackPayload',
    'return_graphql_type' => 'SubmitFeedbackPayload',
    'returns_scalar' => false,
    'name' => 'Submit Transaction Feedback',
    'description' => 'Execute official Braintree GraphQL mutation field `submitTransactionFeedback`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'SubmitTransactionFeedbackInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type SubmitTransactionFeedbackInput!.',
      ],
    ],
  ],
  98 =>
  [
    'operation' => 'tokenizeApplePayCard',
    'slug' => 'braintree_tokenize_apple_pay_card',
    'class' => 'BraintreeTokenizeApplePayCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeApplePayCard',
    'return_type' => 'TokenizeApplePayCardPayload',
    'return_graphql_type' => 'TokenizeApplePayCardPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Apple Pay Card',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeApplePayCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeApplePayCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeApplePayCardInput!.',
      ],
    ],
  ],
  99 =>
  [
    'operation' => 'tokenizeCreditCard',
    'slug' => 'braintree_tokenize_credit_card',
    'class' => 'BraintreeTokenizeCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeCreditCard',
    'return_type' => 'TokenizeCreditCardPayload',
    'return_graphql_type' => 'TokenizeCreditCardPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeCreditCardInput!.',
      ],
    ],
  ],
  100 =>
  [
    'operation' => 'tokenizeCustomActionsPaymentMethod',
    'slug' => 'braintree_tokenize_custom_actions_payment_method',
    'class' => 'BraintreeTokenizeCustomActionsPaymentMethod',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeCustomActionsPaymentMethod',
    'return_type' => 'TokenizeCustomActionsPaymentMethodPayload',
    'return_graphql_type' => 'TokenizeCustomActionsPaymentMethodPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Custom Actions Payment Method',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeCustomActionsPaymentMethod`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeCustomActionsPaymentMethodInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeCustomActionsPaymentMethodInput!.',
      ],
    ],
  ],
  101 =>
  [
    'operation' => 'tokenizeCvv',
    'slug' => 'braintree_tokenize_cvv',
    'class' => 'BraintreeTokenizeCvv',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeCvv',
    'return_type' => 'TokenizeCvvPayload',
    'return_graphql_type' => 'TokenizeCvvPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Cvv',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeCvv`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeCvvInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeCvvInput!.',
      ],
    ],
  ],
  102 =>
  [
    'operation' => 'tokenizeEmvCard',
    'slug' => 'braintree_tokenize_emv_card',
    'class' => 'BraintreeTokenizeEmvCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeEmvCard',
    'return_type' => 'TokenizeEmvCardPayload',
    'return_graphql_type' => 'TokenizeEmvCardPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Emv Card',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeEmvCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeEmvCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeEmvCardInput!.',
      ],
    ],
  ],
  103 =>
  [
    'operation' => 'tokenizeMagstripeCard',
    'slug' => 'braintree_tokenize_magstripe_card',
    'class' => 'BraintreeTokenizeMagstripeCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeMagstripeCard',
    'return_type' => 'TokenizeMagstripeCardPayload',
    'return_graphql_type' => 'TokenizeMagstripeCardPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Magstripe Card',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeMagstripeCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeMagstripeCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeMagstripeCardInput!.',
      ],
    ],
  ],
  104 =>
  [
    'operation' => 'tokenizeNetworkToken',
    'slug' => 'braintree_tokenize_network_token',
    'class' => 'BraintreeTokenizeNetworkToken',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeNetworkToken',
    'return_type' => 'TokenizeNetworkTokenPayload',
    'return_graphql_type' => 'TokenizeNetworkTokenPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Network Token',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeNetworkToken`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeNetworkTokenInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeNetworkTokenInput!.',
      ],
    ],
  ],
  105 =>
  [
    'operation' => 'tokenizePayPalBillingAgreement',
    'slug' => 'braintree_tokenize_pay_pal_billing_agreement',
    'class' => 'BraintreeTokenizePayPalBillingAgreement',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizePayPalBillingAgreement',
    'return_type' => 'TokenizePayPalBillingAgreementPayload',
    'return_graphql_type' => 'TokenizePayPalBillingAgreementPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Pay Pal Billing Agreement',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizePayPalBillingAgreement`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizePayPalBillingAgreementInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizePayPalBillingAgreementInput!.',
      ],
    ],
  ],
  106 =>
  [
    'operation' => 'tokenizePayPalOneTimePayment',
    'slug' => 'braintree_tokenize_pay_pal_one_time_payment',
    'class' => 'BraintreeTokenizePayPalOneTimePayment',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizePayPalOneTimePayment',
    'return_type' => 'TokenizePayPalOneTimePaymentPayload',
    'return_graphql_type' => 'TokenizePayPalOneTimePaymentPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Pay Pal One Time Payment',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizePayPalOneTimePayment`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizePayPalOneTimePaymentInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizePayPalOneTimePaymentInput!.',
      ],
    ],
  ],
  107 =>
  [
    'operation' => 'tokenizeSamsungPayCard',
    'slug' => 'braintree_tokenize_samsung_pay_card',
    'class' => 'BraintreeTokenizeSamsungPayCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeSamsungPayCard',
    'return_type' => 'TokenizeSamsungPayCardPayload',
    'return_graphql_type' => 'TokenizeSamsungPayCardPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Samsung Pay Card',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeSamsungPayCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeSamsungPayCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeSamsungPayCardInput!.',
      ],
    ],
  ],
  108 =>
  [
    'operation' => 'tokenizeUsBankAccount',
    'slug' => 'braintree_tokenize_us_bank_account',
    'class' => 'BraintreeTokenizeUsBankAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeUsBankAccount',
    'return_type' => 'TokenizeUsBankAccountPayload',
    'return_graphql_type' => 'TokenizeUsBankAccountPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Us Bank Account',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeUsBankAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeUsBankAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeUsBankAccountInput!.',
      ],
    ],
  ],
  109 =>
  [
    'operation' => 'tokenizeUsBankLogin',
    'slug' => 'braintree_tokenize_us_bank_login',
    'class' => 'BraintreeTokenizeUsBankLogin',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'tokenizeUsBankLogin',
    'return_type' => 'TokenizeUsBankAccountPayload',
    'return_graphql_type' => 'TokenizeUsBankAccountPayload',
    'returns_scalar' => false,
    'name' => 'Tokenize Us Bank Login',
    'description' => 'Execute official Braintree GraphQL mutation field `tokenizeUsBankLogin`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'TokenizeUsBankLoginInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type TokenizeUsBankLoginInput!.',
      ],
    ],
  ],
  110 =>
  [
    'operation' => 'unregisterApplePayDomain',
    'slug' => 'braintree_unregister_apple_pay_domain',
    'class' => 'BraintreeUnregisterApplePayDomain',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'unregisterApplePayDomain',
    'return_type' => 'UnregisterApplePayDomainPayload',
    'return_graphql_type' => 'UnregisterApplePayDomainPayload',
    'returns_scalar' => false,
    'name' => 'Unregister Apple Pay Domain',
    'description' => 'Execute official Braintree GraphQL mutation field `unregisterApplePayDomain`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UnregisterApplePayDomainInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UnregisterApplePayDomainInput!.',
      ],
    ],
  ],
  111 =>
  [
    'operation' => 'updateCreditCardBillingAddress',
    'slug' => 'braintree_update_credit_card_billing_address',
    'class' => 'BraintreeUpdateCreditCardBillingAddress',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateCreditCardBillingAddress',
    'return_type' => 'UpdateCreditCardBillingAddressPayload',
    'return_graphql_type' => 'UpdateCreditCardBillingAddressPayload',
    'returns_scalar' => false,
    'name' => 'Update Credit Card Billing Address',
    'description' => 'Execute official Braintree GraphQL mutation field `updateCreditCardBillingAddress`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateCreditCardBillingAddressInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateCreditCardBillingAddressInput!.',
      ],
    ],
  ],
  112 =>
  [
    'operation' => 'updateCreditCardCardholderName',
    'slug' => 'braintree_update_credit_card_cardholder_name',
    'class' => 'BraintreeUpdateCreditCardCardholderName',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateCreditCardCardholderName',
    'return_type' => 'UpdateCreditCardCardholderNamePayload',
    'return_graphql_type' => 'UpdateCreditCardCardholderNamePayload',
    'returns_scalar' => false,
    'name' => 'Update Credit Card Cardholder Name',
    'description' => 'Execute official Braintree GraphQL mutation field `updateCreditCardCardholderName`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateCreditCardCardholderNameInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateCreditCardCardholderNameInput!.',
      ],
    ],
  ],
  113 =>
  [
    'operation' => 'updateCreditCardExpirationDate',
    'slug' => 'braintree_update_credit_card_expiration_date',
    'class' => 'BraintreeUpdateCreditCardExpirationDate',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateCreditCardExpirationDate',
    'return_type' => 'UpdateCreditCardExpirationDatePayload',
    'return_graphql_type' => 'UpdateCreditCardExpirationDatePayload',
    'returns_scalar' => false,
    'name' => 'Update Credit Card Expiration Date',
    'description' => 'Execute official Braintree GraphQL mutation field `updateCreditCardExpirationDate`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateCreditCardExpirationDateInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateCreditCardExpirationDateInput!.',
      ],
    ],
  ],
  114 =>
  [
    'operation' => 'updateCustomFields',
    'slug' => 'braintree_update_custom_fields',
    'class' => 'BraintreeUpdateCustomFields',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateCustomFields',
    'return_type' => 'UpdateCustomFieldsPayload',
    'return_graphql_type' => 'UpdateCustomFieldsPayload',
    'returns_scalar' => false,
    'name' => 'Update Custom Fields',
    'description' => 'Execute official Braintree GraphQL mutation field `updateCustomFields`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateCustomFieldsInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateCustomFieldsInput!.',
      ],
    ],
  ],
  115 =>
  [
    'operation' => 'updateCustomer',
    'slug' => 'braintree_update_customer',
    'class' => 'BraintreeUpdateCustomer',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateCustomer',
    'return_type' => 'UpdateCustomerPayload',
    'return_graphql_type' => 'UpdateCustomerPayload',
    'returns_scalar' => false,
    'name' => 'Update Customer',
    'description' => 'Execute official Braintree GraphQL mutation field `updateCustomer`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateCustomerInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateCustomerInput!.',
      ],
    ],
  ],
  116 =>
  [
    'operation' => 'updateEmvCaptureData',
    'slug' => 'braintree_update_emv_capture_data',
    'class' => 'BraintreeUpdateEmvCaptureData',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateEmvCaptureData',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Update Emv Capture Data',
    'description' => 'Execute official Braintree GraphQL mutation field `updateEmvCaptureData`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateEmvCaptureDataInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateEmvCaptureDataInput!.',
      ],
    ],
  ],
  117 =>
  [
    'operation' => 'updateInStoreLocation',
    'slug' => 'braintree_update_in_store_location',
    'class' => 'BraintreeUpdateInStoreLocation',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateInStoreLocation',
    'return_type' => 'UpdateInStoreLocationPayload',
    'return_graphql_type' => 'UpdateInStoreLocationPayload',
    'returns_scalar' => false,
    'name' => 'Update In Store Location',
    'description' => 'Execute official Braintree GraphQL mutation field `updateInStoreLocation`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateInStoreLocationInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateInStoreLocationInput!.',
      ],
    ],
  ],
  118 =>
  [
    'operation' => 'updateInStoreReader',
    'slug' => 'braintree_update_in_store_reader',
    'class' => 'BraintreeUpdateInStoreReader',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateInStoreReader',
    'return_type' => 'InStoreReaderPayload',
    'return_graphql_type' => 'InStoreReaderPayload',
    'returns_scalar' => false,
    'name' => 'Update In Store Reader',
    'description' => 'Execute official Braintree GraphQL mutation field `updateInStoreReader`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateInStoreReaderInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateInStoreReaderInput!.',
      ],
    ],
  ],
  119 =>
  [
    'operation' => 'updatePayPalOneTimePayment',
    'slug' => 'braintree_update_pay_pal_one_time_payment',
    'class' => 'BraintreeUpdatePayPalOneTimePayment',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updatePayPalOneTimePayment',
    'return_type' => 'UpdatePayPalOneTimePaymentPayload',
    'return_graphql_type' => 'UpdatePayPalOneTimePaymentPayload',
    'returns_scalar' => false,
    'name' => 'Update Pay Pal One Time Payment',
    'description' => 'Execute official Braintree GraphQL mutation field `updatePayPalOneTimePayment`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdatePayPalOneTimePaymentInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdatePayPalOneTimePaymentInput!.',
      ],
    ],
  ],
  120 =>
  [
    'operation' => 'updateRecurringBillingSubscriptionPlan',
    'slug' => 'braintree_update_recurring_billing_subscription_plan',
    'class' => 'BraintreeUpdateRecurringBillingSubscriptionPlan',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateRecurringBillingSubscriptionPlan',
    'return_type' => 'RecurringBillingSubscriptionPlanPayload',
    'return_graphql_type' => 'RecurringBillingSubscriptionPlanPayload',
    'returns_scalar' => false,
    'name' => 'Update Recurring Billing Subscription Plan',
    'description' => 'Execute official Braintree GraphQL mutation field `updateRecurringBillingSubscriptionPlan`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateRecurringBillingSubscriptionPlanInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateRecurringBillingSubscriptionPlanInput!.',
      ],
    ],
  ],
  121 =>
  [
    'operation' => 'updateTransactionAmount',
    'slug' => 'braintree_update_transaction_amount',
    'class' => 'BraintreeUpdateTransactionAmount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateTransactionAmount',
    'return_type' => 'TransactionPayload',
    'return_graphql_type' => 'TransactionPayload',
    'returns_scalar' => false,
    'name' => 'Update Transaction Amount',
    'description' => 'Execute official Braintree GraphQL mutation field `updateTransactionAmount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateTransactionAmountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateTransactionAmountInput!.',
      ],
    ],
  ],
  122 =>
  [
    'operation' => 'updateTransactionCustomFields',
    'slug' => 'braintree_update_transaction_custom_fields',
    'class' => 'BraintreeUpdateTransactionCustomFields',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'updateTransactionCustomFields',
    'return_type' => 'UpdateTransactionCustomFieldsPayload',
    'return_graphql_type' => 'UpdateTransactionCustomFieldsPayload',
    'returns_scalar' => false,
    'name' => 'Update Transaction Custom Fields',
    'description' => 'Execute official Braintree GraphQL mutation field `updateTransactionCustomFields`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'UpdateTransactionCustomFieldsInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type UpdateTransactionCustomFieldsInput!.',
      ],
    ],
  ],
  123 =>
  [
    'operation' => 'vaultCreditCard',
    'slug' => 'braintree_vault_credit_card',
    'class' => 'BraintreeVaultCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'vaultCreditCard',
    'return_type' => 'VaultPaymentMethodPayload',
    'return_graphql_type' => 'VaultPaymentMethodPayload',
    'returns_scalar' => false,
    'name' => 'Vault Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `vaultCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VaultCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VaultCreditCardInput!.',
      ],
    ],
  ],
  124 =>
  [
    'operation' => 'vaultPayPalBillingAgreement',
    'slug' => 'braintree_vault_pay_pal_billing_agreement',
    'class' => 'BraintreeVaultPayPalBillingAgreement',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'vaultPayPalBillingAgreement',
    'return_type' => 'VaultPayPalBillingAgreementPayload',
    'return_graphql_type' => 'VaultPayPalBillingAgreementPayload',
    'returns_scalar' => false,
    'name' => 'Vault Pay Pal Billing Agreement',
    'description' => 'Execute official Braintree GraphQL mutation field `vaultPayPalBillingAgreement`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VaultPayPalBillingAgreementInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VaultPayPalBillingAgreementInput!.',
      ],
    ],
  ],
  125 =>
  [
    'operation' => 'vaultPaymentMethod',
    'slug' => 'braintree_vault_payment_method',
    'class' => 'BraintreeVaultPaymentMethod',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'vaultPaymentMethod',
    'return_type' => 'VaultPaymentMethodPayload',
    'return_graphql_type' => 'VaultPaymentMethodPayload',
    'returns_scalar' => false,
    'name' => 'Vault Payment Method',
    'description' => 'Execute official Braintree GraphQL mutation field `vaultPaymentMethod`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VaultPaymentMethodInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VaultPaymentMethodInput!.',
      ],
    ],
  ],
  126 =>
  [
    'operation' => 'vaultUsBankAccount',
    'slug' => 'braintree_vault_us_bank_account',
    'class' => 'BraintreeVaultUsBankAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'vaultUsBankAccount',
    'return_type' => 'VaultPaymentMethodPayload',
    'return_graphql_type' => 'VaultPaymentMethodPayload',
    'returns_scalar' => false,
    'name' => 'Vault Us Bank Account',
    'description' => 'Execute official Braintree GraphQL mutation field `vaultUsBankAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VaultUsBankAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VaultUsBankAccountInput!.',
      ],
    ],
  ],
  127 =>
  [
    'operation' => 'verifyCreditCard',
    'slug' => 'braintree_verify_credit_card',
    'class' => 'BraintreeVerifyCreditCard',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'verifyCreditCard',
    'return_type' => 'VerifyPaymentMethodPayload',
    'return_graphql_type' => 'VerifyPaymentMethodPayload',
    'returns_scalar' => false,
    'name' => 'Verify Credit Card',
    'description' => 'Execute official Braintree GraphQL mutation field `verifyCreditCard`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VerifyCreditCardInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VerifyCreditCardInput!.',
      ],
    ],
  ],
  128 =>
  [
    'operation' => 'verifyPaymentMethod',
    'slug' => 'braintree_verify_payment_method',
    'class' => 'BraintreeVerifyPaymentMethod',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'verifyPaymentMethod',
    'return_type' => 'VerifyPaymentMethodPayload',
    'return_graphql_type' => 'VerifyPaymentMethodPayload',
    'returns_scalar' => false,
    'name' => 'Verify Payment Method',
    'description' => 'Execute official Braintree GraphQL mutation field `verifyPaymentMethod`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VerifyPaymentMethodInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VerifyPaymentMethodInput!.',
      ],
    ],
  ],
  129 =>
  [
    'operation' => 'verifyUsBankAccount',
    'slug' => 'braintree_verify_us_bank_account',
    'class' => 'BraintreeVerifyUsBankAccount',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'verifyUsBankAccount',
    'return_type' => 'VerifyPaymentMethodPayload',
    'return_graphql_type' => 'VerifyPaymentMethodPayload',
    'returns_scalar' => false,
    'name' => 'Verify Us Bank Account',
    'description' => 'Execute official Braintree GraphQL mutation field `verifyUsBankAccount`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VerifyUsBankAccountInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VerifyUsBankAccountInput!.',
      ],
    ],
  ],
  130 =>
  [
    'operation' => 'voidTransaction',
    'slug' => 'braintree_void_transaction',
    'class' => 'BraintreeVoidTransaction',
    'scope' => 'root',
    'graphql_kind' => 'mutation',
    'field' => 'voidTransaction',
    'return_type' => 'VoidTransactionPayload',
    'return_graphql_type' => 'VoidTransactionPayload',
    'returns_scalar' => false,
    'name' => 'Void Transaction',
    'description' => 'Execute official Braintree GraphQL mutation field `voidTransaction`.',
    'type' => 'write',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'input',
        'param' => 'input',
        'graphql_type' => 'VoidTransactionInput!',
        'type' => 'object',
        'required' => true,
        'description' => 'GraphQL variable `input` of type VoidTransactionInput!.',
      ],
    ],
  ],
];
    }
}
