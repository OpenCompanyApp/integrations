<?php

namespace OpenCompany\Integrations\CheckoutCom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRetrieveUpdatedCardDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComOnboardEntity;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetSubEntityMembers;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComReinviteSubEntityMembers;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPlatformsPaymentInstrument;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdatePlatformsPaymentInstrument;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetReserveRule;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateReserveRule;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetEntityDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateEntityDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAddPlatformsPaymentInstrument;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComQueryPlatformsPaymentInstruments;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetSubEntitysPayoutSchedule;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComPutSubEntitysPayoutSchedule;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAddReserveRule;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComQueryReserveRules;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDelegatePayment;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateAmlVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRetrieveAmlScreening;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUploadApplePayCertificate;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComApplePayEnrollMerchant;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGenerateApplePaySigningRequest;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetEntityBalances;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComComplianceRequestsGetComplianceRequest;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComComplianceRequestsSubmitComplianceRequestResponse;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRequestAnAccessToken;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateCustomer;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetCustomerDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateCustomerDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDeleteCustomer;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetDisputes;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetDisputeDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAcceptDispute;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComProvideDisputeEvidence;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetDisputeEvidence;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSubmitDisputeEvidence;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSubmitDisputeArbitrationEvidence;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetDisputeSubmittedArbitrationEvidence;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetDisputeSubmittedEvidence;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetDisputeSchemeFiles;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUploadAFile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRetrieveAFile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateFaceAuthentication;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRetrieveFaceAuthentication;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAnonymizeFaceAuthentication;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateFavAttempt;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComListFavAttempts;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetFavAttempt;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUploadFile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetFileInformation;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetFinancialActions;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetAllWorkflows;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAddWorkflow;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetWorkflow;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRemoveWorkflow;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComPatchWorkflow;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAddWorkflowAction;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateWorkflowAction;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRemoveWorkflowAction;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAddWorkflowCondition;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateWorkflowCondition;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRemoveWorkflowCondition;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComTestWorkflow;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetEventTypes;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetWorkflowEvent;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetWorkflowActionInvocations;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComReflowByEvent;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComReflowByEventAndWorkflow;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComReflowEvents;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetSubjectEvents;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComReflowBySubject;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComReflowBySubjectAndWorkflow;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetFxRates;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComForwardRequest;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetForwardRequest;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateSecret;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComListSecrets;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateSecret;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDeleteSecret;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGooglePayEnrollMerchant;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGooglePayRegisterDomain;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGooglePayGetRegisteredDomains;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGooglePayGetEnrollmentState;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateAHostedPaymentsSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetHostedPaymentsPageDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateIdDocumentVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRetrieveIdDocumentVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAnonymizeIdDocumentVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateIdDocumentVerificationAttempt;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComListAttemptsIdDocumentVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetIdDocumentVerificationAttempt;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComPdfIdDocumentVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateApplicant;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRetrieveApplicant;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateApplicant;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAnonymizeApplicant;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateAndStartIdentityVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateIdentityVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRetrieveIdentityVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAnonymizeIdentityVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateAttempt;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComListAttempts;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetAttempt;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComPdfIdentityVerification;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateAnInstrument;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetInstrumentDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateInstrument;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDeleteInstrument;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRequestCardholderAccessToken;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateCardholder;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetCardholder;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateCardholder;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetCardholderCards;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComEnrollCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateCardEnrollmentDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetCardEnrollmentDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComActivateCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetCardCredentials;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRenewCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRevokeCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAddScheduledRevocationDate;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDeleteScheduledRevocationDate;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSuspendCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateControl;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetControlByTarget;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetControl;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateControl;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDeleteControl;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateControlGroup;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetControlGroupByTarget;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetControlGroup;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDeleteControlGroup;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateControlProfile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetControlProfilesByTarget;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetControlProfile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateControlProfile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDeleteControlProfile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComAddTargetToControlProfile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRemoveTargetFromControlProfile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetDigitalCard;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateDispute;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetDispute;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCancelDispute;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComEscalateDispute;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSimulateAuthorization;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSimulateIncrementalAuthorization;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSimulatePresentment;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSimulateRefund;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSimulateReversal;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSimulateOobAuthentication;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetTransactions;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetTransactionById;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRequestCardMetadata;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComProvisionNetworkToken;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetNetworkToken;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComProvisionCryptogram;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComDeleteNetworkToken;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRequestAPaymentContext;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPaymentContext;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateAPaymentLinkSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPaymentLinkDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPaymentMethods;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreatePaymentSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSubmitPaymentSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateAndSubmitPaymentSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRequestAPaymentOrPayout;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPaymentsList;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPaymentDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPaymentActions;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComIncrementPaymentAuthorization;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCancelAPayment;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCaptureAPayment;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRefundAPayment;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComReversePayment;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComVoidAPayment;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComSearch;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateAPaymentSetup;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateAPaymentSetup;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetAPaymentSetup;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComConfirmAPaymentSetup;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetReports;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetReportDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetReportFile;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCompleteSession;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComUpdateSessionThreeDsMethodCompletion;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRequestAToken;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCreateTransfer;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetTransferDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetBankAccountFields;

/**
 * Tool catalog and configuration metadata for Checkout.com.
 *
 * Exposes the official Checkout.com OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific credentials for multi-account hosts.
 */
class CheckoutComToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'bearer_token', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['api_key'], 'notes' => ['Checkout.com uses Authorization: Bearer <key_or_token>; OAuth access token requests use the configured access URL.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'checkout-com'; }
    public function appMeta(): array { return ['label' => 'Checkout.com', 'description' => 'Payments, payouts, payment links, disputes, issuing, platforms, workflows, balances, reports, and files', 'icon' => 'ph:credit-card', 'logo' => 'ph:credit-card']; }
    public function integrationMeta(): array { return ['name' => 'Checkout.com', 'description' => 'Manage Checkout.com payments, payouts, payment sessions, hosted payments, disputes, issuing cards and controls, platform entities, workflows, balances, transfers, reports, and files.', 'icon' => 'ph:credit-card', 'logo' => 'ph:credit-card', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://api-reference.checkout.com/']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key or Access Token', 'placeholder' => 'sk_sbox_... or OAuth access token', 'hint' => 'Sent as Authorization: Bearer <value> for authenticated endpoints.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://{prefix}.api.sandbox.checkout.com', 'hint' => 'Checkout.com base URLs are unique to your account. Use the sandbox or production API URL from Checkout.com.', 'default' => 'https://api.sandbox.checkout.com'], ['key' => 'access_url', 'type' => 'url', 'label' => 'Access Token Base URL', 'placeholder' => 'https://{prefix}.access.sandbox.checkout.com', 'hint' => 'Used by checkout_com_request_an_access_token.', 'default' => 'https://access.sandbox.checkout.com']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.sandbox.checkout.com'), '/');
        if ($apiKey === '') { return ['success' => false, 'error' => 'Checkout.com API key or access token is required.']; }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/payment-methods');
            if (!$response->successful()) { return ['success' => false, 'error' => 'Checkout.com API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to Checkout.com at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'url' => 'nullable|url', 'access_url' => 'nullable|url']; }
    public function credentialFields(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key or Access Token', 'required' => true]]; }
    public function tools(): array { return [
            'checkout_com_retrieve_updated_card_details' => [
                'class' => CheckoutComRetrieveUpdatedCardDetails::class,
                'name' => 'Retrieve Updated Card Details',
                'description' => 'Retrieve updated card credentials.  The following card schemes are supported: - Mastercard - Visa - American Express

Official Checkout.com endpoint: POST /account-updater/cards.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_onboard_entity' => [
                'class' => CheckoutComOnboardEntity::class,
                'name' => 'Onboard Entity',
                'description' => 'Onboard an entity so they can start using Checkout services.

Official Checkout.com endpoint: POST /accounts/entities.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Used to describe the type of content the client can interpret. Use the schema_version value to specify the payload format. The latest version is 3.0.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_sub_entity_members' => [
                'class' => CheckoutComGetSubEntityMembers::class,
                'name' => 'Get Sub Entity Members',
                'description' => 'Beta Retrieve information on all users of a sub-entity that has been invited through Hosted Onboarding. Only one user can be invited to onboard the sub-entity through Hosted Onboarding. To enable the Hosted Onboarding feature, contact your Account Manager.

Official Checkout.com endpoint: GET /accounts/entities/{entityId}/members.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the sub-entity',
                    ],
                ],
            ],
            'checkout_com_reinvite_sub_entity_members' => [
                'class' => CheckoutComReinviteSubEntityMembers::class,
                'name' => 'Reinvite Sub Entity Members',
                'description' => 'Beta Resend an invitation to the user of a sub-entity. The user will receive another email to continue their Hosted Onboarding application. An invitation can only be resent to the user originally registered to the sub-entity. To enable the Hosted Onboarding feature, contact your Account Manager.

Official Checkout.com endpoint: PUT /accounts/entities/{entityId}/members/{userId}.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the sub-entity',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the invited user.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_platforms_payment_instrument' => [
                'class' => CheckoutComGetPlatformsPaymentInstrument::class,
                'name' => 'Get Platforms Payment Instrument',
                'description' => 'Retrieve the details of a specific payment instrument used for sub-entity payouts.

Official Checkout.com endpoint: GET /accounts/entities/{entityId}/payment-instruments/{id}.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The sub-entity\'s ID.',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment instrument\'s ID.',
                    ],
                ],
            ],
            'checkout_com_update_platforms_payment_instrument' => [
                'class' => CheckoutComUpdatePlatformsPaymentInstrument::class,
                'name' => 'Update Platforms Payment Instrument',
                'description' => 'Set an existing payment instrument as default. This will make it the destination instrument when a scheduled payout is made. You can also update the label of a payment instrument.

Official Checkout.com endpoint: PATCH /accounts/entities/{entityId}/payment-instruments/{id}.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The sub-entity\'s ID.',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment instrument\'s ID.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_reserve_rule' => [
                'class' => CheckoutComGetReserveRule::class,
                'name' => 'Get Reserve Rule',
                'description' => 'Retrieve the details of a specific reserve rule.

Official Checkout.com endpoint: GET /accounts/entities/{entityId}/reserve-rules/{id}.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The sub-entity\'s ID.',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The reserve rule ID.',
                    ],
                ],
            ],
            'checkout_com_update_reserve_rule' => [
                'class' => CheckoutComUpdateReserveRule::class,
                'name' => 'Update Reserve Rule',
                'description' => 'Update an upcoming reserve rule. Only reserve rules that have never been active can be updated.

Official Checkout.com endpoint: PUT /accounts/entities/{entityId}/reserve-rules/{id}.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The sub-entity\'s ID.',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The reserve rule ID.',
                    ],
                    'if_match' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Identifies a specific version of a reserve rule to update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_entity_details' => [
                'class' => CheckoutComGetEntityDetails::class,
                'name' => 'Get Entity Details',
                'description' => 'Use this endpoint to retrieve an entity and its full details.

Official Checkout.com endpoint: GET /accounts/entities/{id}.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Used to describe the type of content the client can interpret. Use the schema_version value to specify the payload format. The latest version is 3.0.',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the entity.',
                    ],
                ],
            ],
            'checkout_com_update_entity_details' => [
                'class' => CheckoutComUpdateEntityDetails::class,
                'name' => 'Update Entity Details',
                'description' => 'Update an entity. **Note:** when you update a entity we may conduct further due diligence checks when necessary. During these checks, your payment capabilities will remain the same.

Official Checkout.com endpoint: PUT /accounts/entities/{id}.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Used to describe the type of content the client can interpret. Use the schema_version value to specify the payload format. The latest version is 3.0.',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the entity.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_add_platforms_payment_instrument' => [
                'class' => CheckoutComAddPlatformsPaymentInstrument::class,
                'name' => 'Add Platforms Payment Instrument',
                'description' => 'Create a bank account payment instrument for your sub-entity. You can use this payment instrument as a payout destination.

Official Checkout.com endpoint: POST /accounts/entities/{id}/payment-instruments.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The sub-entity\'s ID.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_query_platforms_payment_instruments' => [
                'class' => CheckoutComQueryPlatformsPaymentInstruments::class,
                'name' => 'Query Platforms Payment Instruments',
                'description' => 'Fetch all of the payment instruments for a sub-entity. You can filter by `status` to identify `verified` instruments that are ready to be used for Payouts.

Official Checkout.com endpoint: GET /accounts/entities/{id}/payment-instruments.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The sub-entity\'s ID.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                        'enum' => ['pending', 'verified', 'unverified'],
                    ],
                ],
            ],
            'checkout_com_get_sub_entitys_payout_schedule' => [
                'class' => CheckoutComGetSubEntitysPayoutSchedule::class,
                'name' => 'Get Sub Entitys Payout Schedule',
                'description' => 'You can schedule when your sub-entities receive their funds using our Platforms solution. Use this endpoint to retrieve information about a sub-entity\'s schedule.

Official Checkout.com endpoint: GET /accounts/entities/{id}/payout-schedules.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the sub-entity',
                    ],
                ],
            ],
            'checkout_com_put_sub_entitys_payout_schedule' => [
                'class' => CheckoutComPutSubEntitysPayoutSchedule::class,
                'name' => 'Put Sub Entitys Payout Schedule',
                'description' => 'You can schedule when your sub-entities receive their funds using our Platforms solution. Use this endpoint to update a sub-entity\'s schedule.

Official Checkout.com endpoint: PUT /accounts/entities/{id}/payout-schedules.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the sub-entity',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_add_reserve_rule' => [
                'class' => CheckoutComAddReserveRule::class,
                'name' => 'Add Reserve Rule',
                'description' => 'Create a sub-entity reserve rule.

Official Checkout.com endpoint: POST /accounts/entities/{id}/reserve-rules.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The sub-entity\'s ID.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_query_reserve_rules' => [
                'class' => CheckoutComQueryReserveRules::class,
                'name' => 'Query Reserve Rules',
                'description' => 'Fetch all of the reserve rules for a sub-entity.

Official Checkout.com endpoint: GET /accounts/entities/{id}/reserve-rules.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The sub-entity\'s ID.',
                    ],
                ],
            ],
            'checkout_com_delegate_payment' => [
                'class' => CheckoutComDelegatePayment::class,
                'name' => 'Delegate Payment',
                'description' => 'Create a delegated payment token

Official Checkout.com endpoint: POST /agentic_commerce/delegate_payment.',
                'parameters' => [
                    'signature' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A Base64-encoded HMAC-SHA256 signature used for request body integrity verification. Compute the signature as follows: 1. Concatenate the `Timestamp` header value (as a UTF-8 string) with the raw JSON request body (as a UTF-8 string). 2. Compute the HMAC-SHA25',
                    ],
                    'timestamp' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The timestamp of the request, in RFC 3339 format (for example, `2026-03-11T10:30:00Z`). The timestamp must be within 5 minutes of the server time. Requests with a timestamp outside this window are rejected with a `401` response.',
                    ],
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'api_version' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The API version to use for the request. If not specified, the default version (`2026-01-30`) is used.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_aml_verification' => [
                'class' => CheckoutComCreateAmlVerification::class,
                'name' => 'Create AML Verification',
                'description' => 'Beta Create an [AML screening](https://www.checkout.com/docs/business-operations/manage-identities/screen-aml-databases). If the request is successful, you receive a `201 Created` response with the AML screening resource.

