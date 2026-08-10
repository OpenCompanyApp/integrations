<?php

namespace OpenCompany\Integrations\Airwallex;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexAuthenticationObtainAccessToken;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateABillingCustomer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingUpdateABillingCustomer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingRetrieveABillingCustomer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfBllingCustomers;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateAProduct;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingUpdateAProduct;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingRetrieveAProduct;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfProducts;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateAPricePerUnitOneOff;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingUpdateAPrice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingRetrieveAPrice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfPrices;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateABillingCheckoutPayment;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingUpdateABillingCheckout;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingRetrieveABillingCheckout;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfBillingCheckouts;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCancelABillingCheckout;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateAnInvoice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingPreviewAnInvoice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingUpdateAnInvoice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingDeleteADraftInvoice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingRetrieveAnInvoice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfInvoices;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingFinalizeAnInvoice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingMarkAnInvoiceAsPaid;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingVoidAnInvoice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateInvoiceLineItemsAndAddThemToAnInvoice;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfInvoicesLineItems;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetABillingTransaction;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetAListOfBillingTransactions;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateACoupon;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingUpdateACoupon;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetACoupon;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfCoupons;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateAPaymentSource;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetAPaymentSource;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfPaymentSources;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateAMeter;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingUpdateAMeter;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingRetrieveAMeter;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingArchiveAMeter;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingRestoreAMeter;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfMeters;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetSummariesOfAMeter;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingIngestAUsageEvent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingBatchIngestUsageEvents;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingVoidAUsageEvent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateASubscriptionCheckout;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingRetrieveASubscription;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingUpdateASubscription;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCancelASubscription;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfSubscriptions;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetAuthorizationStatus;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetSingleAuthorizationStatus;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingCreateACardholder;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetAllCardholders;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetCardholderDetails;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingUpdateACardholder;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingCreateACard;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetAllCards;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetSensitiveCardDetails;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingActivateACard;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetCardDetails;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetCardRemainingLimits;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingUpdateACard;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetIssuingConfig;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingUpdateIssuingConfig;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetTransactions;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexIssuingGetSingleTransaction;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveAvailablePaymentMethodTypes;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveBankNamesForCertainPaymentMethodTypes;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsCreateACustomer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveACustomer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsUpdateACustomer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsGenerateAClientSecretForACustomer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsGetListOfCustomers;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsCreateACustomsDeclaration;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsCreateAFundssplit;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveAFundssplit;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsGetListOfFundssplits;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsReleaseAFundssplit;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveAPaymentattemptById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveListOfPaymentattempts;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsCreateAPaymentconsent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsUpdateAPaymentconsent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsDisableAPaymentconsent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsVerifyAPaymentconsentCard;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsContinueToVerifyAPaymentconsent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsGetAPaymentconsent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsGetListOfPaymentconsents;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsCreateAPaymentintentMvp;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveAPaymentintent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsConfirmAPaymentintentPaymentMethodCard;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsContinueToConfirmAPaymentintent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsCaptureAPaymentintent;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsGetListOfPaymentintents;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsCreateAPaymentmethod;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveAPaymentmethod;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsUpdateAPaymentmethod;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsGetListOfPaymentmethods;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsDisableAPaymentmethod;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsCreateARefund;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsRetrieveARefund;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexOnlinePaymentsGetListOfRefunds;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsGetListOfBeneficiaries;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsGetABeneficiaryById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsCreateANewBeneficiary;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsUpdateExistingBeneficiary;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsValidateBeneficiary;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsDeleteExistingBeneficiary;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsGetTheApiSchema;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsGetTheFormSchema;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsGetListOfPayers;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsCreateANewPayer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsGetAPayerById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsUpdateExistingPayer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsValidatePayer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsDeleteExistingPayer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsCreateANewTransferToBeneficiary;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsGetListOfTransfers;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsGetTransferById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsValidateTransfer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexPayoutsCancelATransfer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingCreateAFinancialReport;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingGetListOfFinancialReports;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingGetFinancialReportById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingGetContentsOfAFinancialReport;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingGetListOfFinancialTransactions;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingGetAFinancialTransactionById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingGetListOfSettlements;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingGetASettlementById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexReportingGetASettlementReportById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleCreateAnAccountInvitationLinkOauth2;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleGetAnAccountInvitationLinkById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleCreateAnAccountBusiness;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleUpdateAConnectedAccount;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleSubmitAccountForActivation;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleAgreeToTermsAndConditions;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleGetAccountById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleGetListOfConnectedAccounts;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleRetrieveAccountDetails;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleCreateANewCharge;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleGetListOfCharges;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleGetAChargeById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleCreateFlow;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleGetFlow;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleAuthorizeFlow;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleCreateANewConnectedAccountTransfer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleGetListOfConnectedAccountTransfers;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleGetAConnectedAccountTransferById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyUpdateStatusOfConnectedAccount;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyFailNextAutocharge;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyCreateAGlobalAccountDeposit;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyRejectADirectDebitDeposit;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyReverseADirectDebitDeposit;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlySettleADirectDebitDeposit;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyCreateATransactionForTheProvidedCard;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyCaptureTheTransactionWithTheProvidedId;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyAcceptAMandate;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyRejectAMandate;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyCancelAMandate;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyFailAMicroDepositsVerification;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyCreateAPaymentdispute;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyResolveAPaymentdispute;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyEscalateAPaymentdispute;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlySimulateAShopperAction;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyTransitionPaymentStatus;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyCreateAnRfi;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyFollowUpRfi;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyCloseAnRfi;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSimulationDemoOnlyTransitionTransferStatus;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSupportingServicesUploadAFile;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSupportingServicesGetOnboardingFileDownloadLinks;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSupportingServicesIndustryCategories;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSupportingServicesInvalidConversionDates;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSupportingServicesSettlementAccounts;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexSupportingServicesSupportedCurrencies;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTransactionalFxCreateAQuote;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTransactionalFxCreateAConversionBuyAmountBased;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTransactionalFxRetrieveASpecificConversion;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTransactionalFxListConversions;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTransactionalFxCreateAnAmendmentQuote;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTransactionalFxRetrieveACurrentRate;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetCurrentBalances;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetBalanceHistory;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetListOfDeposits;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetADepositById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryCreateADepositViaDirectDebit;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryOpenAGlobalAccount;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGenerateGlobalAccountStatementAmazon;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetAListOfGlobalAccounts;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetGlobalAccountById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetGlobalAccountTransactions;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryCreateLinkedBankAccount;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryVerifyLinkedAccountWithMicroDeposits;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetLinkedBankAccounts;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetLinkedBankAccountById;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryUpdateMandateForLba;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryGetMandate;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexTreasuryFundingLimits;

/**
 * Tool catalog and configuration metadata for Airwallex.
 *
 * Exposes the official Airwallex public Postman collection as endpoint-specific
 * tools and resolves account-specific credentials for multi-account hosts.
 */
class AirwallexToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key_with_bearer_token', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => true, 'token_keys' => ['access_token', 'client_id', 'api_key'], 'notes' => ['Airwallex login uses x-client-id and x-api-key. Runtime tools use Authorization: Bearer <access_token>.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'airwallex'; }
    public function appMeta(): array { return ['label' => 'Airwallex', 'description' => 'Payments, billing, issuing, payouts, treasury, FX, reporting, file upload, simulations, and Scale account APIs', 'icon' => 'ph:bank', 'logo' => 'ph:bank']; }
    public function integrationMeta(): array { return ['name' => 'Airwallex', 'description' => 'Manage Airwallex authentication, billing customers, products, invoices, subscriptions, issuing, payment acceptance, payouts, treasury accounts, transactional FX, reports, files, connected accounts, and sandbox simulations.', 'icon' => 'ph:bank', 'logo' => 'ph:bank', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://www.airwallex.com/docs/developer-tools/api', 'source_url' => 'https://www.postman.com/collections/17660841-46716209-3806-4ea0-ac05-e8c3840ff055']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Airwallex bearer access token', 'hint' => 'Sent as Authorization: Bearer <access_token> for runtime API calls.', 'required' => false], ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'placeholder' => 'Airwallex client ID', 'hint' => 'Used by airwallex_authentication_obtain_access_token.', 'required' => false], ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Airwallex API key', 'hint' => 'Used by airwallex_authentication_obtain_access_token.', 'required' => false], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api-demo.airwallex.com', 'default' => 'https://api-demo.airwallex.com'], ['key' => 'file_url', 'type' => 'url', 'label' => 'File API Base URL', 'placeholder' => 'https://files-demo.airwallex.com', 'default' => 'https://files-demo.airwallex.com'], ['key' => 'api_version', 'type' => 'text', 'label' => 'API Version', 'placeholder' => '2025-11-11', 'required' => false], ['key' => 'login_as', 'type' => 'text', 'label' => 'Login As Account', 'placeholder' => 'acct_xxx', 'required' => false], ['key' => 'on_behalf_of', 'type' => 'text', 'label' => 'On Behalf Of Account', 'placeholder' => 'acct_xxx', 'required' => false]]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api-demo.airwallex.com'), '/');
        $accessToken = (string) ($config['access_token'] ?? '');
        $clientId = (string) ($config['client_id'] ?? '');
        $apiKey = (string) ($config['api_key'] ?? '');
        $headers = ['Accept' => 'application/json'];
        if (($config['api_version'] ?? '') !== '') { $headers['x-api-version'] = (string) $config['api_version']; }
        if (($config['login_as'] ?? '') !== '') { $headers['x-login-as'] = (string) $config['login_as']; }
        if (($config['on_behalf_of'] ?? '') !== '') { $headers['x-on-behalf-of'] = (string) $config['on_behalf_of']; }

        try {
            if ($clientId !== '' && $apiKey !== '') {
                $response = Http::withHeaders(array_merge($headers, ['x-client-id' => $clientId, 'x-api-key' => $apiKey]))->timeout(10)->post($baseUrl . '/api/v1/authentication/login');
            } elseif ($accessToken !== '') {
                $response = Http::withHeaders(array_merge($headers, ['Authorization' => 'Bearer ' . $accessToken]))->timeout(10)->get($baseUrl . '/api/v1/account');
            } else {
                return ['success' => false, 'error' => 'Airwallex access token or client ID plus API key are required.'];
            }
            if (!$response->successful()) { return ['success' => false, 'error' => 'Airwallex API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to Airwallex at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'client_id' => 'nullable|string', 'api_key' => 'nullable|string', 'url' => 'nullable|url', 'file_url' => 'nullable|url', 'api_version' => 'nullable|string', 'login_as' => 'nullable|string', 'on_behalf_of' => 'nullable|string']; }
    public function credentialFields(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => false], ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'required' => false], ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false]]; }
    public function tools(): array { return [
            'airwallex_authentication_obtain_access_token' => [
                'class' => AirwallexAuthenticationObtainAccessToken::class,
                'name' => 'Obtain access token',
                'description' => 'Authentication > API Access > Obtain access token.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/authentication/login.',
                'parameters' => [],
            ],
            'airwallex_billing_create_a_billing_customer' => [
                'class' => AirwallexBillingCreateABillingCustomer::class,
                'name' => 'Create a Billing Customer',
                'description' => 'Billing > Billing Customers > Create a Billing Customer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/billing_customers/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_update_a_billing_customer' => [
                'class' => AirwallexBillingUpdateABillingCustomer::class,
                'name' => 'Update a Billing Customer',
                'description' => 'Billing > Billing Customers > Update a Billing Customer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/billing_customers/{billing_customer_id}/update.',
                'parameters' => [
                    'billing_customer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `billing_customer_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_retrieve_a_billing_customer' => [
                'class' => AirwallexBillingRetrieveABillingCustomer::class,
                'name' => 'Retrieve a Billing Customer',
                'description' => 'Billing > Billing Customers > Retrieve a Billing Customer.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_customers/{billing_customer_id}.',
                'parameters' => [
                    'billing_customer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `billing_customer_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_blling_customers' => [
                'class' => AirwallexBillingGetListOfBllingCustomers::class,
                'name' => 'Get list of Blling Customers',
                'description' => 'Billing > Billing Customers > Get list of Blling Customers.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_customers.',
                'parameters' => [],
            ],
            'airwallex_billing_create_a_product' => [
                'class' => AirwallexBillingCreateAProduct::class,
                'name' => 'Create a Product',
                'description' => 'Billing > Products > Create a Product.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/products/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_update_a_product' => [
                'class' => AirwallexBillingUpdateAProduct::class,
                'name' => 'Update a Product',
                'description' => 'Billing > Products > Update a Product.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/products/{product_id}/update.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `product_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_retrieve_a_product' => [
                'class' => AirwallexBillingRetrieveAProduct::class,
                'name' => 'Retrieve a Product',
                'description' => 'Billing > Products > Retrieve a Product.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/products/{product_id}.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `product_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_products' => [
                'class' => AirwallexBillingGetListOfProducts::class,
                'name' => 'Get list of Products',
                'description' => 'Billing > Products > Get list of Products.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/products.',
                'parameters' => [],
            ],
            'airwallex_billing_create_a_price_per_unit_one_off' => [
                'class' => AirwallexBillingCreateAPricePerUnitOneOff::class,
                'name' => 'Create a Price - Per unit one off',
                'description' => 'Billing > Prices > Create a Price - Per unit one off.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/prices/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_update_a_price' => [
                'class' => AirwallexBillingUpdateAPrice::class,
                'name' => 'Update a Price',
                'description' => 'Billing > Prices > Update a Price.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/prices/{price_id}/update.',
                'parameters' => [
                    'price_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `price_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_retrieve_a_price' => [
                'class' => AirwallexBillingRetrieveAPrice::class,
                'name' => 'Retrieve a Price',
                'description' => 'Billing > Prices > Retrieve a Price.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/prices/{price_id}.',
                'parameters' => [
                    'price_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `price_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_prices' => [
                'class' => AirwallexBillingGetListOfPrices::class,
                'name' => 'Get list of Prices',
                'description' => 'Billing > Prices > Get list of Prices.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/prices.',
                'parameters' => [],
            ],
            'airwallex_billing_create_a_billing_checkout_payment' => [
                'class' => AirwallexBillingCreateABillingCheckoutPayment::class,
                'name' => 'Create a Billing Checkout - Payment',
                'description' => 'Billing > Billing Checkouts > Create a Billing Checkout - Payment.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/billing_checkouts/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_update_a_billing_checkout' => [
                'class' => AirwallexBillingUpdateABillingCheckout::class,
                'name' => 'Update a Billing Checkout',
                'description' => 'Billing > Billing Checkouts > Update a Billing Checkout.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/billing_checkouts/{billing_checkout_id}/update.',
                'parameters' => [
                    'billing_checkout_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `billing_checkout_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_retrieve_a_billing_checkout' => [
                'class' => AirwallexBillingRetrieveABillingCheckout::class,
                'name' => 'Retrieve a Billing checkout',
                'description' => 'Billing > Billing Checkouts > Retrieve a Billing checkout.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_checkouts/{billing_checkout_id}.',
                'parameters' => [
                    'billing_checkout_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `billing_checkout_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_billing_checkouts' => [
                'class' => AirwallexBillingGetListOfBillingCheckouts::class,
                'name' => 'Get list of Billing Checkouts',
                'description' => 'Billing > Billing Checkouts > Get list of Billing Checkouts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_checkouts.',
                'parameters' => [],
            ],
            'airwallex_billing_cancel_a_billing_checkout' => [
                'class' => AirwallexBillingCancelABillingCheckout::class,
                'name' => 'Cancel a Billing Checkout',
                'description' => 'Billing > Billing Checkouts > Cancel a Billing Checkout.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/billing_checkouts/{billing_checkout_id}/cancel.',
                'parameters' => [
                    'billing_checkout_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `billing_checkout_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_create_an_invoice' => [
                'class' => AirwallexBillingCreateAnInvoice::class,
                'name' => 'Create an Invoice',
                'description' => 'Billing > Invoices > Create an Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_preview_an_invoice' => [
                'class' => AirwallexBillingPreviewAnInvoice::class,
                'name' => 'Preview an Invoice',
                'description' => 'Billing > Invoices > Preview an Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/preview.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_update_an_invoice' => [
                'class' => AirwallexBillingUpdateAnInvoice::class,
                'name' => 'Update an Invoice',
                'description' => 'Billing > Invoices > Update an Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/{invoice_id}/update.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invoice_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_delete_a_draft_invoice' => [
                'class' => AirwallexBillingDeleteADraftInvoice::class,
                'name' => 'Delete a Draft Invoice',
                'description' => 'Billing > Invoices > Delete a Draft Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/{invoice_id}/delete.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invoice_id`.',
                    ],
                ],
            ],
            'airwallex_billing_retrieve_an_invoice' => [
                'class' => AirwallexBillingRetrieveAnInvoice::class,
                'name' => 'Retrieve an Invoice',
                'description' => 'Billing > Invoices > Retrieve an Invoice.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/invoices/{invoice_id}.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invoice_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_invoices' => [
                'class' => AirwallexBillingGetListOfInvoices::class,
                'name' => 'Get list of Invoices',
                'description' => 'Billing > Invoices > Get list of Invoices.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/invoices.',
                'parameters' => [],
            ],
            'airwallex_billing_finalize_an_invoice' => [
                'class' => AirwallexBillingFinalizeAnInvoice::class,
                'name' => 'Finalize an Invoice',
                'description' => 'Billing > Invoices > Finalize an Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/{invoice_id}/finalize.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invoice_id`.',
                    ],
                ],
            ],
            'airwallex_billing_mark_an_invoice_as_paid' => [
                'class' => AirwallexBillingMarkAnInvoiceAsPaid::class,
                'name' => 'Mark an Invoice as Paid',
                'description' => 'Billing > Invoices > Mark an Invoice as Paid.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/{invoice_id}/mark_as_paid.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invoice_id`.',
                    ],
                ],
            ],
            'airwallex_billing_void_an_invoice' => [
                'class' => AirwallexBillingVoidAnInvoice::class,
                'name' => 'Void an Invoice',
                'description' => 'Billing > Invoices > Void an Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/{invoice_id}/void.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invoice_id`.',
                    ],
                ],
            ],
            'airwallex_billing_create_invoice_line_items_and_add_them_to_an_invoice' => [
                'class' => AirwallexBillingCreateInvoiceLineItemsAndAddThemToAnInvoice::class,
                'name' => 'Create Invoice Line Items and add them to an Invoice',
                'description' => 'Billing > Invoices > Create Invoice Line Items and add them to an Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/{invoice_id}/add_line_items.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invoice_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_invoices_line_items' => [
                'class' => AirwallexBillingGetListOfInvoicesLineItems::class,
                'name' => 'Get list of Invoices Line Items',
                'description' => 'Billing > Invoices > Get list of Invoices Line Items.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/invoices/{invoice_id}/line_items.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invoice_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_a_billing_transaction' => [
                'class' => AirwallexBillingGetABillingTransaction::class,
                'name' => 'Get a Billing Transaction',
                'description' => 'Billing > Billing Transactions > Get a Billing Transaction.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_transactions/{billing_transaction_id}.',
                'parameters' => [
                    'billing_transaction_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `billing_transaction_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_a_list_of_billing_transactions' => [
                'class' => AirwallexBillingGetAListOfBillingTransactions::class,
                'name' => 'Get a list of Billing Transactions',
                'description' => 'Billing > Billing Transactions > Get a list of Billing Transactions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_transactions.',
                'parameters' => [
                    'invoice_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Query parameter `invoice_id`.',
                    ],
                ],
            ],
            'airwallex_billing_create_a_coupon' => [
                'class' => AirwallexBillingCreateACoupon::class,
                'name' => 'Create a Coupon',
                'description' => 'Billing > Coupons > Create a Coupon.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/coupons/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_update_a_coupon' => [
                'class' => AirwallexBillingUpdateACoupon::class,
                'name' => 'Update a Coupon',
                'description' => 'Billing > Coupons > Update a Coupon.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/coupons/{coupon_id}/update.',
                'parameters' => [
                    'coupon_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `coupon_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_get_a_coupon' => [
                'class' => AirwallexBillingGetACoupon::class,
                'name' => 'Get a Coupon',
                'description' => 'Billing > Coupons > Get a Coupon.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/coupons/{coupon_id}.',
                'parameters' => [
                    'coupon_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `coupon_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_coupons' => [
                'class' => AirwallexBillingGetListOfCoupons::class,
                'name' => 'Get list of Coupons',
                'description' => 'Billing > Coupons > Get list of Coupons.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/coupons.',
                'parameters' => [],
            ],
            'airwallex_billing_create_a_payment_source' => [
                'class' => AirwallexBillingCreateAPaymentSource::class,
                'name' => 'Create a Payment Source',
                'description' => 'Billing > Payment Sources > Create a Payment Source.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/payment_sources/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_get_a_payment_source' => [
                'class' => AirwallexBillingGetAPaymentSource::class,
                'name' => 'Get a Payment Source',
                'description' => 'Billing > Payment Sources > Get a Payment Source.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/payment_sources/{payment_source_id}.',
                'parameters' => [
                    'payment_source_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_source_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_payment_sources' => [
                'class' => AirwallexBillingGetListOfPaymentSources::class,
                'name' => 'Get List of Payment Sources',
                'description' => 'Billing > Payment Sources > Get List of Payment Sources.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/payment_sources.',
                'parameters' => [],
            ],
            'airwallex_billing_create_a_meter' => [
                'class' => AirwallexBillingCreateAMeter::class,
                'name' => 'Create a Meter',
                'description' => 'Billing > Meters > Create a Meter.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/meters/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_update_a_meter' => [
                'class' => AirwallexBillingUpdateAMeter::class,
                'name' => 'Update a Meter',
                'description' => 'Billing > Meters > Update a Meter.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/meters/{meter_id}/update.',
                'parameters' => [
                    'meter_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `meter_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_retrieve_a_meter' => [
                'class' => AirwallexBillingRetrieveAMeter::class,
                'name' => 'Retrieve a Meter',
                'description' => 'Billing > Meters > Retrieve a Meter.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/meters/{meter_id}.',
                'parameters' => [
                    'meter_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `meter_id`.',
                    ],
                ],
            ],
            'airwallex_billing_archive_a_meter' => [
                'class' => AirwallexBillingArchiveAMeter::class,
                'name' => 'Archive a Meter',
                'description' => 'Billing > Meters > Archive a Meter.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/meters/{meter_id}/archive.',
                'parameters' => [
                    'meter_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `meter_id`.',
                    ],
                ],
            ],
            'airwallex_billing_restore_a_meter' => [
                'class' => AirwallexBillingRestoreAMeter::class,
                'name' => 'Restore a Meter',
                'description' => 'Billing > Meters > Restore a Meter.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/meters/{meter_id}/restore.',
                'parameters' => [
                    'meter_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `meter_id`.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_meters' => [
                'class' => AirwallexBillingGetListOfMeters::class,
                'name' => 'Get list of Meters',
                'description' => 'Billing > Meters > Get list of Meters.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/meters.',
                'parameters' => [],
            ],
            'airwallex_billing_get_summaries_of_a_meter' => [
                'class' => AirwallexBillingGetSummariesOfAMeter::class,
                'name' => 'Get summaries of a Meter',
                'description' => 'Billing > Meters > Get summaries of a Meter.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/meters/{meter_id}/summaries.',
                'parameters' => [
                    'meter_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `meter_id`.',
                    ],
                    'billing_customer_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Query parameter `billing_customer_id`.',
                    ],
                    'from_happened_at' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Query parameter `from_happened_at`.',
                    ],
                    'to_happened_at' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Query parameter `to_happened_at`.',
                    ],
                ],
            ],
            'airwallex_billing_ingest_a_usage_event' => [
                'class' => AirwallexBillingIngestAUsageEvent::class,
                'name' => 'Ingest a Usage Event',
                'description' => 'Billing > Usage Events > Ingest a Usage Event.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/usage_events/ingest.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_batch_ingest_usage_events' => [
                'class' => AirwallexBillingBatchIngestUsageEvents::class,
                'name' => 'Batch Ingest Usage Events',
                'description' => 'Billing > Usage Events > Batch Ingest Usage Events.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/usage_events/batch_ingest.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_void_a_usage_event' => [
                'class' => AirwallexBillingVoidAUsageEvent::class,
                'name' => 'Void a Usage Event',
                'description' => 'Billing > Usage Events > Void a Usage Event.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/usage_events/void.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_create_a_subscription_checkout' => [
                'class' => AirwallexBillingCreateASubscriptionCheckout::class,
                'name' => 'Create a Subscription - Checkout',
                'description' => 'Billing > Subscriptions > Create a Subscription - Checkout.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/subscriptions/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_retrieve_a_subscription' => [
                'class' => AirwallexBillingRetrieveASubscription::class,
                'name' => 'Retrieve a Subscription',
                'description' => 'Billing > Subscriptions > Retrieve a Subscription.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/subscriptions/{subscription_id}.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `subscription_id`.',
                    ],
                ],
            ],
            'airwallex_billing_update_a_subscription' => [
                'class' => AirwallexBillingUpdateASubscription::class,
                'name' => 'Update a Subscription',
                'description' => 'Billing > Subscriptions > Update a Subscription.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/subscriptions/{subscription_id}/update.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `subscription_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_cancel_a_subscription' => [
                'class' => AirwallexBillingCancelASubscription::class,
                'name' => 'Cancel a Subscription',
                'description' => 'Billing > Subscriptions > Cancel a Subscription.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/subscriptions/{subscription_id}/cancel.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `subscription_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_billing_get_list_of_subscriptions' => [
                'class' => AirwallexBillingGetListOfSubscriptions::class,
                'name' => 'Get list of Subscriptions',
                'description' => 'Billing > Subscriptions > Get list of Subscriptions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/subscriptions.',
                'parameters' => [],
            ],
            'airwallex_issuing_get_authorization_status' => [
                'class' => AirwallexIssuingGetAuthorizationStatus::class,
                'name' => 'Get authorization status',
                'description' => 'Issuing > Authorizations > Get authorization status.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/authorizations.',
                'parameters' => [],
            ],
            'airwallex_issuing_get_single_authorization_status' => [
                'class' => AirwallexIssuingGetSingleAuthorizationStatus::class,
                'name' => 'Get single authorization status',
                'description' => 'Issuing > Authorizations > Get single authorization status.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/authorizations/{issuing_transaction_id}.',
                'parameters' => [
                    'issuing_transaction_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `issuing_transaction_id`.',
                    ],
                ],
            ],
            'airwallex_issuing_create_a_cardholder' => [
                'class' => AirwallexIssuingCreateACardholder::class,
                'name' => 'Create a cardholder',
                'description' => 'Issuing > Cardholders > Create a cardholder.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cardholders/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_issuing_get_all_cardholders' => [
                'class' => AirwallexIssuingGetAllCardholders::class,
                'name' => 'Get all cardholders',
                'description' => 'Issuing > Cardholders > Get all cardholders.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/cardholders.',
                'parameters' => [],
            ],
            'airwallex_issuing_get_cardholder_details' => [
                'class' => AirwallexIssuingGetCardholderDetails::class,
                'name' => 'Get cardholder details',
                'description' => 'Issuing > Cardholders > Get cardholder details.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/cardholders/{cardholder_id}.',
                'parameters' => [
                    'cardholder_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `cardholder_id`.',
                    ],
                ],
            ],
            'airwallex_issuing_update_a_cardholder' => [
                'class' => AirwallexIssuingUpdateACardholder::class,
                'name' => 'Update a cardholder',
                'description' => 'Issuing > Cardholders > Update a cardholder.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cardholders/{cardholder_id}/update.',
                'parameters' => [
                    'cardholder_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `cardholder_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_issuing_create_a_card' => [
                'class' => AirwallexIssuingCreateACard::class,
                'name' => 'Create a card',
                'description' => 'Issuing > Cards > Create a card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cards/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_issuing_get_all_cards' => [
                'class' => AirwallexIssuingGetAllCards::class,
                'name' => 'Get all cards',
                'description' => 'Issuing > Cards > Get all cards.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/cards.',
                'parameters' => [],
            ],
            'airwallex_issuing_get_sensitive_card_details' => [
                'class' => AirwallexIssuingGetSensitiveCardDetails::class,
                'name' => 'Get sensitive card details',
                'description' => 'Issuing > Cards > Get sensitive card details.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/cards/{card_id}/details.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `card_id`.',
                    ],
                ],
            ],
            'airwallex_issuing_activate_a_card' => [
                'class' => AirwallexIssuingActivateACard::class,
                'name' => 'Activate a card',
                'description' => 'Issuing > Cards > Activate a card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cards/{card_id}/activate.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `card_id`.',
                    ],
                ],
            ],
            'airwallex_issuing_get_card_details' => [
                'class' => AirwallexIssuingGetCardDetails::class,
                'name' => 'Get card details',
                'description' => 'Issuing > Cards > Get card details.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/cards/{card_id}.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `card_id`.',
                    ],
                ],
            ],
            'airwallex_issuing_get_card_remaining_limits' => [
                'class' => AirwallexIssuingGetCardRemainingLimits::class,
                'name' => 'Get card remaining limits',
                'description' => 'Issuing > Cards > Get card remaining limits.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/cards/{card_id}/limits.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `card_id`.',
                    ],
                ],
            ],
            'airwallex_issuing_update_a_card' => [
                'class' => AirwallexIssuingUpdateACard::class,
                'name' => 'Update a card',
                'description' => 'Issuing > Cards > Update a card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cards/{card_id}/update.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `card_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_issuing_get_issuing_config' => [
                'class' => AirwallexIssuingGetIssuingConfig::class,
                'name' => 'Get issuing config',
                'description' => 'Issuing > Config > Get issuing config.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/config.',
                'parameters' => [],
            ],
            'airwallex_issuing_update_issuing_config' => [
                'class' => AirwallexIssuingUpdateIssuingConfig::class,
                'name' => 'Update issuing config',
                'description' => 'Issuing > Config > Update issuing config.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/config/update.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_issuing_get_transactions' => [
                'class' => AirwallexIssuingGetTransactions::class,
                'name' => 'Get transactions',
                'description' => 'Issuing > Transactions > Get transactions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/transactions.',
                'parameters' => [],
            ],
            'airwallex_issuing_get_single_transaction' => [
                'class' => AirwallexIssuingGetSingleTransaction::class,
                'name' => 'Get single transaction',
                'description' => 'Issuing > Transactions > Get single transaction.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/transactions/{issuing_transaction_id}.',
                'parameters' => [
                    'issuing_transaction_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `issuing_transaction_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_available_payment_method_types' => [
                'class' => AirwallexOnlinePaymentsRetrieveAvailablePaymentMethodTypes::class,
                'name' => 'Retrieve available payment method types',
                'description' => 'Online Payments > Config > Retrieve available payment method types.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/config/payment_method_types.',
                'parameters' => [
                    'active' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Indicate whether the payment method type is active',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The supported country code.',
                    ],
                    'transaction_currency' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The supported transaction currency. transaction_currency is required when country_code is given.',
                    ],
                    'transaction_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The supported transaction mode. One of oneoff, recurring.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_bank_names_for_certain_payment_method_types' => [
                'class' => AirwallexOnlinePaymentsRetrieveBankNamesForCertainPaymentMethodTypes::class,
                'name' => 'Retrieve bank names for certain payment method types',
                'description' => 'Online Payments > Config > Retrieve bank names for certain payment method types.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/config/banks.',
                'parameters' => [
                    'payment_method_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The payment method type to find the available banks. One of fpx, bank_transfer, online_banking. For other payment methods that does not require bank_name, an empty list will be returned.',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Country code to filter the available banks. Use the two-character ISO Standard Country Codes.

For payment method type like online_banking and bank_transfer, the available bank list differs in different countries and country_code is needed to get the bank list.

For other payment method types, country_code will be ignored.',
                    ],
                ],
            ],
            'airwallex_online_payments_create_a_customer' => [
                'class' => AirwallexOnlinePaymentsCreateACustomer::class,
                'name' => 'Create a Customer',
                'description' => 'Online Payments > Customers > Create a Customer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/customers/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_a_customer' => [
                'class' => AirwallexOnlinePaymentsRetrieveACustomer::class,
                'name' => 'Retrieve a Customer',
                'description' => 'Online Payments > Customers > Retrieve a Customer.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/customers/{customer_id}.',
                'parameters' => [
                    'customer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `customer_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_update_a_customer' => [
                'class' => AirwallexOnlinePaymentsUpdateACustomer::class,
                'name' => 'Update a Customer',
                'description' => 'Online Payments > Customers > Update a Customer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/customers/{customer_id}/update.',
                'parameters' => [
                    'customer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `customer_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_generate_a_client_secret_for_a_customer' => [
                'class' => AirwallexOnlinePaymentsGenerateAClientSecretForACustomer::class,
                'name' => 'Generate a client secret for a Customer',
                'description' => 'Online Payments > Customers > Generate a client secret for a Customer.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/customers/{customer_id}/generate_client_secret.',
                'parameters' => [
                    'customer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `customer_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_get_list_of_customers' => [
                'class' => AirwallexOnlinePaymentsGetListOfCustomers::class,
                'name' => 'Get list of Customers',
                'description' => 'Online Payments > Customers > Get list of Customers.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/customers.',
                'parameters' => [],
            ],
            'airwallex_online_payments_create_a_customs_declaration' => [
                'class' => AirwallexOnlinePaymentsCreateACustomsDeclaration::class,
                'name' => 'Create a customs declaration',
                'description' => 'Online Payments > Customs Declarations > Create a customs declaration.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/customs_declarations/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_create_a_fundssplit' => [
                'class' => AirwallexOnlinePaymentsCreateAFundssplit::class,
                'name' => 'Create a FundsSplit',
                'description' => 'Online Payments > Fund Splits > Create a FundsSplit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/funds_splits/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_a_fundssplit' => [
                'class' => AirwallexOnlinePaymentsRetrieveAFundssplit::class,
                'name' => 'Retrieve a FundsSplit',
                'description' => 'Online Payments > Fund Splits > Retrieve a FundsSplit.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/funds_splits/{fund_split_id}.',
                'parameters' => [
                    'fund_split_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `fund_split_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_get_list_of_fundssplits' => [
                'class' => AirwallexOnlinePaymentsGetListOfFundssplits::class,
                'name' => 'Get list of FundsSplits',
                'description' => 'Online Payments > Fund Splits > Get list of FundsSplits.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/funds_splits.',
                'parameters' => [],
            ],
            'airwallex_online_payments_release_a_fundssplit' => [
                'class' => AirwallexOnlinePaymentsReleaseAFundssplit::class,
                'name' => 'Release a FundsSplit',
                'description' => 'Online Payments > Fund Splits > Release a FundsSplit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/funds_splits/{fund_split_id}/release.',
                'parameters' => [
                    'fund_split_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `fund_split_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_a_paymentattempt_by_id' => [
                'class' => AirwallexOnlinePaymentsRetrieveAPaymentattemptById::class,
                'name' => 'Retrieve a PaymentAttempt by ID',
                'description' => 'Online Payments > Payment Attempts > Retrieve a PaymentAttempt by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_attempts/{payment_attempt_id}.',
                'parameters' => [
                    'payment_attempt_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_attempt_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_list_of_paymentattempts' => [
                'class' => AirwallexOnlinePaymentsRetrieveListOfPaymentattempts::class,
                'name' => 'Retrieve list of PaymentAttempts',
                'description' => 'Online Payments > Payment Attempts > Retrieve list of PaymentAttempts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_attempts.',
                'parameters' => [],
            ],
            'airwallex_online_payments_create_a_paymentconsent' => [
                'class' => AirwallexOnlinePaymentsCreateAPaymentconsent::class,
                'name' => 'Create a PaymentConsent',
                'description' => 'Online Payments > Payment Consents > Create a PaymentConsent.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_consents/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_update_a_paymentconsent' => [
                'class' => AirwallexOnlinePaymentsUpdateAPaymentconsent::class,
                'name' => 'Update a PaymentConsent',
                'description' => 'Online Payments > Payment Consents > Update a PaymentConsent.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_consents/{payment_consent_id}/update.',
                'parameters' => [
                    'payment_consent_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_consent_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_disable_a_paymentconsent' => [
                'class' => AirwallexOnlinePaymentsDisableAPaymentconsent::class,
                'name' => 'Disable a PaymentConsent',
                'description' => 'Online Payments > Payment Consents > Disable a PaymentConsent.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_consents/{payment_consent_id}/disable.',
                'parameters' => [
                    'payment_consent_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_consent_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_verify_a_paymentconsent_card' => [
                'class' => AirwallexOnlinePaymentsVerifyAPaymentconsentCard::class,
                'name' => 'Verify a PaymentConsent - Card',
                'description' => 'Online Payments > Payment Consents > Verify a PaymentConsent - Card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_consents/{id}/verify.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_continue_to_verify_a_paymentconsent' => [
                'class' => AirwallexOnlinePaymentsContinueToVerifyAPaymentconsent::class,
                'name' => 'Continue to Verify a PaymentConsent',
                'description' => 'Online Payments > Payment Consents > Continue to Verify a PaymentConsent.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_consents/{payment_consent_id}/verify_continue.',
                'parameters' => [
                    'payment_consent_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_consent_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_get_a_paymentconsent' => [
                'class' => AirwallexOnlinePaymentsGetAPaymentconsent::class,
                'name' => 'Get a PaymentConsent',
                'description' => 'Online Payments > Payment Consents > Get a PaymentConsent.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_consents/{payment_consent_id}.',
                'parameters' => [
                    'payment_consent_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_consent_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_get_list_of_paymentconsents' => [
                'class' => AirwallexOnlinePaymentsGetListOfPaymentconsents::class,
                'name' => 'Get list of PaymentConsents',
                'description' => 'Online Payments > Payment Consents > Get list of PaymentConsents.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_consents.',
                'parameters' => [],
            ],
            'airwallex_online_payments_create_a_paymentintent_mvp' => [
                'class' => AirwallexOnlinePaymentsCreateAPaymentintentMvp::class,
                'name' => 'Create a PaymentIntent - MVP',
                'description' => 'Online Payments > Payment Intents > Create a PaymentIntent - MVP.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_intents/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_a_paymentintent' => [
                'class' => AirwallexOnlinePaymentsRetrieveAPaymentintent::class,
                'name' => 'Retrieve a PaymentIntent',
                'description' => 'Online Payments > Payment Intents > Retrieve a PaymentIntent.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_intents/{payment_intent_id}.',
                'parameters' => [
                    'payment_intent_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_intent_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_confirm_a_paymentintent_payment_method_card' => [
                'class' => AirwallexOnlinePaymentsConfirmAPaymentintentPaymentMethodCard::class,
                'name' => 'Confirm a PaymentIntent - payment_method = card',
                'description' => 'Online Payments > Payment Intents > Confirm a PaymentIntent - payment_method = card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_intents/{payment_intent_id}/confirm.',
                'parameters' => [
                    'payment_intent_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_intent_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_continue_to_confirm_a_paymentintent' => [
                'class' => AirwallexOnlinePaymentsContinueToConfirmAPaymentintent::class,
                'name' => 'Continue to confirm a PaymentIntent',
                'description' => 'Online Payments > Payment Intents > Continue to confirm a PaymentIntent.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_intents/{payment_intent_id}/confirm_continue.',
                'parameters' => [
                    'payment_intent_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_intent_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_capture_a_paymentintent' => [
                'class' => AirwallexOnlinePaymentsCaptureAPaymentintent::class,
                'name' => 'Capture a PaymentIntent',
                'description' => 'Online Payments > Payment Intents > Capture a PaymentIntent.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_intents/{payment_intent_id}/capture.',
                'parameters' => [
                    'payment_intent_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_intent_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_get_list_of_paymentintents' => [
                'class' => AirwallexOnlinePaymentsGetListOfPaymentintents::class,
                'name' => 'Get list of PaymentIntents',
                'description' => 'Online Payments > Payment Intents > Get list of PaymentIntents.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_intents.',
                'parameters' => [],
            ],
            'airwallex_online_payments_create_a_paymentmethod' => [
                'class' => AirwallexOnlinePaymentsCreateAPaymentmethod::class,
                'name' => 'Create a PaymentMethod',
                'description' => 'Online Payments > Payment Methods > Create a PaymentMethod.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_methods/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_a_paymentmethod' => [
                'class' => AirwallexOnlinePaymentsRetrieveAPaymentmethod::class,
                'name' => 'Retrieve a PaymentMethod',
                'description' => 'Online Payments > Payment Methods > Retrieve a PaymentMethod.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_methods/{payment_method_id}.',
                'parameters' => [
                    'payment_method_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_method_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_update_a_paymentmethod' => [
                'class' => AirwallexOnlinePaymentsUpdateAPaymentmethod::class,
                'name' => 'Update a PaymentMethod',
                'description' => 'Online Payments > Payment Methods > Update a PaymentMethod.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_methods/{payment_method_id}/update.',
                'parameters' => [
                    'payment_method_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_method_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_get_list_of_paymentmethods' => [
                'class' => AirwallexOnlinePaymentsGetListOfPaymentmethods::class,
                'name' => 'Get list of PaymentMethods',
                'description' => 'Online Payments > Payment Methods > Get list of PaymentMethods.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_methods.',
                'parameters' => [],
            ],
            'airwallex_online_payments_disable_a_paymentmethod' => [
                'class' => AirwallexOnlinePaymentsDisableAPaymentmethod::class,
                'name' => 'Disable a PaymentMethod',
                'description' => 'Online Payments > Payment Methods > Disable a PaymentMethod.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_methods/{payment_method_id}/disable.',
                'parameters' => [
                    'payment_method_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_method_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_create_a_refund' => [
                'class' => AirwallexOnlinePaymentsCreateARefund::class,
                'name' => 'Create a Refund',
                'description' => 'Online Payments > Refunds > Create a Refund.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/refunds/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_online_payments_retrieve_a_refund' => [
                'class' => AirwallexOnlinePaymentsRetrieveARefund::class,
                'name' => 'Retrieve a Refund',
                'description' => 'Online Payments > Refunds > Retrieve a Refund.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/refunds/{refund_id}.',
                'parameters' => [
                    'refund_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `refund_id`.',
                    ],
                ],
            ],
            'airwallex_online_payments_get_list_of_refunds' => [
                'class' => AirwallexOnlinePaymentsGetListOfRefunds::class,
                'name' => 'Get list of Refunds',
                'description' => 'Online Payments > Refunds > Get list of Refunds.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/refunds.',
                'parameters' => [],
            ],
            'airwallex_payouts_get_list_of_beneficiaries' => [
                'class' => AirwallexPayoutsGetListOfBeneficiaries::class,
                'name' => 'Get list of beneficiaries',
                'description' => 'Payouts > Beneficiaries > Get list of beneficiaries.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/beneficiaries.',
                'parameters' => [],
            ],
            'airwallex_payouts_get_a_beneficiary_by_id' => [
                'class' => AirwallexPayoutsGetABeneficiaryById::class,
                'name' => 'Get a beneficiary by ID',
                'description' => 'Payouts > Beneficiaries > Get a beneficiary by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/beneficiaries/{beneficiary_id}.',
                'parameters' => [
                    'beneficiary_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `beneficiary_id`.',
                    ],
                ],
            ],
            'airwallex_payouts_create_a_new_beneficiary' => [
                'class' => AirwallexPayoutsCreateANewBeneficiary::class,
                'name' => 'Create a new beneficiary',
                'description' => 'Payouts > Beneficiaries > Create a new beneficiary.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiaries/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_update_existing_beneficiary' => [
                'class' => AirwallexPayoutsUpdateExistingBeneficiary::class,
                'name' => 'Update existing beneficiary',
                'description' => 'Payouts > Beneficiaries > Update existing beneficiary.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiaries/{beneficiary_id}/update.',
                'parameters' => [
                    'beneficiary_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `beneficiary_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_validate_beneficiary' => [
                'class' => AirwallexPayoutsValidateBeneficiary::class,
                'name' => 'Validate beneficiary',
                'description' => 'Payouts > Beneficiaries > Validate beneficiary.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiaries/validate.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_delete_existing_beneficiary' => [
                'class' => AirwallexPayoutsDeleteExistingBeneficiary::class,
                'name' => 'Delete existing beneficiary',
                'description' => 'Payouts > Beneficiaries > Delete existing beneficiary.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiaries/{id}/delete.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `id`.',
                    ],
                ],
            ],
            'airwallex_payouts_get_the_api_schema' => [
                'class' => AirwallexPayoutsGetTheApiSchema::class,
                'name' => 'Get the API schema',
                'description' => 'Payouts > Beneficiaries > Get the API schema.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiary_api_schemas/generate.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_get_the_form_schema' => [
                'class' => AirwallexPayoutsGetTheFormSchema::class,
                'name' => 'Get the form schema',
                'description' => 'Payouts > Beneficiaries > Get the form schema.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiary_form_schemas/generate.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_get_list_of_payers' => [
                'class' => AirwallexPayoutsGetListOfPayers::class,
                'name' => 'Get list of payers',
                'description' => 'Payouts > Payers > Get list of payers.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/payers.',
                'parameters' => [],
            ],
            'airwallex_payouts_create_a_new_payer' => [
                'class' => AirwallexPayoutsCreateANewPayer::class,
                'name' => 'Create a new payer',
                'description' => 'Payouts > Payers > Create a new payer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/payers/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_get_a_payer_by_id' => [
                'class' => AirwallexPayoutsGetAPayerById::class,
                'name' => 'Get a payer by ID',
                'description' => 'Payouts > Payers > Get a payer by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/payers/{payer_id}.',
                'parameters' => [
                    'payer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payer_id`.',
                    ],
                ],
            ],
            'airwallex_payouts_update_existing_payer' => [
                'class' => AirwallexPayoutsUpdateExistingPayer::class,
                'name' => 'Update existing payer',
                'description' => 'Payouts > Payers > Update existing payer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/payers/{payer_id}/update.',
                'parameters' => [
                    'payer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payer_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_validate_payer' => [
                'class' => AirwallexPayoutsValidatePayer::class,
                'name' => 'Validate payer',
                'description' => 'Payouts > Payers > Validate payer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/payers/validate.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_delete_existing_payer' => [
                'class' => AirwallexPayoutsDeleteExistingPayer::class,
                'name' => 'Delete existing payer',
                'description' => 'Payouts > Payers > Delete existing payer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/payers/{payer_id}/delete.',
                'parameters' => [
                    'payer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payer_id`.',
                    ],
                ],
            ],
            'airwallex_payouts_create_a_new_transfer_to_beneficiary' => [
                'class' => AirwallexPayoutsCreateANewTransferToBeneficiary::class,
                'name' => 'Create a new transfer - to beneficiary',
                'description' => 'Payouts > Transfers > Create a new transfer - to beneficiary.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/transfers/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_get_list_of_transfers' => [
                'class' => AirwallexPayoutsGetListOfTransfers::class,
                'name' => 'Get list of transfers',
                'description' => 'Payouts > Transfers > Get list of transfers.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/transfers.',
                'parameters' => [],
            ],
            'airwallex_payouts_get_transfer_by_id' => [
                'class' => AirwallexPayoutsGetTransferById::class,
                'name' => 'Get transfer by ID',
                'description' => 'Payouts > Transfers > Get transfer by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/transfers/{transfer_id}.',
                'parameters' => [
                    'transfer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `transfer_id`.',
                    ],
                ],
            ],
            'airwallex_payouts_validate_transfer' => [
                'class' => AirwallexPayoutsValidateTransfer::class,
                'name' => 'Validate transfer',
                'description' => 'Payouts > Transfers > Validate transfer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/transfers/validate.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_payouts_cancel_a_transfer' => [
                'class' => AirwallexPayoutsCancelATransfer::class,
                'name' => 'Cancel a transfer',
                'description' => 'Payouts > Transfers > Cancel a transfer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/transfers/{transfer_id}/cancel.',
                'parameters' => [
                    'transfer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `transfer_id`.',
                    ],
                ],
            ],
            'airwallex_reporting_create_a_financial_report' => [
                'class' => AirwallexReportingCreateAFinancialReport::class,
                'name' => 'Create a financial report',
                'description' => 'Reporting > Financial Reports > Create a financial report.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/finance/financial_reports/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_reporting_get_list_of_financial_reports' => [
                'class' => AirwallexReportingGetListOfFinancialReports::class,
                'name' => 'Get list of financial reports',
                'description' => 'Reporting > Financial Reports > Get list of financial reports.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/finance/financial_reports.',
                'parameters' => [],
            ],
            'airwallex_reporting_get_financial_report_by_id' => [
                'class' => AirwallexReportingGetFinancialReportById::class,
                'name' => 'Get financial report by ID',
                'description' => 'Reporting > Financial Reports > Get financial report by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/finance/financial_reports/{report_id}.',
                'parameters' => [
                    'report_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `report_id`.',
                    ],
                ],
            ],
            'airwallex_reporting_get_contents_of_a_financial_report' => [
                'class' => AirwallexReportingGetContentsOfAFinancialReport::class,
                'name' => 'Get contents of a financial report',
                'description' => 'Reporting > Financial Reports > Get contents of a financial report.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/finance/financial_reports/{report_id}/content.',
                'parameters' => [
                    'report_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `report_id`.',
                    ],
                ],
            ],
            'airwallex_reporting_get_list_of_financial_transactions' => [
                'class' => AirwallexReportingGetListOfFinancialTransactions::class,
                'name' => 'Get list of financial transactions',
                'description' => 'Reporting > Financial Transactions > Get list of financial transactions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/financial_transactions.',
                'parameters' => [
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of results per page, default is 100, max is 1000',
                    ],
                    'to_created_at' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The end time of created_at in ISO8601 format (inclusive)',
                    ],
                ],
            ],
            'airwallex_reporting_get_a_financial_transaction_by_id' => [
                'class' => AirwallexReportingGetAFinancialTransactionById::class,
                'name' => 'Get a financial transaction by ID',
                'description' => 'Reporting > Financial Transactions > Get a financial transaction by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/financial_transactions/{financial_transaction_id}.',
                'parameters' => [
                    'financial_transaction_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `financial_transaction_id`.',
                    ],
                ],
            ],
            'airwallex_reporting_get_list_of_settlements' => [
                'class' => AirwallexReportingGetListOfSettlements::class,
                'name' => 'Get list of settlements',
                'description' => 'Reporting > Settlements > Get list of settlements.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/financial/settlements.',
                'parameters' => [],
            ],
            'airwallex_reporting_get_a_settlement_by_id' => [
                'class' => AirwallexReportingGetASettlementById::class,
                'name' => 'Get a settlement by ID',
                'description' => 'Reporting > Settlements > Get a settlement by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/financial/settlements/{settlement_id}.',
                'parameters' => [
                    'settlement_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `settlement_id`.',
                    ],
                ],
            ],
            'airwallex_reporting_get_a_settlement_report_by_id' => [
                'class' => AirwallexReportingGetASettlementReportById::class,
                'name' => 'Get a settlement report by ID',
                'description' => 'Reporting > Settlements > Get a settlement report by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/financial/settlements/{settlement_id}/report.',
                'parameters' => [
                    'settlement_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `settlement_id`.',
                    ],
                ],
            ],
            'airwallex_scale_create_an_account_invitation_link_oauth2' => [
                'class' => AirwallexScaleCreateAnAccountInvitationLinkOauth2::class,
                'name' => 'Create an account invitation link - oauth2',
                'description' => 'Scale > Account Links > Create an account invitation link - oauth2.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/invitation_links/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_scale_get_an_account_invitation_link_by_id' => [
                'class' => AirwallexScaleGetAnAccountInvitationLinkById::class,
                'name' => 'Get an account invitation link by ID',
                'description' => 'Scale > Account Links > Get an account invitation link by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/accounts/invitation_links/{invitation_link_id}.',
                'parameters' => [
                    'invitation_link_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `invitation_link_id`.',
                    ],
                ],
            ],
            'airwallex_scale_create_an_account_business' => [
                'class' => AirwallexScaleCreateAnAccountBusiness::class,
                'name' => 'Create an account - Business',
                'description' => 'Scale > Accounts > Create an account - Business.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_scale_update_a_connected_account' => [
                'class' => AirwallexScaleUpdateAConnectedAccount::class,
                'name' => 'Update a connected account',
                'description' => 'Scale > Accounts > Update a connected account.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/{connected_account_id}/update.',
                'parameters' => [
                    'connected_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `connected_account_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_scale_submit_account_for_activation' => [
                'class' => AirwallexScaleSubmitAccountForActivation::class,
                'name' => 'Submit account for activation',
                'description' => 'Scale > Accounts > Submit account for activation.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/{connected_account_id}/submit.',
                'parameters' => [
                    'connected_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `connected_account_id`.',
                    ],
                ],
            ],
            'airwallex_scale_agree_to_terms_and_conditions' => [
                'class' => AirwallexScaleAgreeToTermsAndConditions::class,
                'name' => 'Agree to terms and conditions',
                'description' => 'Scale > Accounts > Agree to terms and conditions.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/{connected_account_id}/terms_and_conditions/agree.',
                'parameters' => [
                    'connected_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `connected_account_id`.',
                    ],
                ],
            ],
            'airwallex_scale_get_account_by_id' => [
                'class' => AirwallexScaleGetAccountById::class,
                'name' => 'Get account by ID',
                'description' => 'Scale > Accounts > Get account by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/accounts/{connected_account_id}.',
                'parameters' => [
                    'connected_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `connected_account_id`.',
                    ],
                ],
            ],
            'airwallex_scale_get_list_of_connected_accounts' => [
                'class' => AirwallexScaleGetListOfConnectedAccounts::class,
                'name' => 'Get list of connected accounts',
                'description' => 'Scale > Accounts > Get list of connected accounts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/accounts.',
                'parameters' => [],
            ],
            'airwallex_scale_retrieve_account_details' => [
                'class' => AirwallexScaleRetrieveAccountDetails::class,
                'name' => 'Retrieve account details',
                'description' => 'Scale > Accounts > Retrieve account details.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/account.',
                'parameters' => [],
            ],
            'airwallex_scale_create_a_new_charge' => [
                'class' => AirwallexScaleCreateANewCharge::class,
                'name' => 'Create a new charge',
                'description' => 'Scale > Charges > Create a new charge.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/charges/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_scale_get_list_of_charges' => [
                'class' => AirwallexScaleGetListOfCharges::class,
                'name' => 'Get list of charges',
                'description' => 'Scale > Charges > Get list of charges.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/charges.',
                'parameters' => [],
            ],
            'airwallex_scale_get_a_charge_by_id' => [
                'class' => AirwallexScaleGetAChargeById::class,
                'name' => 'Get a charge by ID',
                'description' => 'Scale > Charges > Get a charge by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/charges/{charge_id}.',
                'parameters' => [
                    'charge_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `charge_id`.',
                    ],
                ],
            ],
            'airwallex_scale_create_flow' => [
                'class' => AirwallexScaleCreateFlow::class,
                'name' => 'Create flow',
                'description' => 'Scale > Hosted Flow > Create flow.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/hosted_flows/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_scale_get_flow' => [
                'class' => AirwallexScaleGetFlow::class,
                'name' => 'Get flow',
                'description' => 'Scale > Hosted Flow > Get flow.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/hosted_flows/{hosted_flow_instance_id}.',
                'parameters' => [
                    'hosted_flow_instance_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `hosted_flow_instance_id`.',
                    ],
                ],
            ],
            'airwallex_scale_authorize_flow' => [
                'class' => AirwallexScaleAuthorizeFlow::class,
                'name' => 'Authorize flow',
                'description' => 'Scale > Hosted Flow > Authorize flow.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/hosted_flows/{hosted_flow_instance_id}/authorize.',
                'parameters' => [
                    'hosted_flow_instance_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `hosted_flow_instance_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_scale_create_a_new_connected_account_transfer' => [
                'class' => AirwallexScaleCreateANewConnectedAccountTransfer::class,
                'name' => 'Create a new connected account transfer',
                'description' => 'Scale > Connected Account Transfers > Create a new connected account transfer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/connected_account_transfers/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_scale_get_list_of_connected_account_transfers' => [
                'class' => AirwallexScaleGetListOfConnectedAccountTransfers::class,
                'name' => 'Get list of connected account transfers',
                'description' => 'Scale > Connected Account Transfers > Get list of connected account transfers.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/connected_account_transfers.',
                'parameters' => [],
            ],
            'airwallex_scale_get_a_connected_account_transfer_by_id' => [
                'class' => AirwallexScaleGetAConnectedAccountTransferById::class,
                'name' => 'Get a connected account transfer by ID',
                'description' => 'Scale > Connected Account Transfers > Get a connected account transfer by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/connected_account_transfers/{transfer_id}.',
                'parameters' => [
                    'transfer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `transfer_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_update_status_of_connected_account' => [
                'class' => AirwallexSimulationDemoOnlyUpdateStatusOfConnectedAccount::class,
                'name' => 'Update status of connected account',
                'description' => 'Simulation (Demo Only) > Accounts > Update status of connected account.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/accounts/{account_id}/update_status.',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `account_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_fail_next_autocharge' => [
                'class' => AirwallexSimulationDemoOnlyFailNextAutocharge::class,
                'name' => 'Fail next autocharge',
                'description' => 'Simulation (Demo Only) > Billing > Fail next autocharge.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/billing/payment_sources/{payment_source_id}/fail_next_autocharge.',
                'parameters' => [
                    'payment_source_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `payment_source_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_create_a_global_account_deposit' => [
                'class' => AirwallexSimulationDemoOnlyCreateAGlobalAccountDeposit::class,
                'name' => 'Create a global account deposit',
                'description' => 'Simulation (Demo Only) > Deposits > Create a global account deposit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/deposit/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_reject_a_direct_debit_deposit' => [
                'class' => AirwallexSimulationDemoOnlyRejectADirectDebitDeposit::class,
                'name' => 'Reject a direct debit deposit',
                'description' => 'Simulation (Demo Only) > Deposits > Reject a direct debit deposit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/deposits/{deposit_id}/reject.',
                'parameters' => [
                    'deposit_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `deposit_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_reverse_a_direct_debit_deposit' => [
                'class' => AirwallexSimulationDemoOnlyReverseADirectDebitDeposit::class,
                'name' => 'Reverse a direct debit deposit',
                'description' => 'Simulation (Demo Only) > Deposits > Reverse a direct debit deposit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/deposits/{deposit_id}/reverse.',
                'parameters' => [
                    'deposit_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `deposit_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_settle_a_direct_debit_deposit' => [
                'class' => AirwallexSimulationDemoOnlySettleADirectDebitDeposit::class,
                'name' => 'Settle a direct debit deposit',
                'description' => 'Simulation (Demo Only) > Deposits > Settle a direct debit deposit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/deposits/{deposit_id}/settle.',
                'parameters' => [
                    'deposit_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `deposit_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_create_a_transaction_for_the_provided_card' => [
                'class' => AirwallexSimulationDemoOnlyCreateATransactionForTheProvidedCard::class,
                'name' => 'Create a transaction for the provided card',
                'description' => 'Simulation (Demo Only) > Issuing > Create a transaction for the provided card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/issuing/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_capture_the_transaction_with_the_provided_id' => [
                'class' => AirwallexSimulationDemoOnlyCaptureTheTransactionWithTheProvidedId::class,
                'name' => 'Capture the transaction with the provided id',
                'description' => 'Simulation (Demo Only) > Issuing > Capture the transaction with the provided id.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/issuing/{transaction_id}/capture.',
                'parameters' => [
                    'transaction_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `transaction_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_accept_a_mandate' => [
                'class' => AirwallexSimulationDemoOnlyAcceptAMandate::class,
                'name' => 'Accept a Mandate',
                'description' => 'Simulation (Demo Only) > Linked Accounts > Accept a Mandate.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/linked_accounts/{linked_account_id}/mandate/accept.',
                'parameters' => [
                    'linked_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `linked_account_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_reject_a_mandate' => [
                'class' => AirwallexSimulationDemoOnlyRejectAMandate::class,
                'name' => 'Reject a Mandate',
                'description' => 'Simulation (Demo Only) > Linked Accounts > Reject a Mandate.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/linked_accounts/{linked_account_id}/mandate/reject.',
                'parameters' => [
                    'linked_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `linked_account_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_cancel_a_mandate' => [
                'class' => AirwallexSimulationDemoOnlyCancelAMandate::class,
                'name' => 'Cancel a Mandate',
                'description' => 'Simulation (Demo Only) > Linked Accounts > Cancel a Mandate.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/linked_accounts/{linked_account_id}/mandate/cancel.',
                'parameters' => [
                    'linked_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `linked_account_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_fail_a_micro_deposits_verification' => [
                'class' => AirwallexSimulationDemoOnlyFailAMicroDepositsVerification::class,
                'name' => 'Fail a Micro Deposits verification',
                'description' => 'Simulation (Demo Only) > Linked Accounts > Fail a Micro Deposits verification.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/linked_accounts/{linked_account_id}/fail_microdeposits.',
                'parameters' => [
                    'linked_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `linked_account_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_create_a_paymentdispute' => [
                'class' => AirwallexSimulationDemoOnlyCreateAPaymentdispute::class,
                'name' => 'Create a PaymentDispute',
                'description' => 'Simulation (Demo Only) > Payment Acceptance > Create a PaymentDispute.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/pa/payment_disputes/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_resolve_a_paymentdispute' => [
                'class' => AirwallexSimulationDemoOnlyResolveAPaymentdispute::class,
                'name' => 'Resolve a PaymentDispute',
                'description' => 'Simulation (Demo Only) > Payment Acceptance > Resolve a PaymentDispute.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/pa/payment_disputes/{dispute_id}/resolve.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `dispute_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_escalate_a_paymentdispute' => [
                'class' => AirwallexSimulationDemoOnlyEscalateAPaymentdispute::class,
                'name' => 'Escalate a PaymentDispute',
                'description' => 'Simulation (Demo Only) > Payment Acceptance > Escalate a PaymentDispute.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/pa/payment_disputes/{dispute_id}/escalate.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `dispute_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_simulate_a_shopper_action' => [
                'class' => AirwallexSimulationDemoOnlySimulateAShopperAction::class,
                'name' => 'Simulate a shopper action',
                'description' => 'Simulation (Demo Only) > Payment Acceptance > Simulate a shopper action.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/pa/shopper_actions/{action}.',
                'parameters' => [
                    'action' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `action`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_transition_payment_status' => [
                'class' => AirwallexSimulationDemoOnlyTransitionPaymentStatus::class,
                'name' => 'Transition Payment Status',
                'description' => 'Simulation (Demo Only) > Payouts > Transition Payment Status.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/payments/{id}/transition.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_create_an_rfi' => [
                'class' => AirwallexSimulationDemoOnlyCreateAnRfi::class,
                'name' => 'Create an RFI',
                'description' => 'Simulation (Demo Only) > Request for Information (RFI) > Create an RFI.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/rfis/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_follow_up_rfi' => [
                'class' => AirwallexSimulationDemoOnlyFollowUpRfi::class,
                'name' => 'Follow-up RFI',
                'description' => 'Simulation (Demo Only) > Request for Information (RFI) > Follow-up RFI.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/rfis/{rfi_id}/follow_up.',
                'parameters' => [
                    'rfi_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `rfi_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_close_an_rfi' => [
                'class' => AirwallexSimulationDemoOnlyCloseAnRfi::class,
                'name' => 'Close an RFI',
                'description' => 'Simulation (Demo Only) > Request for Information (RFI) > Close an RFI.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/rfis/{rfi_id}/close.',
                'parameters' => [
                    'rfi_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `rfi_id`.',
                    ],
                ],
            ],
            'airwallex_simulation_demo_only_transition_transfer_status' => [
                'class' => AirwallexSimulationDemoOnlyTransitionTransferStatus::class,
                'name' => 'Transition Transfer Status',
                'description' => 'Simulation (Demo Only) > Transfers > Transition Transfer Status.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/transfers/{transfer_id}/transition.',
                'parameters' => [
                    'transfer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `transfer_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_supporting_services_upload_a_file' => [
                'class' => AirwallexSupportingServicesUploadAFile::class,
                'name' => 'Upload a file',
                'description' => 'Supporting Services > File Service > Upload a file.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/files/upload.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_supporting_services_get_onboarding_file_download_links' => [
                'class' => AirwallexSupportingServicesGetOnboardingFileDownloadLinks::class,
                'name' => 'Get onboarding file download links',
                'description' => 'Supporting Services > File Service > Get onboarding file download links.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/files/download_links.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_supporting_services_industry_categories' => [
                'class' => AirwallexSupportingServicesIndustryCategories::class,
                'name' => 'Industry categories',
                'description' => 'Supporting Services > Reference Data > Industry categories.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/reference/industry_categories.',
                'parameters' => [],
            ],
            'airwallex_supporting_services_invalid_conversion_dates' => [
                'class' => AirwallexSupportingServicesInvalidConversionDates::class,
                'name' => 'Invalid conversion dates',
                'description' => 'Supporting Services > Reference Data > Invalid conversion dates.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/reference/invalid_conversion_dates.',
                'parameters' => [
                    'currency_pair' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Currency pair to get the invalid conversion dates for',
                    ],
                ],
            ],
            'airwallex_supporting_services_settlement_accounts' => [
                'class' => AirwallexSupportingServicesSettlementAccounts::class,
                'name' => 'Settlement accounts',
                'description' => 'Supporting Services > Reference Data > Settlement accounts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/reference/settlement_accounts.',
                'parameters' => [],
            ],
            'airwallex_supporting_services_supported_currencies' => [
                'class' => AirwallexSupportingServicesSupportedCurrencies::class,
                'name' => 'Supported currencies',
                'description' => 'Supporting Services > Reference Data > Supported currencies.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/reference/supported_currencies.',
                'parameters' => [],
            ],
            'airwallex_transactional_fx_create_a_quote' => [
                'class' => AirwallexTransactionalFxCreateAQuote::class,
                'name' => 'Create a quote',
                'description' => 'Transactional FX > Quotes > Create a quote.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/fx/quotes/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_transactional_fx_create_a_conversion_buy_amount_based' => [
                'class' => AirwallexTransactionalFxCreateAConversionBuyAmountBased::class,
                'name' => 'Create a conversion - buy_amount based',
                'description' => 'Transactional FX > Conversion > Create a conversion - buy_amount based.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/fx/conversions/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_transactional_fx_retrieve_a_specific_conversion' => [
                'class' => AirwallexTransactionalFxRetrieveASpecificConversion::class,
                'name' => 'Retrieve a specific conversion',
                'description' => 'Transactional FX > Conversion > Retrieve a specific conversion.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/fx/conversions/{conversion_id}.',
                'parameters' => [
                    'conversion_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `conversion_id`.',
                    ],
                ],
            ],
            'airwallex_transactional_fx_list_conversions' => [
                'class' => AirwallexTransactionalFxListConversions::class,
                'name' => 'List conversions',
                'description' => 'Transactional FX > Conversion > List conversions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/fx/conversions.',
                'parameters' => [],
            ],
            'airwallex_transactional_fx_create_an_amendment_quote' => [
                'class' => AirwallexTransactionalFxCreateAnAmendmentQuote::class,
                'name' => 'Create an amendment quote',
                'description' => 'Transactional FX > Conversion Amendments > Create an amendment quote.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/fx/conversion_amendments/quote.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_transactional_fx_retrieve_a_current_rate' => [
                'class' => AirwallexTransactionalFxRetrieveACurrentRate::class,
                'name' => 'Retrieve a current rate',
                'description' => 'Transactional FX > Rates > Retrieve a current rate.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/fx/rates/current.',
                'parameters' => [
                    'buy_currency' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Currency (3-letter ISO-4217 code) the client buys',
                    ],
                    'sell_currency' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Currency (3-letter ISO-4217 code) the client sells. This is the currency you will need to send us by the settlement cutoff time',
                    ],
                    'buy_amount' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Amount the client buys in buy_currency (must be blank if sell_amount is specified)',
                    ],
                ],
            ],
            'airwallex_treasury_get_current_balances' => [
                'class' => AirwallexTreasuryGetCurrentBalances::class,
                'name' => 'Get current balances',
                'description' => 'Treasury > Balances > Get current balances.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/balances/current.',
                'parameters' => [],
            ],
            'airwallex_treasury_get_balance_history' => [
                'class' => AirwallexTreasuryGetBalanceHistory::class,
                'name' => 'Get balance history',
                'description' => 'Treasury > Balances > Get balance history.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/balances/history.',
                'parameters' => [],
            ],
            'airwallex_treasury_get_list_of_deposits' => [
                'class' => AirwallexTreasuryGetListOfDeposits::class,
                'name' => 'Get list of deposits',
                'description' => 'Treasury > Deposits > Get list of deposits.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/deposits.',
                'parameters' => [],
            ],
            'airwallex_treasury_get_a_deposit_by_id' => [
                'class' => AirwallexTreasuryGetADepositById::class,
                'name' => 'Get a deposit by ID',
                'description' => 'Treasury > Deposits > Get a deposit by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/deposits/{deposit_id}.',
                'parameters' => [
                    'deposit_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `deposit_id`.',
                    ],
                ],
            ],
            'airwallex_treasury_create_a_deposit_via_direct_debit' => [
                'class' => AirwallexTreasuryCreateADepositViaDirectDebit::class,
                'name' => 'Create a deposit via Direct Debit',
                'description' => 'Treasury > Deposits > Create a deposit via Direct Debit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/deposits/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_treasury_open_a_global_account' => [
                'class' => AirwallexTreasuryOpenAGlobalAccount::class,
                'name' => 'Open a global account',
                'description' => 'Treasury > Global Accounts > Open a global account.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/global_accounts/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_treasury_generate_global_account_statement_amazon' => [
                'class' => AirwallexTreasuryGenerateGlobalAccountStatementAmazon::class,
                'name' => 'Generate global account statement - AMAZON',
                'description' => 'Treasury > Global Accounts > Generate global account statement - AMAZON.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/global_accounts/{global_account_id}/generate_statement_letter.',
                'parameters' => [
                    'global_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `global_account_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_treasury_get_a_list_of_global_accounts' => [
                'class' => AirwallexTreasuryGetAListOfGlobalAccounts::class,
                'name' => 'Get a list of global accounts',
                'description' => 'Treasury > Global Accounts > Get a list of global accounts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/global_accounts.',
                'parameters' => [],
            ],
            'airwallex_treasury_get_global_account_by_id' => [
                'class' => AirwallexTreasuryGetGlobalAccountById::class,
                'name' => 'Get global account by ID',
                'description' => 'Treasury > Global Accounts > Get global account by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/global_accounts/{global_account_id}.',
                'parameters' => [
                    'global_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `global_account_id`.',
                    ],
                ],
            ],
            'airwallex_treasury_get_global_account_transactions' => [
                'class' => AirwallexTreasuryGetGlobalAccountTransactions::class,
                'name' => 'Get global account transactions',
                'description' => 'Treasury > Global Accounts > Get global account transactions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/global_accounts/{global_account_id}/transactions.',
                'parameters' => [
                    'global_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `global_account_id`.',
                    ],
                ],
            ],
            'airwallex_treasury_create_linked_bank_account' => [
                'class' => AirwallexTreasuryCreateLinkedBankAccount::class,
                'name' => 'Create Linked Bank Account',
                'description' => 'Treasury > Direct Debit LBA > Create Linked Bank Account.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/linked_accounts/create.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_treasury_verify_linked_account_with_micro_deposits' => [
                'class' => AirwallexTreasuryVerifyLinkedAccountWithMicroDeposits::class,
                'name' => 'Verify Linked Account with micro-deposits',
                'description' => 'Treasury > Direct Debit LBA > Verify Linked Account with micro-deposits.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/linked_accounts/{linked_account_id}/verify_microdeposits.',
                'parameters' => [
                    'linked_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `linked_account_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_treasury_get_linked_bank_accounts' => [
                'class' => AirwallexTreasuryGetLinkedBankAccounts::class,
                'name' => 'Get Linked Bank Accounts',
                'description' => 'Treasury > Direct Debit LBA > Get Linked Bank Accounts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/linked_accounts.',
                'parameters' => [],
            ],
            'airwallex_treasury_get_linked_bank_account_by_id' => [
                'class' => AirwallexTreasuryGetLinkedBankAccountById::class,
                'name' => 'Get Linked Bank Account by id',
                'description' => 'Treasury > Direct Debit LBA > Get Linked Bank Account by id.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/linked_accounts/{linked_account_id}.',
                'parameters' => [
                    'linked_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `linked_account_id`.',
                    ],
                ],
            ],
            'airwallex_treasury_update_mandate_for_lba' => [
                'class' => AirwallexTreasuryUpdateMandateForLba::class,
                'name' => 'Update Mandate for LBA',
                'description' => 'Treasury > Direct Debit LBA > Update Mandate for LBA.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/linked_accounts/{linked_account_id}/mandate.',
                'parameters' => [
                    'linked_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `linked_account_id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
                    ],
                ],
            ],
            'airwallex_treasury_get_mandate' => [
                'class' => AirwallexTreasuryGetMandate::class,
                'name' => 'Get mandate',
                'description' => 'Treasury > Direct Debit LBA > Get mandate.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/linked_accounts/{linked_account_id}/mandate.',
                'parameters' => [
                    'linked_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path parameter `linked_account_id`.',
                    ],
                ],
            ],
            'airwallex_treasury_funding_limits' => [
                'class' => AirwallexTreasuryFundingLimits::class,
                'name' => 'Funding limits',
                'description' => 'Treasury > Direct Debit LBA > Funding limits.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/account_capabilities/funding_limits.',
                'parameters' => [],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): AirwallexService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new AirwallexService(accessToken: $creds->get('airwallex', 'access_token', '', $account), clientId: $creds->get('airwallex', 'client_id', '', $account), apiKey: $creds->get('airwallex', 'api_key', '', $account), baseUrl: $creds->get('airwallex', 'url', 'https://api-demo.airwallex.com', $account), fileUrl: $creds->get('airwallex', 'file_url', 'https://files-demo.airwallex.com', $account), apiVersion: $creds->get('airwallex', 'api_version', '', $account), loginAs: $creds->get('airwallex', 'login_as', '', $account), onBehalfOf: $creds->get('airwallex', 'on_behalf_of', '', $account));
        }

        return app(AirwallexService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/airwallex.md'; }
    public function isIntegration(): bool { return true; }
}
