# Braintree JavaScript Tools

Namespace: `braintree`

The Braintree integration exposes generated tools from the official Braintree GraphQL schema. Coverage includes root query fields, root mutation fields, and the first-level `search` and `report` query collections.

## Auth

Configure either `public_key` and `private_key`, or an OAuth `access_token`. Use `url = "https://payments.braintree-api.com/graphql"` for production.

## Selection Sets

Most GraphQL fields return objects, interfaces, unions, payloads, or connections. Pass `selection` to control the returned fields. When omitted, object results request `__typename` only.

```js
var merchant = app.integrations.braintree.viewer({
  selection: "merchant { id status companyName } user { id email name }",
})

var transactions = app.integrations.braintree.search_transactions({
  input: {},
  first: 10,
  selection: "edges { node { id legacyId status amount { value currencyCode } } } pageInfo { hasNextPage endCursor }",
})

var refund = app.integrations.braintree.refund_transaction({
  input: { transactionId: "gid://braintree/Transaction/example", amount: "10.00" },
  selection: "refund { id legacyId status amount { value currencyCode } }",
})
```
## Common Tools

| Tool | GraphQL Field | Return |
|------|---------------|--------|
| `braintree_report_payment_level_fees` | query `report.paymentLevelFees` | PaymentLevelFeeReport |
| `braintree_report_transaction_level_fees` | query `report.transactionLevelFees` | TransactionLevelFeeReport |
| `braintree_apple_pay_registered_domains` | query `root.applePayRegisteredDomains` | ApplePayRegisteredDomainsPayload |
| `braintree_client_configuration` | query `root.clientConfiguration` | ClientConfiguration |
| `braintree_id_from_legacy_id` | query `root.idFromLegacyId` | ID |
| `braintree_ids_from_legacy_ids` | query `root.idsFromLegacyIds` | ID |
| `braintree_in_store_locations` | query `root.inStoreLocations` | InStoreLocationConnection |
| `braintree_node` | query `root.node` | Node |
| `braintree_paypal_billing_agreement_details` | query `root.paypalBillingAgreementDetails` | PayPalBillingAgreementDetailsPayload |
| `braintree_paypal_order_details` | query `root.paypalOrderDetails` | PayPalOrderDetailsPayload |
| `braintree_ping` | query `root.ping` | String |
| `braintree_ping_in_store_reader` | query `root.pingInStoreReader` | InStoreReader |
| `braintree_recurring_billing_subscription_plan_add_ons` | query `root.recurringBillingSubscriptionPlanAddOns` | RecurringBillingSubscriptionPlanAddOnsPayload |
| `braintree_recurring_billing_subscription_plan_discounts` | query `root.recurringBillingSubscriptionPlanDiscounts` | RecurringBillingSubscriptionPlanDiscountsPayload |
| `braintree_recurring_billing_subscription_plans` | query `root.recurringBillingSubscriptionPlans` | RecurringBillingSubscriptionPlansPayload |
| `braintree_viewer` | query `root.viewer` | Viewer |
| `braintree_search_business_account_creation_requests` | query `search.businessAccountCreationRequests` | BusinessAccountCreationRequestConnection |
| `braintree_search_customers` | query `search.customers` | CustomerConnection |
| `braintree_search_disputes` | query `search.disputes` | DisputeConnection |
| `braintree_search_in_store_locations` | query `search.inStoreLocations` | InStoreLocationSearchConnection |
| `braintree_search_in_store_readers` | query `search.inStoreReaders` | InStoreReaderConnection |
| `braintree_search_payments` | query `search.payments` | PaymentConnection |
| `braintree_search_refunds` | query `search.refunds` | RefundConnection |
| `braintree_search_roles` | query `search.roles` | RoleSearchConnection |
| `braintree_search_transactions` | query `search.transactions` | TransactionConnection |
| `braintree_search_verifications` | query `search.verifications` | VerificationConnection |
| `braintree_accept_dispute` | mutation `root.acceptDispute` | AcceptDisputePayload |
| `braintree_authorize_credit_card` | mutation `root.authorizeCreditCard` | TransactionPayload |
| `braintree_authorize_in_store_credit_card` | mutation `root.authorizeInStoreCreditCard` | TransactionPayload |
| `braintree_authorize_pay_pal_account` | mutation `root.authorizePayPalAccount` | PayPalTransactionPayload |
| `braintree_authorize_payment_method` | mutation `root.authorizePaymentMethod` | TransactionPayload |
| `braintree_authorize_venmo_account` | mutation `root.authorizeVenmoAccount` | TransactionPayload |
| `braintree_capture_transaction` | mutation `root.captureTransaction` | TransactionPayload |
| `braintree_charge_credit_card` | mutation `root.chargeCreditCard` | TransactionPayload |
| `braintree_charge_in_store_credit_card` | mutation `root.chargeInStoreCreditCard` | TransactionPayload |
| `braintree_charge_pay_pal_account` | mutation `root.chargePayPalAccount` | PayPalTransactionPayload |
| `braintree_charge_payment_method` | mutation `root.chargePaymentMethod` | TransactionPayload |
| `braintree_charge_us_bank_account` | mutation `root.chargeUsBankAccount` | TransactionPayload |
| `braintree_charge_venmo_account` | mutation `root.chargeVenmoAccount` | TransactionPayload |
| `braintree_confirm_micro_transfer_amounts` | mutation `root.confirmMicroTransferAmounts` | ConfirmMicroTransferAmountsPayload |
| `braintree_create_apple_pay_web_session` | mutation `root.createApplePayWebSession` | CreateApplePayWebSessionPayload |
| `braintree_create_billing_agreement_jwt` | mutation `root.createBillingAgreementJwt` | CreateBillingAgreementJwtPayload |
| `braintree_create_client_token` | mutation `root.createClientToken` | CreateClientTokenPayload |
| `braintree_create_customer` | mutation `root.createCustomer` | CreateCustomerPayload |
| `braintree_create_dispute_file_evidence` | mutation `root.createDisputeFileEvidence` | CreateDisputeFileEvidencePayload |
| `braintree_create_dispute_text_evidence` | mutation `root.createDisputeTextEvidence` | CreateDisputeTextEvidencePayload |
| `braintree_create_in_store_location` | mutation `root.createInStoreLocation` | CreateInStoreLocationPayload |
| `braintree_create_local_payment_context` | mutation `root.createLocalPaymentContext` | CreateLocalPaymentContextPayload |
| `braintree_create_non_instant_local_payment_context` | mutation `root.createNonInstantLocalPaymentContext` | CreateNonInstantLocalPaymentContextPayload |
| `braintree_create_oauth_client_secret` | mutation `root.createOAuthClientSecret` | CreateOAuthClientSecretPayload |
| `braintree_create_offline_declined_transaction` | mutation `root.createOfflineDeclinedTransaction` | TransactionPayload |
| `braintree_create_pay_pal_billing_agreement` | mutation `root.createPayPalBillingAgreement` | CreatePayPalBillingAgreementPayload |
| `braintree_create_pay_pal_one_time_payment` | mutation `root.createPayPalOneTimePayment` | CreatePayPalOneTimePaymentPayload |
| `braintree_create_recurring_billing_subscription_plan` | mutation `root.createRecurringBillingSubscriptionPlan` | RecurringBillingSubscriptionPlanPayload |
| `braintree_create_transaction_package_tracking` | mutation `root.createTransactionPackageTracking` | CreateTransactionPackageTrackingPayload |
| `braintree_create_transaction_risk_context` | mutation `root.createTransactionRiskContext` | TransactionRiskContextPayload |
| `braintree_create_universal_access_token` | mutation `root.createUniversalAccessToken` | CreateUniversalAccessTokenPayload |
| `braintree_create_venmo_payment_context` | mutation `root.createVenmoPaymentContext` | VenmoPaymentContextPayload |
| `braintree_delete_customer` | mutation `root.deleteCustomer` | DeleteCustomerPayload |
| `braintree_delete_dispute_evidence` | mutation `root.deleteDisputeEvidence` | DeleteDisputeEvidencePayload |
| `braintree_delete_in_store_location` | mutation `root.deleteInStoreLocation` | DeleteInStoreLocationPayload |
| `braintree_delete_oauth_client_secret` | mutation `root.deleteOAuthClientSecret` | DeleteOAuthClientSecretPayload |
| `braintree_delete_payment_method_from_single_use_token` | mutation `root.deletePaymentMethodFromSingleUseToken` | DeletePaymentMethodFromSingleUseTokenPayload |
| `braintree_delete_payment_method_from_vault` | mutation `root.deletePaymentMethodFromVault` | DeletePaymentMethodFromVaultPayload |
| `braintree_disable_oauth_client_secret` | mutation `root.disableOAuthClientSecret` | DisableOAuthClientSecretPayload |
| `braintree_evaluate_transaction_risk` | mutation `root.evaluateTransactionRisk` | TransactionRiskEvaluatePayload |
| `braintree_finalize_dispute` | mutation `root.finalizeDispute` | FinalizeDisputePayload |
| `braintree_generate_edit_funding_instrument_url` | mutation `root.generateEditFundingInstrumentUrl` | GenerateEditFundingInstrumentUrlPayload |
| `braintree_generate_exchange_rate_quote` | mutation `root.generateExchangeRateQuote` | ExchangeRateQuotePayload |
| `braintree_pair_in_store_reader` | mutation `root.pairInStoreReader` | InStoreReaderPayload |
| `braintree_partial_capture_transaction` | mutation `root.partialCaptureTransaction` | PartialCaptureTransactionPayload |
| `braintree_perform_three_dsecure_lookup` | mutation `root.performThreeDSecureLookup` | PerformThreeDSecureLookupPayload |
| `braintree_refund_credit_card` | mutation `root.refundCreditCard` | RefundCreditCardPayload |
| `braintree_refund_in_store_credit_card` | mutation `root.refundInStoreCreditCard` | RefundCreditCardPayload |
| `braintree_refund_transaction` | mutation `root.refundTransaction` | RefundTransactionPayload |
| `braintree_refund_us_bank_account` | mutation `root.refundUsBankAccount` | RefundUsBankAccountPayload |
| `braintree_register_apple_pay_domains` | mutation `root.registerApplePayDomains` | RegisterApplePayDomainsPayload |
| `braintree_request_amount_prompt_from_in_store_reader` | mutation `root.requestAmountPromptFromInStoreReader` | InStoreContextPayload |
| `braintree_request_authorize_from_in_store_reader` | mutation `root.requestAuthorizeFromInStoreReader` | InStoreContextPayload |
| `braintree_request_cancel_from_in_store_reader` | mutation `root.requestCancelFromInStoreReader` | InStoreContextPayload |

The full generated catalog contains all root operation fields and first-level search/report fields from Braintree's official schema.