Official Checkout.com endpoint: POST /aml-verifications.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_retrieve_aml_screening' => [
                'class' => CheckoutComRetrieveAmlScreening::class,
                'name' => 'Retrieve AML Screening',
                'description' => 'Get the detailed result of an [AML screening](https://www.checkout.com/docs/business-operations/manage-identities/screen-aml-databases).

Official Checkout.com endpoint: GET /aml-verifications/{aml_verification_id}.',
                'parameters' => [
                    'aml_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The AML screening\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_upload_apple_pay_certificate' => [
                'class' => CheckoutComUploadApplePayCertificate::class,
                'name' => 'Upload Apple Pay Certificate',
                'description' => 'Upload a payment processing certificate. This will allow you to start processing payments via Apple Pay.

Official Checkout.com endpoint: POST /applepay/certificates.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_apple_pay_enroll_merchant' => [
                'class' => CheckoutComApplePayEnrollMerchant::class,
                'name' => 'Apple Pay Enroll Merchant',
                'description' => 'Enroll a domain to the Apple Pay Service

Official Checkout.com endpoint: POST /applepay/enrollments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_generate_apple_pay_signing_request' => [
                'class' => CheckoutComGenerateApplePaySigningRequest::class,
                'name' => 'Generate Apple Pay Signing Request',
                'description' => 'Generate a certificate signing request. You\'ll need to upload this to your Apple Developer account to download a payment processing certificate.

Official Checkout.com endpoint: POST /applepay/signing-requests.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_entity_balances' => [
                'class' => CheckoutComGetEntityBalances::class,
                'name' => 'Get Entity Balances',
                'description' => 'Use this endpoint to retrieve balances for each sub-account in an entity. *Note:* The sub-account is referred to as _currency account_ in the API.

Official Checkout.com endpoint: GET /balances/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the entity.',
                    ],
                    'query' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The query to apply to limit the currency accounts.',
                    ],
                    'with_currency_account_id' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Specifies if the response should include the sub-account ID that corresponds to each set of balances.',
                    ],
                ],
            ],
            'checkout_com_compliance_requests_get_compliance_request' => [
                'class' => CheckoutComComplianceRequestsGetComplianceRequest::class,
                'name' => 'Compliance Requests Get Compliance Request',
                'description' => 'Retrieve an existing compliance request by payment ID.

Official Checkout.com endpoint: GET /compliance-requests/{payment_id}.',
                'parameters' => [
                    'payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The compliance request\'s payment ID.',
                    ],
                ],
            ],
            'checkout_com_compliance_requests_submit_compliance_request_response' => [
                'class' => CheckoutComComplianceRequestsSubmitComplianceRequestResponse::class,
                'name' => 'Compliance Requests Submit Compliance Request Response',
                'description' => 'Submit a response to a compliance request.

Official Checkout.com endpoint: POST /compliance-requests/{payment_id}.',
                'parameters' => [
                    'payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The compliance request\'s payment ID.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_request_an_access_token' => [
                'class' => CheckoutComRequestAnAccessToken::class,
                'name' => 'Request An Access Token',
                'description' => 'OAuth endpoint to exchange your access key ID and access key secret for an access token.

Official Checkout.com endpoint: POST /connect/token.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_customer' => [
                'class' => CheckoutComCreateCustomer::class,
                'name' => 'Create Customer',
                'description' => 'Store a customer\'s details in a customer object to reuse in future payments. When creating a customer, you can link payment instruments – the customer `id` returned can be passed as a source when making a payment.  **NOTE:** Specify a `default` instrument, otherwise the `instruments` array will not be saved on creation.

Official Checkout.com endpoint: POST /customers.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_customer_details' => [
                'class' => CheckoutComGetCustomerDetails::class,
                'name' => 'Get Customer Details',
                'description' => 'Returns the details of a customer and their payment instruments.

Official Checkout.com endpoint: GET /customers/{identifier}.',
                'parameters' => [
                    'identifier' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'The customer\'s ID or email',
                    ],
                ],
            ],
            'checkout_com_update_customer_details' => [
                'class' => CheckoutComUpdateCustomerDetails::class,
                'name' => 'Update Customer Details',
                'description' => 'Update the details of a customer and link payment instruments to them.

Official Checkout.com endpoint: PATCH /customers/{identifier}.',
                'parameters' => [
                    'identifier' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer\'s ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_delete_customer' => [
                'class' => CheckoutComDeleteCustomer::class,
                'name' => 'Delete Customer',
                'description' => 'Delete a customer and all of their linked payment instruments.

Official Checkout.com endpoint: DELETE /customers/{identifier}.',
                'parameters' => [
                    'identifier' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer\'s ID',
                    ],
                ],
            ],
            'checkout_com_get_disputes' => [
                'class' => CheckoutComGetDisputes::class,
                'name' => 'Get Disputes',
                'description' => 'Returns a list of all disputes against your business. The results will be returned in reverse chronological order, showing the last modified dispute (for example, where you\'ve recently added a piece of evidence) first. You can use the optional parameters below to skip or limit results.

Official Checkout.com endpoint: GET /disputes.',
                'parameters' => [
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The numbers of results to return',
                    ],
                    'skip' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of results to skip',
                    ],
                    'from' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The date and time from which to filter disputes, based on the dispute\'s `last_update` field',
                    ],
                    'to' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The date and time until which to filter disputes, based on the dispute\'s `last_update` field',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The unique identifier of the dispute',
                    ],
                    'entity_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated client entities. This works like a logical *OR* operator',
                    ],
                    'sub_entity_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated sub-entities. This works like a logical *OR* operator',
                    ],
                    'processing_channel_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated processing channels. This works like a logical *OR* operator.',
                    ],
                    'segment_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated segments. This works like a logical *OR* operator.',
                    ],
                    'statuses' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated statuses. This works like a logical *OR* operator',
                    ],
                    'payment_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The unique identifier of the payment',
                    ],
                    'payment_reference' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional reference (such as an order ID) that you can use later to identify the payment. Previously known as `TrackId`',
                    ],
                    'payment_arn' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The acquirer reference number (ARN) that you can use to query the issuing bank',
                    ],
                    'payment_mcc' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The merchant category code (MCC) of the payment (ISO 18245)',
                    ],
                    'this_channel_only' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'If `true`, only returns disputes of the specific channel that the secret key is associated with. Otherwise, returns all disputes for that business',
                    ],
                ],
            ],
            'checkout_com_get_dispute_details' => [
                'class' => CheckoutComGetDisputeDetails::class,
                'name' => 'Get Dispute Details',
                'description' => 'Returns all the details of a dispute using the dispute identifier.

Official Checkout.com endpoint: GET /disputes/{dispute_id}.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier',
                    ],
                ],
            ],
            'checkout_com_accept_dispute' => [
                'class' => CheckoutComAcceptDispute::class,
                'name' => 'Accept Dispute',
                'description' => 'If a dispute is legitimate, you can choose to accept it. This will close it for you and remove it from your list of open disputes. There are no further financial implications.

Official Checkout.com endpoint: POST /disputes/{dispute_id}/accept.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_provide_dispute_evidence' => [
                'class' => CheckoutComProvideDisputeEvidence::class,
                'name' => 'Provide Dispute Evidence',
                'description' => 'Provide dispute evidence

Official Checkout.com endpoint: PUT /disputes/{dispute_id}/evidence.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_dispute_evidence' => [
                'class' => CheckoutComGetDisputeEvidence::class,
                'name' => 'Get Dispute Evidence',
                'description' => 'Retrieves a list of the evidence submitted in response to a specific dispute.

Official Checkout.com endpoint: GET /disputes/{dispute_id}/evidence.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier.',
                    ],
                ],
            ],
            'checkout_com_submit_dispute_evidence' => [
                'class' => CheckoutComSubmitDisputeEvidence::class,
                'name' => 'Submit Dispute Evidence',
                'description' => 'With this final request, you can submit the evidence that you have previously provided. Make sure you have provided all the relevant information before using this request. You will not be able to amend your evidence once you have submitted it.

Official Checkout.com endpoint: POST /disputes/{dispute_id}/evidence.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_submit_dispute_arbitration_evidence' => [
                'class' => CheckoutComSubmitDisputeArbitrationEvidence::class,
                'name' => 'Submit Dispute Arbitration Evidence',
                'description' => 'Submits the previously provided arbitration evidence to the scheme. You cannot amend evidence after you submit with this endpoint. Ensure you have provided all of the required information.

Official Checkout.com endpoint: POST /disputes/{dispute_id}/evidence/arbitration.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_dispute_submitted_arbitration_evidence' => [
                'class' => CheckoutComGetDisputeSubmittedArbitrationEvidence::class,
                'name' => 'Get Dispute Submitted Arbitration Evidence',
                'description' => 'Retrieves the unique identifier of the PDF file containing all of the evidence submitted to escalate the dispute to arbitration. To retrieve the file\'s download link, call the `GET /files/{file_id}` [endpoint](https://api-reference.checkout.com/#operation/getFileInformation) with the returned file ID.

Official Checkout.com endpoint: GET /disputes/{dispute_id}/evidence/arbitration/submitted.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier.',
                    ],
                ],
            ],
            'checkout_com_get_dispute_submitted_evidence' => [
                'class' => CheckoutComGetDisputeSubmittedEvidence::class,
                'name' => 'Get Dispute Submitted Evidence',
                'description' => 'Retrieves the unique identifier of the PDF file containing all the evidence submitted to represent the dispute case. To retrieve the file\'s download link, call the `GET /files/{file_id}` [endpoint](https://api-reference.checkout.com/#operation/getFileInformation) with the returned file ID. Evidence submitted before February 2024 cannot be retrieved using this endpoint.

Official Checkout.com endpoint: GET /disputes/{dispute_id}/evidence/submitted.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier.',
                    ],
                ],
            ],
            'checkout_com_get_dispute_scheme_files' => [
                'class' => CheckoutComGetDisputeSchemeFiles::class,
                'name' => 'Get Dispute Scheme Files',
                'description' => 'Returns all of the scheme files of a dispute using the dispute identifier. Currently available only for VISA disputes.

Official Checkout.com endpoint: GET /disputes/{dispute_id}/schemefiles.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The dispute identifier',
                    ],
                ],
            ],
            'checkout_com_upload_a_file' => [
                'class' => CheckoutComUploadAFile::class,
                'name' => 'Upload A File',
                'description' => 'Upload a file

Official Checkout.com endpoint: POST /entities/{entityId}/files.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the sub-entity',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_retrieve_a_file' => [
                'class' => CheckoutComRetrieveAFile::class,
                'name' => 'Retrieve A File',
                'description' => 'Retrieve information about a previously uploaded file. Please note that the sub-domain – https://files.checkout.com – is slightly different to Checkout.com\'s other endpoints. See the documentation for more information.

Official Checkout.com endpoint: GET /entities/{entityId}/files/{fileId}.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the sub-entity',
                    ],
                    'file_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the file. The value is always prefixed with `file_`.',
                    ],
                ],
            ],
            'checkout_com_create_face_authentication' => [
                'class' => CheckoutComCreateFaceAuthentication::class,
                'name' => 'Create Face Authentication',
                'description' => 'Create a face authentication

Official Checkout.com endpoint: POST /face-authentications.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_retrieve_face_authentication' => [
                'class' => CheckoutComRetrieveFaceAuthentication::class,
                'name' => 'Retrieve Face Authentication',
                'description' => 'Beta Get the details of a [face authentication](https://www.checkout.com/docs/business-operations/manage-identities/authenticate-with-biometrics).

Official Checkout.com endpoint: GET /face-authentications/{face_authentication_id}.',
                'parameters' => [
                    'face_authentication_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The face authentication\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_anonymize_face_authentication' => [
                'class' => CheckoutComAnonymizeFaceAuthentication::class,
                'name' => 'Anonymize Face Authentication',
                'description' => 'Beta Remove the personal data in a [face authentication](https://www.checkout.com/docs/business-operations/manage-identities/authenticate-with-biometrics).

Official Checkout.com endpoint: POST /face-authentications/{face_authentication_id}/anonymize.',
                'parameters' => [
                    'face_authentication_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The face authentication\'s unique identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_fav_attempt' => [
                'class' => CheckoutComCreateFavAttempt::class,
                'name' => 'Create Fav Attempt',
                'description' => 'Create a face authentication attempt

Official Checkout.com endpoint: POST /face-authentications/{face_authentication_id}/attempts.',
                'parameters' => [
                    'face_authentication_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The face authentication\'s unique identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_list_fav_attempts' => [
                'class' => CheckoutComListFavAttempts::class,
                'name' => 'List Fav Attempts',
                'description' => 'Beta Get the details of all attempts for a specific [face authentication](https://www.checkout.com/docs/business-operations/manage-identities/authenticate-with-biometrics).

Official Checkout.com endpoint: GET /face-authentications/{face_authentication_id}/attempts.',
                'parameters' => [
                    'face_authentication_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The face authentication\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_get_fav_attempt' => [
                'class' => CheckoutComGetFavAttempt::class,
                'name' => 'Get Fav Attempt',
                'description' => 'Beta Get the details of a specific attempt for a [face authentication](https://www.checkout.com/docs/business-operations/manage-identities/authenticate-with-biometrics).

Official Checkout.com endpoint: GET /face-authentications/{face_authentication_id}/attempts/{attempt_id}.',
                'parameters' => [
                    'face_authentication_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The face authentication\'s unique identifier.',
                    ],
                    'attempt_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The attempt\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_upload_file' => [
                'class' => CheckoutComUploadFile::class,
                'name' => 'Upload File',
                'description' => 'Upload a file to use as evidence in a dispute. Your file must be in either JPEG/JPG, PNG or PDF format, and be no larger than 4MB.

Official Checkout.com endpoint: POST /files.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_file_information' => [
                'class' => CheckoutComGetFileInformation::class,
                'name' => 'Get File Information',
                'description' => 'Retrieve information about a file that was previously uploaded.

Official Checkout.com endpoint: GET /files/{file_id}.',
                'parameters' => [
                    'file_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The file identifier. It is always prefixed by `file_`.',
                    ],
                ],
            ],
            'checkout_com_get_financial_actions' => [
                'class' => CheckoutComGetFinancialActions::class,
                'name' => 'Get Financial Actions',
                'description' => 'Returns the list of financial actions and their details.

Official Checkout.com endpoint: GET /financial-actions.',
                'parameters' => [
                    'payment_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The ID of the payment you want to retrieve financial actions for. Required if `action_id` is not used.',
                    ],
                    'action_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The ID of the action you want to retrieve financial actions for. Required if `payment_id` is not used.',
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of results to retrieve per page. </br> For example, if the total result count is 50, and you use `limit=10`, you will need to iterate over 5 pages containing 10 results each to retrieve all of the reports that match your query.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A token used for pagination when a response contains results across multiple pages.',
                    ],
                ],
            ],
            'checkout_com_get_all_workflows' => [
                'class' => CheckoutComGetAllWorkflows::class,
                'name' => 'Get All Workflows',
                'description' => 'Get all workflows

Official Checkout.com endpoint: GET /workflows.',
                'parameters' => [],
            ],
            'checkout_com_add_workflow' => [
                'class' => CheckoutComAddWorkflow::class,
                'name' => 'Add Workflow',
                'description' => 'Add a new workflow

Official Checkout.com endpoint: POST /workflows.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_workflow' => [
                'class' => CheckoutComGetWorkflow::class,
                'name' => 'Get Workflow',
                'description' => 'Get the details of a workflow

Official Checkout.com endpoint: GET /workflows/{workflowId}.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                ],
            ],
            'checkout_com_remove_workflow' => [
                'class' => CheckoutComRemoveWorkflow::class,
                'name' => 'Remove Workflow',
                'description' => 'Removes a workflow so it is no longer being executed. Actions of already executed workflows will be still processed.

Official Checkout.com endpoint: DELETE /workflows/{workflowId}.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                ],
            ],
            'checkout_com_patch_workflow' => [
                'class' => CheckoutComPatchWorkflow::class,
                'name' => 'Patch Workflow',
                'description' => 'Update a workflow.

Official Checkout.com endpoint: PATCH /workflows/{workflowId}.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_add_workflow_action' => [
                'class' => CheckoutComAddWorkflowAction::class,
                'name' => 'Add Workflow Action',
                'description' => 'Adds a workflow action. Actions determine what the workflow will do when it is triggered.

Official Checkout.com endpoint: POST /workflows/{workflowId}/actions.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_update_workflow_action' => [
                'class' => CheckoutComUpdateWorkflowAction::class,
                'name' => 'Update Workflow Action',
                'description' => 'Update a workflow action.

Official Checkout.com endpoint: PUT /workflows/{workflowId}/actions/{workflowActionId}.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                    'workflow_action_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow action identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_remove_workflow_action' => [
                'class' => CheckoutComRemoveWorkflowAction::class,
                'name' => 'Remove Workflow Action',
                'description' => 'Removes a workflow action. Actions determine what the workflow will do when it is triggered.

Official Checkout.com endpoint: DELETE /workflows/{workflowId}/actions/{workflowActionId}.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                    'workflow_action_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow action identifier',
                    ],
                ],
            ],
            'checkout_com_add_workflow_condition' => [
                'class' => CheckoutComAddWorkflowCondition::class,
                'name' => 'Add Workflow Condition',
                'description' => 'Adds a workflow condition. Conditions determine when the workflow will trigger.

Official Checkout.com endpoint: POST /workflows/{workflowId}/conditions.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_update_workflow_condition' => [
                'class' => CheckoutComUpdateWorkflowCondition::class,
                'name' => 'Update Workflow Condition',
                'description' => 'Update a workflow condition.

Official Checkout.com endpoint: PUT /workflows/{workflowId}/conditions/{workflowConditionId}.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                    'workflow_condition_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow condition identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_remove_workflow_condition' => [
                'class' => CheckoutComRemoveWorkflowCondition::class,
                'name' => 'Remove Workflow Condition',
                'description' => 'Removes a workflow condition. Conditions determine when the workflow will trigger.

Official Checkout.com endpoint: DELETE /workflows/{workflowId}/conditions/{workflowConditionId}.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                    'workflow_condition_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow condition identifier',
                    ],
                ],
            ],
            'checkout_com_test_workflow' => [
                'class' => CheckoutComTestWorkflow::class,
                'name' => 'Test Workflow',
                'description' => 'Validate a workflow in our Sandbox environment.

Official Checkout.com endpoint: POST /workflows/{workflowId}/test.',
                'parameters' => [
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_event_types' => [
                'class' => CheckoutComGetEventTypes::class,
                'name' => 'Get Event Types',
                'description' => 'Get a list of sources and their events for building new workflows

Official Checkout.com endpoint: GET /workflows/event-types.',
                'parameters' => [],
            ],
            'checkout_com_get_workflow_event' => [
                'class' => CheckoutComGetWorkflowEvent::class,
                'name' => 'Get Workflow Event',
                'description' => 'Get the details of an event

Official Checkout.com endpoint: GET /workflows/events/{eventId}.',
                'parameters' => [
                    'event_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The event identifier',
                    ],
                ],
            ],
            'checkout_com_get_workflow_action_invocations' => [
                'class' => CheckoutComGetWorkflowActionInvocations::class,
                'name' => 'Get Workflow Action Invocations',
                'description' => 'Get the details of a workflow action executed for the specified event.

Official Checkout.com endpoint: GET /workflows/events/{eventId}/actions/{workflowActionId}.',
                'parameters' => [
                    'event_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The event identifier',
                    ],
                    'workflow_action_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The workflow action identifier',
                    ],
                ],
            ],
            'checkout_com_reflow_by_event' => [
                'class' => CheckoutComReflowByEvent::class,
                'name' => 'Reflow By Event',
                'description' => 'Reflows a past event denoted by the event ID and triggers the actions of any workflows with matching conditions.

Official Checkout.com endpoint: POST /workflows/events/{eventId}/reflow.',
                'parameters' => [
                    'event_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier for the event to be reflowed.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_reflow_by_event_and_workflow' => [
                'class' => CheckoutComReflowByEventAndWorkflow::class,
                'name' => 'Reflow By Event And Workflow',
                'description' => 'Reflows a past event by event ID and workflow ID. Triggers all the actions of a specific event and workflow combination if the event denoted by the event ID matches the workflow conditions.

Official Checkout.com endpoint: POST /workflows/events/{eventId}/workflow/{workflowId}/reflow.',
                'parameters' => [
                    'event_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier for the event to be reflowed.',
                    ],
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The identifier of the workflow whose actions you want to trigger.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_reflow_events' => [
                'class' => CheckoutComReflowEvents::class,
                'name' => 'Reflow Events',
                'description' => 'Reflow past events attached to multiple event IDs and workflow IDs, or to multiple subject IDs and workflow IDs. If you don\'t specify any workflow IDs, all matching workflows will be retriggered.

Official Checkout.com endpoint: POST /workflows/events/reflow.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_subject_events' => [
                'class' => CheckoutComGetSubjectEvents::class,
                'name' => 'Get Subject Events',
                'description' => 'Get all events that relate to a specific subject

Official Checkout.com endpoint: GET /workflows/events/subject/{subjectId}.',
                'parameters' => [
                    'subject_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The event identifier',
                    ],
                ],
            ],
            'checkout_com_reflow_by_subject' => [
                'class' => CheckoutComReflowBySubject::class,
                'name' => 'Reflow By Subject',
                'description' => 'Reflows the events associated with a subject ID (for example, a payment ID or a dispute ID) and triggers the actions of any workflows with matching conditions.

Official Checkout.com endpoint: POST /workflows/events/subject/{subjectId}/reflow.',
                'parameters' => [
                    'subject_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The subject identifier (for example, a payment ID or a dispute ID). The events associated with these subjects will be reflowed.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_reflow_by_subject_and_workflow' => [
                'class' => CheckoutComReflowBySubjectAndWorkflow::class,
                'name' => 'Reflow By Subject And Workflow',
                'description' => 'Reflows the events associated with a subject ID (for example, a payment ID or a dispute ID) and triggers the actions of the specified workflow if the conditions match.

Official Checkout.com endpoint: POST /workflows/events/subject/{subjectId}/workflow/{workflowId}/reflow.',
                'parameters' => [
                    'subject_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The subject identifier (for example, a payment ID or a dispute ID). The events associated with these subjects will be reflowed.',
                    ],
                    'workflow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The identifier of the workflow whose actions you want to trigger.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_fx_rates' => [
                'class' => CheckoutComGetFxRates::class,
                'name' => 'Get FX Rates',
                'description' => 'Get the indicative foreign exchange (FX) rates that Checkout.com uses to process payments for the following products: - Card Payouts - Daily acquiring >Note: Ensure that you have the relevant product enabled for your account. Otherwise, you receive a `403 Forbidden` error response.

Official Checkout.com endpoint: GET /forex/rates.',
                'parameters' => [
                    'product' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'product',
                        'enum' => ['card_payouts', 'daily_acquiring', 'scheme_acquiring'],
                    ],
                    'source' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'source',
                        'enum' => ['mastercard', 'visa'],
                    ],
                    'currency_pairs' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'currency_pairs',
                    ],
                    'processing_channel_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'processing_channel_id',
                    ],
                ],
            ],
            'checkout_com_forward_request' => [
                'class' => CheckoutComForwardRequest::class,
                'name' => 'Forward Request',
                'description' => 'Beta Forwards an API request to a third-party endpoint. For example, you can forward payment credentials you\'ve stored in our Vault to a third-party payment processor.

Official Checkout.com endpoint: POST /forward.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_forward_request' => [
                'class' => CheckoutComGetForwardRequest::class,
                'name' => 'Get Forward Request',
                'description' => 'Retrieve the details of a successfully forwarded API request. The details can be retrieved for up to 14 days after the request was initiated.

Official Checkout.com endpoint: GET /forward/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier of the forward request.',
                    ],
                ],
            ],
            'checkout_com_create_secret' => [
                'class' => CheckoutComCreateSecret::class,
                'name' => 'Create Secret',
                'description' => 'Create a new secret with a plaintext value. **Validation Rules:** - `name`: 1-64 characters, alphanumeric + underscore - `value`: max 8KB - `entity_id` (optional): when provided, secret is scoped to this entity **Response:** Returns metadata.

Official Checkout.com endpoint: POST /forward/secrets.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_list_secrets' => [
                'class' => CheckoutComListSecrets::class,
                'name' => 'List Secrets',
                'description' => 'Returns metadata for secrets scoped for client_id.

Official Checkout.com endpoint: GET /forward/secrets.',
                'parameters' => [],
            ],
            'checkout_com_update_secret' => [
                'class' => CheckoutComUpdateSecret::class,
                'name' => 'Update Secret',
                'description' => 'Update an existing secret. After updating, the version is automatically incremented. **Validation Rules:** - Only `value` and `entity_id` can be updated - `value`: max 8KB **Response:** Returns updated metadata with incremented version.

Official Checkout.com endpoint: PATCH /forward/secrets/{name}.',
                'parameters' => [
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Secret name.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_delete_secret' => [
                'class' => CheckoutComDeleteSecret::class,
                'name' => 'Delete Secret',
                'description' => 'Permanently delete a secret by name.

Official Checkout.com endpoint: DELETE /forward/secrets/{name}.',
                'parameters' => [
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Secret name.',
                    ],
                ],
            ],
            'checkout_com_google_pay_enroll_merchant' => [
                'class' => CheckoutComGooglePayEnrollMerchant::class,
                'name' => 'Google Pay Enroll Merchant',
                'description' => 'Enroll an entity to the Google Pay Service. You must accept the Google terms of service to use this feature.

Official Checkout.com endpoint: POST /googlepay/enrollments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_google_pay_register_domain' => [
                'class' => CheckoutComGooglePayRegisterDomain::class,
                'name' => 'Google Pay Register Domain',
                'description' => 'Associates a web domain with the specified enrolled entity.

Official Checkout.com endpoint: POST /googlepay/enrollments/{entity_id}/domain.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Unique identifier of the entity.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_google_pay_get_registered_domains' => [
                'class' => CheckoutComGooglePayGetRegisteredDomains::class,
                'name' => 'Google Pay Get Registered Domains',
                'description' => 'Retrieves all web domains registered for the specified entity.

Official Checkout.com endpoint: GET /googlepay/enrollments/{entity_id}/domains.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Unique identifier of the entity.',
                    ],
                ],
            ],
            'checkout_com_google_pay_get_enrollment_state' => [
                'class' => CheckoutComGooglePayGetEnrollmentState::class,
                'name' => 'Google Pay Get Enrollment State',
                'description' => 'Returns the current enrollment state of an entity.

Official Checkout.com endpoint: GET /googlepay/enrollments/{entity_id}/state.',
                'parameters' => [
                    'entity_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Unique identifier of the entity.',
                    ],
                ],
            ],
            'checkout_com_create_a_hosted_payments_session' => [
                'class' => CheckoutComCreateAHostedPaymentsSession::class,
                'name' => 'Create A Hosted Payments Session',
                'description' => 'Create a Hosted Payments Page session and pass through all the payment information, like the amount, currency, country and reference. To get started with our Hosted Payments Page, contact your solutions engineer or request support.

Official Checkout.com endpoint: POST /hosted-payments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_hosted_payments_page_details' => [
                'class' => CheckoutComGetHostedPaymentsPageDetails::class,
                'name' => 'Get Hosted Payments Page Details',
                'description' => 'Retrieve details about a specific Hosted Payments Page using the ID returned when it was created. In the response, you will see the status of the Hosted Payments Page. For more information, see the Hosted Payments Page documentation.

Official Checkout.com endpoint: GET /hosted-payments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'checkout_com_create_id_document_verification' => [
                'class' => CheckoutComCreateIdDocumentVerification::class,
                'name' => 'Create ID Document Verification',
                'description' => 'Beta Create an [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents) for an applicant. Ensure you use your ID Document Verification [configuration ID](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents#Configuration).

Official Checkout.com endpoint: POST /id-document-verifications.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_retrieve_id_document_verification' => [
                'class' => CheckoutComRetrieveIdDocumentVerification::class,
                'name' => 'Retrieve ID Document Verification',
                'description' => 'Beta Get the details of an existing [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents).

Official Checkout.com endpoint: GET /id-document-verifications/{id_document_verification_id}.',
                'parameters' => [
                    'id_document_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID document verification\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_anonymize_id_document_verification' => [
                'class' => CheckoutComAnonymizeIdDocumentVerification::class,
                'name' => 'Anonymize ID Document Verification',
                'description' => 'Beta Remove the personal data from an [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents).

Official Checkout.com endpoint: POST /id-document-verifications/{id_document_verification_id}/anonymize.',
                'parameters' => [
                    'id_document_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID document verification\'s unique identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_id_document_verification_attempt' => [
                'class' => CheckoutComCreateIdDocumentVerificationAttempt::class,
                'name' => 'Create ID Document Verification Attempt',
                'description' => 'Create an ID document verification attempt

Official Checkout.com endpoint: POST /id-document-verifications/{id_document_verification_id}/attempts.',
                'parameters' => [
                    'id_document_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID document verification\'s unique identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_list_attempts_id_document_verification' => [
                'class' => CheckoutComListAttemptsIdDocumentVerification::class,
                'name' => 'List Attempts ID Document Verification',
                'description' => 'Beta Get the details of all attempts for a specific [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents).

Official Checkout.com endpoint: GET /id-document-verifications/{id_document_verification_id}/attempts.',
                'parameters' => [
                    'id_document_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID document verification\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_get_id_document_verification_attempt' => [
                'class' => CheckoutComGetIdDocumentVerificationAttempt::class,
                'name' => 'Get ID Document Verification Attempt',
                'description' => 'Beta Get the details of a specific attempt for an [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents).

Official Checkout.com endpoint: GET /id-document-verifications/{id_document_verification_id}/attempts/{attempt_id}.',
                'parameters' => [
                    'id_document_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID document verification\'s unique identifier.',
                    ],
                    'attempt_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The attempt\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_pdf_id_document_verification' => [
                'class' => CheckoutComPdfIdDocumentVerification::class,
                'name' => 'Pdf ID Document Verification',
                'description' => 'Get ID document verification report

Official Checkout.com endpoint: GET /id-document-verifications/{id_document_verification_id}/pdf-report.',
                'parameters' => [
                    'id_document_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID document verification\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_create_applicant' => [
                'class' => CheckoutComCreateApplicant::class,
                'name' => 'Create Applicant',
                'description' => 'Create a profile for an [Identities applicant](https://www.checkout.com/docs/business-operations/manage-identities/manage-applicants).

Official Checkout.com endpoint: POST /applicants.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_retrieve_applicant' => [
                'class' => CheckoutComRetrieveApplicant::class,
                'name' => 'Retrieve Applicant',
                'description' => 'Get the details of an [applicant profile](https://www.checkout.com/docs/business-operations/manage-identities/manage-applicants).

Official Checkout.com endpoint: GET /applicants/{applicant_id}.',
                'parameters' => [
                    'applicant_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The applicant profile\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_update_applicant' => [
                'class' => CheckoutComUpdateApplicant::class,
                'name' => 'Update Applicant',
                'description' => 'Update the details of an [applicant profile](https://www.checkout.com/docs/business-operations/manage-identities/manage-applicants).

Official Checkout.com endpoint: PATCH /applicants/{applicant_id}.',
                'parameters' => [
                    'applicant_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The applicant profile\'s unique identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_anonymize_applicant' => [
                'class' => CheckoutComAnonymizeApplicant::class,
                'name' => 'Anonymize Applicant',
                'description' => 'Remove the personal data in an [applicant profile](https://www.checkout.com/docs/business-operations/manage-identities/manage-applicants).

Official Checkout.com endpoint: POST /applicants/{applicant_id}/anonymize.',
                'parameters' => [
                    'applicant_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The applicant profile\'s unique identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_and_start_identity_verification' => [
                'class' => CheckoutComCreateAndStartIdentityVerification::class,
                'name' => 'Create And Start Identity Verification',
                'description' => 'Create an identity verification and attempt

Official Checkout.com endpoint: POST /create-and-open-idv.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_identity_verification' => [
                'class' => CheckoutComCreateIdentityVerification::class,
                'name' => 'Create Identity Verification',
                'description' => 'Beta Create an [identity verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities) linked to an applicant. If successful, you receive a `201 Created` response with the identity verification resource. Ensure you use your identity verification [configuration ID](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities#Configuration).

Official Checkout.com endpoint: POST /identity-verifications.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_retrieve_identity_verification' => [
                'class' => CheckoutComRetrieveIdentityVerification::class,
                'name' => 'Retrieve Identity Verification',
                'description' => 'Beta Get the details of an existing [identity verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities).

Official Checkout.com endpoint: GET /identity-verifications/{identity_verification_id}.',
                'parameters' => [
                    'identity_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The identity verification\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_anonymize_identity_verification' => [
                'class' => CheckoutComAnonymizeIdentityVerification::class,
                'name' => 'Anonymize Identity Verification',
                'description' => 'Beta Remove the personal data in an [identity verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities).

Official Checkout.com endpoint: POST /identity-verifications/{identity_verification_id}/anonymize.',
                'parameters' => [
                    'identity_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The identity verification\'s unique identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_attempt' => [
                'class' => CheckoutComCreateAttempt::class,
                'name' => 'Create Attempt',
                'description' => 'Create an identity verification attempt

Official Checkout.com endpoint: POST /identity-verifications/{identity_verification_id}/attempts.',
                'parameters' => [
                    'identity_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The identity verification\'s unique identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_list_attempts' => [
                'class' => CheckoutComListAttempts::class,
                'name' => 'List Attempts',
                'description' => 'Beta Get all the attempts for a specific [identity verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities).

Official Checkout.com endpoint: GET /identity-verifications/{identity_verification_id}/attempts.',
                'parameters' => [
                    'identity_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The identity verification\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_get_attempt' => [
                'class' => CheckoutComGetAttempt::class,
                'name' => 'Get Attempt',
                'description' => 'Beta Get the details of a specific attempt for an [identity verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities).

Official Checkout.com endpoint: GET /identity-verifications/{identity_verification_id}/attempts/{attempt_id}.',
                'parameters' => [
                    'identity_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The identity verification\'s unique identifier.',
                    ],
                    'attempt_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The attempt\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_pdf_identity_verification' => [
                'class' => CheckoutComPdfIdentityVerification::class,
                'name' => 'Pdf Identity Verification',
                'description' => 'Get identity verification report

Official Checkout.com endpoint: GET /identity-verifications/{identity_verification_id}/pdf-report.',
                'parameters' => [
                    'identity_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The identity verification\'s unique identifier.',
                    ],
                ],
            ],
            'checkout_com_create_an_instrument' => [
                'class' => CheckoutComCreateAnInstrument::class,
                'name' => 'Create An Instrument',
                'description' => 'Create a payment instrument like card, bank, ach or sepa to use for future payments and payouts. The parameters you need to provide when creating a bank account payment instrument depend on the account\'s country and currency. See the payout formatting documentation, or use the `GET /validation/bank-accounts/{country}/{currency}` endpoint.

Official Checkout.com endpoint: POST /instruments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_instrument_details' => [
                'class' => CheckoutComGetInstrumentDetails::class,
                'name' => 'Get Instrument Details',
                'description' => 'Retrieve the details of a payment instrument.

Official Checkout.com endpoint: GET /instruments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The instrument ID',
                    ],
                ],
            ],
            'checkout_com_update_instrument' => [
                'class' => CheckoutComUpdateInstrument::class,
                'name' => 'Update Instrument',
                'description' => 'Update the details of a payment instrument.

Official Checkout.com endpoint: PATCH /instruments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The instrument ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_delete_instrument' => [
                'class' => CheckoutComDeleteInstrument::class,
                'name' => 'Delete Instrument',
                'description' => 'Delete a payment instrument.

Official Checkout.com endpoint: DELETE /instruments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the payment instrument to be deleted',
                    ],
                ],
            ],
            'checkout_com_request_cardholder_access_token' => [
                'class' => CheckoutComRequestCardholderAccessToken::class,
                'name' => 'Request Cardholder Access Token',
                'description' => 'OAuth endpoint to exchange your access key ID and access key secret for an access token.

Official Checkout.com endpoint: POST /issuing/access/connect/token.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_cardholder' => [
                'class' => CheckoutComCreateCardholder::class,
                'name' => 'Create Cardholder',
                'description' => 'Create a new cardholder that you can issue a card to at a later point.

Official Checkout.com endpoint: POST /issuing/cardholders.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_cardholder' => [
                'class' => CheckoutComGetCardholder::class,
                'name' => 'Get Cardholder',
                'description' => 'Retrieve the details for a cardholder you created previously.

Official Checkout.com endpoint: GET /issuing/cardholders/{cardholderId}.',
                'parameters' => [
                    'cardholder_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardholderId',
                    ],
                ],
            ],
            'checkout_com_update_cardholder' => [
                'class' => CheckoutComUpdateCardholder::class,
                'name' => 'Update Cardholder',
                'description' => 'Updates the details of an existing cardholder.

Official Checkout.com endpoint: PATCH /issuing/cardholders/{cardholderId}.',
                'parameters' => [
                    'cardholder_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardholderId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_cardholder_cards' => [
                'class' => CheckoutComGetCardholderCards::class,
                'name' => 'Get Cardholder Cards',
                'description' => 'Retrieves the cards issued to the specified cardholder. Card credentials are not returned in the response. The response is limited to a maximum of 150 cards.

Official Checkout.com endpoint: GET /issuing/cardholders/{cardholderId}/cards.',
                'parameters' => [
                    'cardholder_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardholderId',
                    ],
                    'statuses' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The card statuses to filter the results by. Cards matching any status in this list are returned. If the list is empty, all cards are returned. Format - Comma-separated list',
                    ],
                ],
            ],
            'checkout_com_create_card' => [
                'class' => CheckoutComCreateCard::class,
                'name' => 'Create Card',
                'description' => 'Creates a physical or virtual card and issues it to the specified cardholder.

Official Checkout.com endpoint: POST /issuing/cards.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying Issuing requests.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_card' => [
                'class' => CheckoutComGetCard::class,
                'name' => 'Get Card',
                'description' => 'Retrieves the details for a card you issued previously. The card\'s credentials are not returned in the response.

Official Checkout.com endpoint: GET /issuing/cards/{cardId}.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                ],
            ],
            'checkout_com_update_card' => [
                'class' => CheckoutComUpdateCard::class,
                'name' => 'Update Card',
                'description' => 'Update the details of an issued card. Only the fields for which you provide values will be updated. If you pass `null`, the existing value will be removed.

Official Checkout.com endpoint: PATCH /issuing/cards/{cardId}.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_enroll_card' => [
                'class' => CheckoutComEnrollCard::class,
                'name' => 'Enroll Card',
                'description' => 'Enrolls a card in 3D Secure (3DS). Additional information is requested from the cardholder through a 3DS challenge when performing a transaction. Two-factor authentication (2FA) is supported. For maximum security, we recommend using a combination of a one-time password (OTP) sent via SMS, along with a password or question and answer security pair.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/3ds-enrollment.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_update_card_enrollment_details' => [
                'class' => CheckoutComUpdateCardEnrollmentDetails::class,
                'name' => 'Update Card Enrollment Details',
                'description' => 'Updates a card\'s 3DS enrollment details. At least one of the fields is required.

Official Checkout.com endpoint: PATCH /issuing/cards/{cardId}/3ds-enrollment.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_card_enrollment_details' => [
                'class' => CheckoutComGetCardEnrollmentDetails::class,
                'name' => 'Get Card Enrollment Details',
                'description' => 'Retrieves a card\'s 3DS enrollment details.

Official Checkout.com endpoint: GET /issuing/cards/{cardId}/3ds-enrollment.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                ],
            ],
            'checkout_com_activate_card' => [
                'class' => CheckoutComActivateCard::class,
                'name' => 'Activate Card',
                'description' => 'Activates an `inactive` or `suspended` card so that incoming authorizations can be approved. Activating a renewed card will schedule the parent card for revocation the following day, and transfer all configurations to the newly activated card. This includes 3DS enrollment, card controls, control profiles and tokenisation.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/activate.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_card_credentials' => [
                'class' => CheckoutComGetCardCredentials::class,
                'name' => 'Get Card Credentials',
                'description' => 'Retrieves the credentials for a card you issued previously.

Official Checkout.com endpoint: GET /issuing/cards/{cardId}/credentials.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'credentials' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'credentials',
                        'enum' => ['number', 'cvc2', 'number,cvc2'],
                    ],
                ],
            ],
            'checkout_com_renew_card' => [
                'class' => CheckoutComRenewCard::class,
                'name' => 'Renew Card',
                'description' => 'Renew a card

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/renew.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_revoke_card' => [
                'class' => CheckoutComRevokeCard::class,
                'name' => 'Revoke Card',
                'description' => 'Revokes an `inactive`, `active`, or `suspended` card to permanently decline all incoming authorizations. This is a permanent action. Revoked cards cannot be reactivated.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/revoke.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_add_scheduled_revocation_date' => [
                'class' => CheckoutComAddScheduledRevocationDate::class,
                'name' => 'Add Scheduled Revocation Date',
                'description' => 'Schedules a card to be revoked at 00:00(UTC) on a specified date.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/schedule-revocation.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_delete_scheduled_revocation_date' => [
                'class' => CheckoutComDeleteScheduledRevocationDate::class,
                'name' => 'Delete Scheduled Revocation Date',
                'description' => 'Delete a card\'s scheduled revocation.

Official Checkout.com endpoint: DELETE /issuing/cards/{cardId}/schedule-revocation.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                ],
            ],
            'checkout_com_suspend_card' => [
                'class' => CheckoutComSuspendCard::class,
                'name' => 'Suspend Card',
                'description' => 'Suspends an `active` or `inactive` card to temporarily decline all incoming authorizations. A `suspended` card can be reactivated.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/suspend.',
                'parameters' => [
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'cardId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_control' => [
                'class' => CheckoutComCreateControl::class,
                'name' => 'Create Control',
                'description' => 'Creates a control and applies it to the specified target.

Official Checkout.com endpoint: POST /issuing/controls.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying Issuing requests.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_control_by_target' => [
                'class' => CheckoutComGetControlByTarget::class,
                'name' => 'Get Control By Target',
                'description' => 'Retrieves a list of spending controls applied to the specified target.

Official Checkout.com endpoint: GET /issuing/controls.',
                'parameters' => [
                    'target_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'target_id',
                    ],
                ],
            ],
            'checkout_com_get_control' => [
                'class' => CheckoutComGetControl::class,
                'name' => 'Get Control',
                'description' => 'Retrieves the details of an existing control.

Official Checkout.com endpoint: GET /issuing/controls/{controlId}.',
                'parameters' => [
                    'control_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlId',
                    ],
                    'card_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The unique identifier for the card you want to get the remaining cascading velocity control for.',
                    ],
                ],
            ],
            'checkout_com_update_control' => [
                'class' => CheckoutComUpdateControl::class,
                'name' => 'Update Control',
                'description' => 'Updates an existing control.

Official Checkout.com endpoint: PUT /issuing/controls/{controlId}.',
                'parameters' => [
                    'control_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_delete_control' => [
                'class' => CheckoutComDeleteControl::class,
                'name' => 'Delete Control',
                'description' => 'Removes an existing control from the target it was applied to. If you want to reapply an equivalent control to the target, you must create a new control.

Official Checkout.com endpoint: DELETE /issuing/controls/{controlId}.',
                'parameters' => [
                    'control_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlId',
                    ],
                ],
            ],
            'checkout_com_create_control_group' => [
                'class' => CheckoutComCreateControlGroup::class,
                'name' => 'Create Control Group',
                'description' => 'Creates a control group and applies it to the specified target.

Official Checkout.com endpoint: POST /issuing/controls/control-groups.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_control_group_by_target' => [
                'class' => CheckoutComGetControlGroupByTarget::class,
                'name' => 'Get Control Group By Target',
                'description' => 'Retrieves a list of control groups applied to the specified target.

Official Checkout.com endpoint: GET /issuing/controls/control-groups.',
                'parameters' => [
                    'target_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'target_id',
                    ],
                ],
            ],
            'checkout_com_get_control_group' => [
                'class' => CheckoutComGetControlGroup::class,
                'name' => 'Get Control Group',
                'description' => 'Retrieves the details of a control group you created previously.

Official Checkout.com endpoint: GET /issuing/controls/control-groups/{controlGroupId}.',
                'parameters' => [
                    'control_group_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlGroupId',
                    ],
                ],
            ],
            'checkout_com_delete_control_group' => [
                'class' => CheckoutComDeleteControlGroup::class,
                'name' => 'Delete Control Group',
                'description' => 'Removes the control group and all the controls it contains. If you want to reapply an equivalent control group to the card, you\'ll need to create a new control group.

Official Checkout.com endpoint: DELETE /issuing/controls/control-groups/{controlGroupId}.',
                'parameters' => [
                    'control_group_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlGroupId',
                    ],
                ],
            ],
            'checkout_com_create_control_profile' => [
                'class' => CheckoutComCreateControlProfile::class,
                'name' => 'Create Control Profile',
                'description' => 'Creates a control profile.

Official Checkout.com endpoint: POST /issuing/controls/control-profiles.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_control_profiles_by_target' => [
                'class' => CheckoutComGetControlProfilesByTarget::class,
                'name' => 'Get Control Profiles By Target',
                'description' => 'Retrieves a list of control profiles for the currently authenticated client, or for a specific card if a card ID is provided.

Official Checkout.com endpoint: GET /issuing/controls/control-profiles.',
                'parameters' => [
                    'target_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'target_id',
                    ],
                ],
            ],
            'checkout_com_get_control_profile' => [
                'class' => CheckoutComGetControlProfile::class,
                'name' => 'Get Control Profile',
                'description' => 'Retrieves the details of an existing control profile.

Official Checkout.com endpoint: GET /issuing/controls/control-profiles/{controlProfileId}.',
                'parameters' => [
                    'control_profile_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlProfileId',
                    ],
                ],
            ],
            'checkout_com_update_control_profile' => [
                'class' => CheckoutComUpdateControlProfile::class,
                'name' => 'Update Control Profile',
                'description' => 'Update the control profile

Official Checkout.com endpoint: PATCH /issuing/controls/control-profiles/{controlProfileId}.',
                'parameters' => [
                    'control_profile_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlProfileId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_delete_control_profile' => [
                'class' => CheckoutComDeleteControlProfile::class,
                'name' => 'Delete Control Profile',
                'description' => 'Removes the control profile. A control profile cannot be removed if it is used by a control.

Official Checkout.com endpoint: DELETE /issuing/controls/control-profiles/{controlProfileId}.',
                'parameters' => [
                    'control_profile_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlProfileId',
                    ],
                ],
            ],
            'checkout_com_add_target_to_control_profile' => [
                'class' => CheckoutComAddTargetToControlProfile::class,
                'name' => 'Add Target To Control Profile',
                'description' => 'Adds a target to an existing control profile.

Official Checkout.com endpoint: POST /issuing/controls/control-profiles/{controlProfileId}/add/{targetId}.',
                'parameters' => [
                    'control_profile_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlProfileId',
                    ],
                    'target_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'targetId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_remove_target_from_control_profile' => [
                'class' => CheckoutComRemoveTargetFromControlProfile::class,
                'name' => 'Remove Target From Control Profile',
                'description' => 'Removes a target from an existing control profile.

Official Checkout.com endpoint: POST /issuing/controls/control-profiles/{controlProfileId}/remove/{targetId}.',
                'parameters' => [
                    'control_profile_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'controlProfileId',
                    ],
                    'target_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'targetId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_digital_card' => [
                'class' => CheckoutComGetDigitalCard::class,
                'name' => 'Get Digital Card',
                'description' => 'Retrieves the details for a digital card.

Official Checkout.com endpoint: GET /issuing/digital-cards/{digitalCardId}.',
                'parameters' => [
                    'digital_card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'digitalCardId',
                    ],
                ],
            ],
            'checkout_com_create_dispute' => [
                'class' => CheckoutComCreateDispute::class,
                'name' => 'Create Dispute',
                'description' => 'Beta Create a dispute for an Issuing transaction. For full guidance, see [Manage Issuing disputes](https://www.checkout.com/docs/card-issuing/manage-cardholder-transactions/manage-issuing-disputes). The transaction must already be cleared and not refunded. For the card scheme to process the chargeback, you must submit the dispute using this endpoint.

Official Checkout.com endpoint: POST /issuing/disputes.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'An idempotency key for safely retrying requests.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_dispute' => [
                'class' => CheckoutComGetDispute::class,
                'name' => 'Get Dispute',
                'description' => 'Beta Retrieve the details of an [Issuing dispute](https://www.checkout.com/docs/card-issuing/manage-cardholder-transactions/manage-issuing-disputes).

Official Checkout.com endpoint: GET /issuing/disputes/{disputeId}.',
                'parameters' => [
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'disputeId',
                    ],
                ],
            ],
            'checkout_com_cancel_dispute' => [
                'class' => CheckoutComCancelDispute::class,
                'name' => 'Cancel Dispute',
                'description' => 'Beta Cancel an [Issuing dispute](https://www.checkout.com/docs/card-issuing/manage-cardholder-transactions/manage-issuing-disputes). If you decide not to proceed with a dispute, you can cancel it either: * Before you submit it * While the dispute `status` is `processing` and `status_reason` is `chargeback_pending` or `chargeback_processed` For more information, see Cancel a dispute.

Official Checkout.com endpoint: POST /issuing/disputes/{disputeId}/cancel.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'An idempotency key for safely retrying requests.',
                    ],
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'disputeId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_escalate_dispute' => [
                'class' => CheckoutComEscalateDispute::class,
                'name' => 'Escalate Dispute',
                'description' => 'Beta Escalate an [Issuing dispute](https://www.checkout.com/docs/card-issuing/manage-cardholder-transactions/manage-issuing-disputes) to pre-arbitration or arbitration.

Official Checkout.com endpoint: POST /issuing/disputes/{disputeId}/escalate.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'An idempotency key for safely retrying requests.',
                    ],
                    'dispute_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'disputeId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_simulate_authorization' => [
                'class' => CheckoutComSimulateAuthorization::class,
                'name' => 'Simulate Authorization',
                'description' => 'Simulate an authorization request with a card you issued previously.

Official Checkout.com endpoint: POST /issuing/simulate/authorizations.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_simulate_incremental_authorization' => [
                'class' => CheckoutComSimulateIncrementalAuthorization::class,
                'name' => 'Simulate Incremental Authorization',
                'description' => 'Simulate an incremental authorization request for an existing approved transaction. Incremental authorizations increase the total authorized amount of the transaction. For example, adding a restaurant bill to an existing hotel booking.

Official Checkout.com endpoint: POST /issuing/simulate/authorizations/{id}/authorizations.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_simulate_presentment' => [
                'class' => CheckoutComSimulatePresentment::class,
                'name' => 'Simulate Presentment',
                'description' => 'Simulate the clearing of an existing approved authorization.

Official Checkout.com endpoint: POST /issuing/simulate/authorizations/{id}/presentments.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_simulate_refund' => [
                'class' => CheckoutComSimulateRefund::class,
                'name' => 'Simulate Refund',
                'description' => 'Simulate the refund of an existing approved authorization, after it has been cleared.

Official Checkout.com endpoint: POST /issuing/simulate/authorizations/{id}/refunds.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_simulate_reversal' => [
                'class' => CheckoutComSimulateReversal::class,
                'name' => 'Simulate Reversal',
                'description' => 'Simulate the reversal of an existing approved authorization.

Official Checkout.com endpoint: POST /issuing/simulate/authorizations/{id}/reversals.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_simulate_oob_authentication' => [
                'class' => CheckoutComSimulateOobAuthentication::class,
                'name' => 'Simulate Oob Authentication',
                'description' => 'Simulate a request to your back-end from an out-of-band (OOB) authentication provider.

Official Checkout.com endpoint: POST /issuing/simulate/oob/authentication.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_transactions' => [
                'class' => CheckoutComGetTransactions::class,
                'name' => 'Get Transactions',
                'description' => 'Beta Returns a list of transactions based on the matching input parameters in reverse chronological order, with the most recent transactions shown first.

Official Checkout.com endpoint: GET /issuing/transactions.',
                'parameters' => [
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The maximum number of transactions returned (between 10-100). The default is 10.',
                    ],
                    'skip' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of transactions to skip. The default is 0.',
                    ],
                    'cardholder_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'cardholder_id',
                    ],
                    'card_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'card_id',
                    ],
                    'entity_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'entity_id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional filter for the transaction lifecycle status.',
                        'enum' => ['authorized', 'declined', 'canceled', 'cleared', 'refunded', 'disputed'],
                    ],
                    'from' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional start date filter for transactions, in ISO 8601 format.',
                    ],
                    'to' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional end date filter for transactions, in ISO 8601 format.',
                    ],
                ],
            ],
            'checkout_com_get_transaction_by_id' => [
                'class' => CheckoutComGetTransactionById::class,
                'name' => 'Get Transaction By ID',
                'description' => 'Beta Get the details of a transaction using its ID.

Official Checkout.com endpoint: GET /issuing/transactions/{transactionId}.',
                'parameters' => [
                    'transaction_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'transactionId',
                    ],
                ],
            ],
            'checkout_com_request_card_metadata' => [
                'class' => CheckoutComRequestCardMetadata::class,
                'name' => 'Request Card Metadata',
                'description' => 'Beta Returns a single metadata record for the card specified by the Primary Account Number (PAN), Bank Identification Number (BIN), token, or instrument supplied.

Official Checkout.com endpoint: POST /metadata/card.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_provision_network_token' => [
                'class' => CheckoutComProvisionNetworkToken::class,
                'name' => 'Provision Network Token',
                'description' => 'Beta Provisions a network token synchronously. If the merchant stores their cards with Checkout.com, then source ID can be used to request a network token for the given card. If the merchant does not store their cards with Checkout.com, then card details have to be provided.

Official Checkout.com endpoint: POST /network-tokens.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_network_token' => [
                'class' => CheckoutComGetNetworkToken::class,
                'name' => 'Get Network Token',
                'description' => 'Beta Given network token ID, this endpoint returns network token details: DPAN, expiry date, state, TRID and also card details like last four and expiry date.

Official Checkout.com endpoint: GET /network-tokens/{network_token_id}.',
                'parameters' => [
                    'network_token_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Unique token ID assigned by Checkout.com for each token',
                    ],
                ],
            ],
            'checkout_com_provision_cryptogram' => [
                'class' => CheckoutComProvisionCryptogram::class,
                'name' => 'Provision Cryptogram',
                'description' => 'Beta Using network token ID as an input, this endpoint returns token cryptogram.

Official Checkout.com endpoint: POST /network-tokens/{network_token_id}/cryptograms.',
                'parameters' => [
                    'network_token_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Unique token ID assigned by Checkout.com for each token',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_delete_network_token' => [
                'class' => CheckoutComDeleteNetworkToken::class,
                'name' => 'Delete Network Token',
                'description' => 'Beta This endpoint is for permanently deleting a network token. A network token should be deleted when a payment instrument it is associated with is removed from file or if the security of the token has been compromised.

Official Checkout.com endpoint: PATCH /network-tokens/{network_token_id}/delete.',
                'parameters' => [
                    'network_token_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Unique token ID assigned by Checkout.com for each token',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_request_a_payment_context' => [
                'class' => CheckoutComRequestAPaymentContext::class,
                'name' => 'Request A Payment Context',
                'description' => 'Send a Payment Context request.Note: Successful Payment Context requests will always return a 201 response.

Official Checkout.com endpoint: POST /payment-contexts.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_payment_context' => [
                'class' => CheckoutComGetPaymentContext::class,
                'name' => 'Get Payment Context',
                'description' => 'Returns all the Payment Context details.

Official Checkout.com endpoint: GET /payment-contexts/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'checkout_com_create_a_payment_link_session' => [
                'class' => CheckoutComCreateAPaymentLinkSession::class,
                'name' => 'Create A Payment Link Session',
                'description' => 'Create a Payment Link and pass through all the payment information, like the amount, currency, country and reference.

Official Checkout.com endpoint: POST /payment-links.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_payment_link_details' => [
                'class' => CheckoutComGetPaymentLinkDetails::class,
                'name' => 'Get Payment Link Details',
                'description' => 'Retrieve details about a specific Payment Link using its ID returned when the link was created. In the response, you will see the status of the Payment Link. For more information, see the Payment Links documentation.

Official Checkout.com endpoint: GET /payment-links/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'checkout_com_get_payment_methods' => [
                'class' => CheckoutComGetPaymentMethods::class,
                'name' => 'Get Payment Methods',
                'description' => 'Beta Get a list of all available payment methods for a specific Processing Channel ID.

Official Checkout.com endpoint: GET /payment-methods.',
                'parameters' => [
                    'processing_channel_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'processing_channel_id',
                    ],
                ],
            ],
            'checkout_com_create_payment_session' => [
                'class' => CheckoutComCreatePaymentSession::class,
                'name' => 'Create Payment Session',
                'description' => 'Creates a payment session. The values you provide in the request will be used to determine the payment methods available to Flow. Some payment methods may require you to provide specific values for certain fields. Refer to our documentation for more information. You must supply the unmodified response body when you initialize Flow.

Official Checkout.com endpoint: POST /payment-sessions.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_submit_payment_session' => [
                'class' => CheckoutComSubmitPaymentSession::class,
                'name' => 'Submit Payment Session',
                'description' => 'Submit a payment attempt for a payment session. This request works with the Flow handleSubmit callback, where you can perform a customized payment submission. You must send the unmodified response body as the response of the `handleSubmit` callback.

Official Checkout.com endpoint: POST /payment-sessions/{id}/submit.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Payment Sessions unique identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_and_submit_payment_session' => [
                'class' => CheckoutComCreateAndSubmitPaymentSession::class,
                'name' => 'Create And Submit Payment Session',
                'description' => 'Request a Payment Session with Payment

Official Checkout.com endpoint: POST /payment-sessions/complete.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_request_a_payment_or_payout' => [
                'class' => CheckoutComRequestAPaymentOrPayout::class,
                'name' => 'Request A Payment Or Payout',
                'description' => 'Send a payment or payout.Note: successful payout requests will always return a 202 response.

Official Checkout.com endpoint: POST /payments.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_payments_list' => [
                'class' => CheckoutComGetPaymentsList::class,
                'name' => 'Get Payments List',
                'description' => 'Beta Returns a list of your business\' payments that match the specified reference. Results are returned in reverse chronological order, with the most recent payments shown first. This will only return payments initiated from June 2022 onwards. Payments initiated before this date may return a `404` error code if you attempt to retrieve them.

Official Checkout.com endpoint: GET /payments.',
                'parameters' => [
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The numbers of results to retrieve',
                    ],
                    'skip' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of results to skip',
                    ],
                    'reference' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A reference, such as an order ID, that can be used to identify the payment',
                    ],
                ],
            ],
            'checkout_com_get_payment_details' => [
                'class' => CheckoutComGetPaymentDetails::class,
                'name' => 'Get Payment Details',
                'description' => 'Returns the details of the payment with the specified identifier string. If the payment method requires a redirection to a third party (e.g., 3D Secure), the redirect URL back to your site will include a `cko-session-id` query parameter containing a payment session ID that can be used to obtain the details of the payment, for example: https://example.com/success?cko-session-id=sid_ubfj2q76miwundwlk72vxt2i7q.

Official Checkout.com endpoint: GET /payments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment or payment session identifier',
                    ],
                ],
            ],
            'checkout_com_get_payment_actions' => [
                'class' => CheckoutComGetPaymentActions::class,
                'name' => 'Get Payment Actions',
                'description' => 'Returns all the actions associated with a payment ordered by processing date in descending order (latest first).

Official Checkout.com endpoint: GET /payments/{id}/actions.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment identifier',
                    ],
                ],
            ],
            'checkout_com_increment_payment_authorization' => [
                'class' => CheckoutComIncrementPaymentAuthorization::class,
                'name' => 'Increment Payment Authorization',
                'description' => 'Request an incremental authorization to increase the authorization amount or extend the authorization\'s validity period.

Official Checkout.com endpoint: POST /payments/{id}/authorizations.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_cancel_a_payment' => [
                'class' => CheckoutComCancelAPayment::class,
                'name' => 'Cancel A Payment',
                'description' => 'Cancels an upcoming retry, if there is one scheduled Cancellation requests are processed asynchronously. You can use [workflows](#tag/Workflows) to be notified if the cancellation is successful.

Official Checkout.com endpoint: POST /payments/{id}/cancellations.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique payment identifier.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_capture_a_payment' => [
                'class' => CheckoutComCaptureAPayment::class,
                'name' => 'Capture A Payment',
                'description' => 'Captures a payment if supported by the payment method. For card payments, capture requests are processed asynchronously. You can use [workflows](#tag/Workflows) to be notified if the capture is successful.

Official Checkout.com endpoint: POST /payments/{id}/captures.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_refund_a_payment' => [
                'class' => CheckoutComRefundAPayment::class,
                'name' => 'Refund A Payment',
                'description' => 'Refunds a payment if supported by the payment method. For card payments, refund requests are processed asynchronously. You can use [workflows](#tag/Workflows) to be notified if the refund is successful.

Official Checkout.com endpoint: POST /payments/{id}/refunds.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_reverse_payment' => [
                'class' => CheckoutComReversePayment::class,
                'name' => 'Reverse Payment',
                'description' => 'Returns funds back to the customer by automatically performing the appropriate payment action depending on the payment\'s status. For more information, see Reverse a payment.

Official Checkout.com endpoint: POST /payments/{id}/reversals.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier for the payment.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_void_a_payment' => [
                'class' => CheckoutComVoidAPayment::class,
                'name' => 'Void A Payment',
                'description' => 'Voids a payment if supported by the payment method. For card payments, void requests are processed asynchronously. You can use [workflows](#tag/Workflows) to be notified if the void is successful.

Official Checkout.com endpoint: POST /payments/{id}/voids.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'An optional idempotency key for safely retrying payment requests',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment identifier',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_search' => [
                'class' => CheckoutComSearch::class,
                'name' => 'Search',
                'description' => 'Beta Search and filter through your payment data to retrieve payments that match your query. If a search returns more results than the value specified in `limit`, additional results are returned in a new page. A link to the next page of results is returned in the response\'s `_links.next.href` field. For more information on search syntax, see the Search and filter payments documentation.

Official Checkout.com endpoint: POST /payments/search.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_a_payment_setup' => [
                'class' => CheckoutComCreateAPaymentSetup::class,
                'name' => 'Create A Payment Setup',
                'description' => 'Beta Creates a Payment Setup. To maximize the information available to the payment setup, create a Payment Setup as early as possible in the customer\'s journey. For example, create it the first time they land on the basket page.

Official Checkout.com endpoint: POST /payments/setups.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_update_a_payment_setup' => [
                'class' => CheckoutComUpdateAPaymentSetup::class,
                'name' => 'Update A Payment Setup',
                'description' => 'Beta Updates a Payment Setup. Update the Payment Setup whenever there are significant changes in the data relevant to the customer\'s transaction. For example, when the customer makes a change that impacts the total payment amount.

Official Checkout.com endpoint: PUT /payments/setups/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier of the Payment Setup to update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_a_payment_setup' => [
                'class' => CheckoutComGetAPaymentSetup::class,
                'name' => 'Get A Payment Setup',
                'description' => 'Beta Retrieves a Payment Setup by its unique identifier.

Official Checkout.com endpoint: GET /payments/setups/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier of the Payment Setup to retrieve.',
                    ],
                ],
            ],
            'checkout_com_confirm_a_payment_setup' => [
                'class' => CheckoutComConfirmAPaymentSetup::class,
                'name' => 'Confirm A Payment Setup',
                'description' => 'Beta Confirm a Payment Setup to begin processing the payment request with your chosen payment method.

Official Checkout.com endpoint: POST /payments/setups/{id}/confirm/{payment_method_name}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier of the Payment Setup.',
                    ],
                    'payment_method_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The name of the payment method to process the payment with (For example, `tabby`, `klarna`, `card`).',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_reports' => [
                'class' => CheckoutComGetReports::class,
                'name' => 'Get Reports',
                'description' => 'Returns the list of reports and their details.

