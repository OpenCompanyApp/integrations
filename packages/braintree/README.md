# Braintree Integration

Official Braintree GraphQL API integration for OpenCompany and KosmoKrator agents.

This package is generated from Braintree's official `graphql-api` schema repository. It exposes root queries, root mutations, and first-level `search` and `report` fields from the schema as individual tools. Object-returning tools accept a `selection` string so agents can request the exact fields they need without this package inventing incomplete payload shapes.

## Authentication

Use either `public_key` plus `private_key` for Basic authentication, or `access_token` for OAuth bearer authentication. The default endpoint is the sandbox GraphQL endpoint. Set `url` to `https://payments.braintree-api.com/graphql` for production.

## Tool Shape

GraphQL variables are exposed as snake_case tool parameters. Complex mutation inputs are passed as `input`. Object results default to `__typename`; pass `selection` for useful fields, including inline fragments for interfaces and unions.

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

Additional operations are available through the provider catalog.