Official Checkout.com endpoint: GET /reports.',
                'parameters' => [
                    'created_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filters reports to those created on or after the specified timestamp, in UTC. <br/>Format – ISO 8601 code',
                    ],
                    'created_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filters reports to those created before the specified timestamp, in UTC. <br/>Format – ISO 8601 code',
                    ],
                    'entity_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filters reports to those created for the specified entity. <br/>Sub-entity IDs are not supported.',
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of results you want to include per page. </br> For example, if there are 50 results and you set limit=10, you receive 5 pages each containing 10 results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A token used to paginate multiple pages of results.',
                    ],
                ],
            ],
            'checkout_com_get_report_details' => [
                'class' => CheckoutComGetReportDetails::class,
                'name' => 'Get Report Details',
                'description' => 'Use this endpoint to retrieve a specific report using its ID.

Official Checkout.com endpoint: GET /reports/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the report to retrieve.',
                    ],
                ],
            ],
            'checkout_com_get_report_file' => [
                'class' => CheckoutComGetReportFile::class,
                'name' => 'Get Report File',
                'description' => 'Use this endpoint to retrieve a specific file from a given report using their respective IDs.

Official Checkout.com endpoint: GET /reports/{id}/files/{fileId}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the report that the file belongs to.',
                    ],
                    'file_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the file to retrieve.',
                    ],
                ],
            ],
            'checkout_com_create_session' => [
                'class' => CheckoutComCreateSession::class,
                'name' => 'Create Session',
                'description' => 'Create a payment session to authenticate a cardholder before requesting a payment. Payment sessions can be linked to one or more payments (in the case of recurring and other merchant-initiated payments). The `next_actions` object in the response tells you which actions can be performed next.

Official Checkout.com endpoint: POST /sessions.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_session' => [
                'class' => CheckoutComGetSession::class,
                'name' => 'Get Session',
                'description' => 'Returns the details of the session with the specified identifier string.

Official Checkout.com endpoint: GET /sessions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Session ID',
                    ],
                    'channel' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally provide the type of channnel so you only get the relevant actions',
                        'enum' => ['browser', 'app'],
                    ],
                ],
            ],
            'checkout_com_update_session' => [
                'class' => CheckoutComUpdateSession::class,
                'name' => 'Update Session',
                'description' => 'Update a session by providing information about the environment.

Official Checkout.com endpoint: PUT /sessions/{id}/collect-data.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Session ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_complete_session' => [
                'class' => CheckoutComCompleteSession::class,
                'name' => 'Complete Session',
                'description' => 'Complete a session

Official Checkout.com endpoint: POST /sessions/{id}/complete.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Session ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_update_session_three_ds_method_completion' => [
                'class' => CheckoutComUpdateSessionThreeDsMethodCompletion::class,
                'name' => 'Update Session Three Ds Method Completion',
                'description' => 'Update the session\'s 3DS Method completion indicator based on the result of accessing the 3DS Method URL.

Official Checkout.com endpoint: PUT /sessions/{id}/issuer-fingerprint.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Session ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_request_a_token' => [
                'class' => CheckoutComRequestAToken::class,
                'name' => 'Request A Token',
                'description' => 'Exchange card details for a reference token that can be used later to request a card payment. Tokens are single use and expire after 15 minutes. To create a token, please authenticate using your public key. **Please note:** You should only use the `card` type for testing purposes.

Official Checkout.com endpoint: POST /tokens.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_create_transfer' => [
                'class' => CheckoutComCreateTransfer::class,
                'name' => 'Create Transfer',
                'description' => 'Initiate a transfer of funds from source entity to destination entity.

Official Checkout.com endpoint: POST /transfers.',
                'parameters' => [
                    'cko_idempotency_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'An idempotency key for safely retrying transfer requests',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
                    ],
                ],
            ],
            'checkout_com_get_transfer_details' => [
                'class' => CheckoutComGetTransferDetails::class,
                'name' => 'Get Transfer Details',
                'description' => 'Retrieve transfer details using the transfer identifier.

Official Checkout.com endpoint: GET /transfers/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The transfer identifier',
                    ],
                ],
            ],
            'checkout_com_get_bank_account_fields' => [
                'class' => CheckoutComGetBankAccountFields::class,
                'name' => 'Get Bank Account Fields',
                'description' => 'Returns the bank account field formatting required to create bank account instruments or perform payouts for the specified country and currency.

Official Checkout.com endpoint: GET /validation/bank-accounts/{country}/{currency}.',
                'parameters' => [
                    'country' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The two-letter <a href="https://www.checkout.com/docs/resources/codes/country-codes" target="_blank">ISO country code</a>',
                    ],
                    'currency' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The three-letter <a href="https://www.checkout.com/docs/resources/codes/currency-codes" target="_blank">ISO currency code</a>',
                    ],
                    'account_holder_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The type of account holder that will be used to filter the fields returned',
                        'enum' => ['individual', 'corporate', 'government'],
                    ],
                    'payment_network' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The banking network that will be used to filter the fields returned',
                        'enum' => ['local', 'sepa', 'fps', 'ach', 'fedwire', 'swift'],
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): CheckoutComService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new CheckoutComService(apiKey: $creds->get('checkout-com', 'api_key', '', $account), baseUrl: $creds->get('checkout-com', 'url', 'https://api.sandbox.checkout.com', $account), accessBaseUrl: $creds->get('checkout-com', 'access_url', 'https://access.sandbox.checkout.com', $account));
        }

        return app(CheckoutComService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/checkout-com.md'; }
    public function isIntegration(): bool { return true; }
}
