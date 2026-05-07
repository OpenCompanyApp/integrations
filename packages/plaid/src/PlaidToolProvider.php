<?php

namespace OpenCompany\Integrations\Plaid;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Plaid.
 *
 * Exposes the official Plaid OpenAPI operation set as endpoint-specific agent
 * tools and resolves account-specific credentials in multi-account hosts.
 */
class PlaidToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['client_id', 'secret'],
                'notes' => ['Plaid requires client_id, secret, and Plaid-Version headers.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'plaid';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Plaid',
            'description' => 'Banking, identity, transactions, transfers, income, and open finance APIs',
            'icon' => 'ph:bank',
            'logo' => 'ph:bank',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Plaid',
            'description' => 'Connect bank accounts and access Plaid products for Auth, Transactions, Identity, Assets, Liabilities, Income, Transfer, Signal, CRA, and more.',
            'icon' => 'ph:bank',
            'logo' => 'ph:bank',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://plaid.com/docs/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'placeholder' => 'Plaid client_id', 'required' => true],
            ['key' => 'secret', 'type' => 'secret', 'label' => 'Secret', 'placeholder' => 'Plaid secret', 'required' => true],
            ['key' => 'plaid_version', 'type' => 'text', 'label' => 'Plaid Version', 'placeholder' => '2020-09-14', 'default' => '2020-09-14', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://sandbox.plaid.com', 'default' => 'https://sandbox.plaid.com'],
        ];
    }

    /**
     * Verify Plaid credentials with the lightweight Categories endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $clientId = (string) ($config['client_id'] ?? '');
        $secret = (string) ($config['secret'] ?? '');
        $version = (string) ($config['plaid_version'] ?? '2020-09-14');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://sandbox.plaid.com'), '/');

        if ($clientId === '' || $secret === '') {
            return ['success' => false, 'error' => 'Plaid client ID and secret are required.'];
        }

        try {
            $response = Http::withHeaders([
                'PLAID-CLIENT-ID' => $clientId,
                'PLAID-SECRET' => $secret,
                'Plaid-Version' => $version,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->post($baseUrl.'/categories/get', []);

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Plaid API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Plaid at '.$baseUrl.'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'client_id' => 'required|string',
            'secret' => 'required|string',
            'plaid_version' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'required' => true],
            ['key' => 'secret', 'type' => 'secret', 'label' => 'Secret', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
  'plaid_asset_report_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportCreate',
    'type' => 'write',
    'name' => 'Create an Asset Report',
    'description' => 'The `/asset_report/create` endpoint initiates the process of creating an Asset Report, which can then be retrieved by passing the `asset_report_token` return value to the `/asse...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_asset_report_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportGet',
    'type' => 'read',
    'name' => 'Retrieve an Asset Report',
    'description' => 'The `/asset_report/get` endpoint retrieves the Asset Report in JSON format. Before calling `/asset_report/get`, you must first create the Asset Report using `/asset_report/creat...',
    'icon' => 'ph:bank',
  ),
  'plaid_asset_report_pdf_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportPdfGet',
    'type' => 'read',
    'name' => 'Retrieve a PDF Asset Report',
    'description' => 'The `/asset_report/pdf/get` endpoint retrieves the Asset Report in PDF format. Before calling `/asset_report/pdf/get`, you must first create the Asset Report using `/asset_repor...',
    'icon' => 'ph:bank',
  ),
  'plaid_asset_report_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportRefresh',
    'type' => 'write',
    'name' => 'Refresh an Asset Report',
    'description' => 'An Asset Report is an immutable snapshot of a user\'s assets. In order to "refresh" an Asset Report you created previously, you can use the `/asset_report/refresh` endpoint to cr...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_asset_report_filter' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportFilter',
    'type' => 'read',
    'name' => 'Filter Asset Report',
    'description' => 'By default, an Asset Report will contain all of the accounts on a given Item. In some cases, you may not want the Asset Report to contain all accounts. For example, you might ha...',
    'icon' => 'ph:bank',
  ),
  'plaid_asset_report_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportRemove',
    'type' => 'write',
    'name' => 'Delete an Asset Report',
    'description' => 'The `/item/remove` endpoint allows you to invalidate an `access_token`, meaning you will not be able to create new Asset Reports with it. Removing an Item does not affect any As...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_asset_report_audit_copy_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportAuditCopyCreate',
    'type' => 'write',
    'name' => 'Create Asset Report Audit Copy',
    'description' => 'Plaid can provide an Audit Copy of any Asset Report directly to a participating third party on your behalf. For example, Plaid can supply an Audit Copy directly to the GSEs on y...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_asset_report_audit_copy_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportAuditCopyGet',
    'type' => 'read',
    'name' => 'Retrieve an Asset Report Audit Copy',
    'description' => '`/asset_report/audit_copy/get` allows auditors to get a copy of an Asset Report that was previously shared via the `/asset_report/audit_copy/create` endpoint. The caller of `/as...',
    'icon' => 'ph:bank',
  ),
  'plaid_asset_report_audit_copy_pdf_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportAuditCopyPdfGet',
    'type' => 'read',
    'name' => 'Retrieve a PDF Asset Report Audit Copy',
    'description' => 'The `/asset_report/audit_copy/pdf/get` endpoint retrieves an Asset Report Audit Copy in PDF format. The caller must provide the `audit_copy_token` that was shared via the `/asse...',
    'icon' => 'ph:bank',
  ),
  'plaid_asset_report_audit_copy_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAssetReportAuditCopyRemove',
    'type' => 'write',
    'name' => 'Remove Asset Report Audit Copy',
    'description' => 'The `/asset_report/audit_copy/remove` endpoint allows you to remove an Audit Copy. Removing an Audit Copy invalidates the `audit_copy_token` associated with it, meaning both you...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_monitoring_insights_subscribe' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraMonitoringInsightsSubscribe',
    'type' => 'write',
    'name' => 'Subscribe to Monitoring Insights',
    'description' => 'This endpoint allows you to subscribe to insights for a user\'s linked CRA Item, which are updated between one and four times per day (best-effort). In the current Cash Flow Upda...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_monitoring_insights_unsubscribe' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraMonitoringInsightsUnsubscribe',
    'type' => 'write',
    'name' => 'Unsubscribe from Monitoring Insights',
    'description' => 'This endpoint allows you to unsubscribe from previously subscribed Monitoring Insights.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_monitoring_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraMonitoringInsightsGet',
    'type' => 'read',
    'name' => 'Retrieve a Monitoring Insights Report',
    'description' => 'This endpoint allows you to retrieve a Cash Flow Updates report by passing in the `user_id` referred to in the webhook you received.',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_audit_copy_token_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditAuditCopyTokenUpdate',
    'type' => 'write',
    'name' => 'Update an Audit Copy Token',
    'description' => 'The `/credit/audit_copy_token/update` endpoint updates an existing Audit Copy Token by adding the report tokens in the `report_tokens` field to the `audit_copy_token`. If the Au...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_partner_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraPartnerInsightsGet',
    'type' => 'read',
    'name' => 'Retrieve cash flow insights from the bank accounts used for income verification',
    'description' => '`/cra/partner_insights/get` returns cash flow insights for a specified user.',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_income_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportIncomeInsightsGet',
    'type' => 'read',
    'name' => 'Retrieve cash flow information from your user\'s banks',
    'description' => 'This endpoint allows you to retrieve the Income Insights report for your user. You should call this endpoint after you’ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPO...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_base_report_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportBaseReportGet',
    'type' => 'read',
    'name' => 'Retrieve a Base Report',
    'description' => 'This endpoint allows you to retrieve the Base Report for your user, allowing you to receive comprehensive bank account and cash flow data. You should call this endpoint after yo...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_pdf_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportPdfGet',
    'type' => 'read',
    'name' => 'Retrieve Consumer Reports as a PDF',
    'description' => '`/cra/check_report/pdf/get` retrieves the most recent Consumer Report in PDF format. By default, the most recent Base Report (if it exists) for the user will be returned. To req...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportCreate',
    'type' => 'write',
    'name' => 'Refresh or create a Consumer Report',
    'description' => 'Use `/cra/check_report/create` to refresh data in an existing report. A Consumer Report will last for 24 hours before expiring; you should call any `/get` endpoints on the repor...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_check_report_partner_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportPartnerInsightsGet',
    'type' => 'read',
    'name' => 'Retrieve cash flow insights from partners',
    'description' => 'This endpoint allows you to retrieve the Partner Insights report for your user. You should call this endpoint after you\'ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPOR...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_cashflow_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportCashflowInsightsGet',
    'type' => 'read',
    'name' => 'Retrieve cash flow insights from your user\'s banking data',
    'description' => 'This endpoint allows you to retrieve the Cashflow Insights report for your user. You should call this endpoint after you\'ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPO...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_lend_score_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportLendScoreGet',
    'type' => 'read',
    'name' => 'Retrieve the LendScore from your user\'s banking data',
    'description' => 'This endpoint allows you to retrieve the LendScore report for your user. You should call this endpoint after you\'ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPORT_READY...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_network_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportNetworkInsightsGet',
    'type' => 'read',
    'name' => 'Retrieve network attributes for the user',
    'description' => 'This endpoint allows you to retrieve the Network Insights product for your user. You should call this endpoint after you\'ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPO...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_verification_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportVerificationGet',
    'type' => 'read',
    'name' => 'Retrieve various home lending reports for a user.',
    'description' => 'This endpoint allows you to retrieve home lending reports for a user. To obtain a VoA or Employment Refresh report, you need to make sure that `cra_base_report` is included in t...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_check_report_verification_pdf_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCheckReportVerificationPdfGet',
    'type' => 'read',
    'name' => 'Retrieve Consumer Reports as a Verification PDF',
    'description' => 'The `/cra/check_report/verification/pdf/get` endpoint retrieves the most recent Consumer Report in PDF format, specifically formatted for Home Lending verification use cases. Be...',
    'icon' => 'ph:bank',
  ),
  'plaid_cra_loans_applications_register' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraLoansApplicationsRegister',
    'type' => 'write',
    'name' => 'Register loan applications and decisions.',
    'description' => '`/cra/loans/applications/register` registers loan applications and decisions.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_loans_register' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraLoansRegister',
    'type' => 'write',
    'name' => 'Register a list of loans to their applicants.',
    'description' => '`/cra/loans/register` registers a list of loans to their applicants.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_loans_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraLoansUpdate',
    'type' => 'write',
    'name' => 'Updates loan data.',
    'description' => '`/cra/loans/update` updates loan information such as the status and payment history.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_loans_unregister' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraLoansUnregister',
    'type' => 'write',
    'name' => 'Unregister a list of loans.',
    'description' => '`/cra/loans/unregister` indicates the loans have reached a final status and no further updates are expected.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cra_credit_profile_report_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCraCreditProfileReportGet',
    'type' => 'read',
    'name' => 'Retrieve the credit profile report for a user',
    'description' => '`/cra/credit_profile/report/get` retrieves a credit profile report for a user.',
    'icon' => 'ph:bank',
  ),
  'plaid_consumer_report_pdf_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidConsumerReportPdfGet',
    'type' => 'read',
    'name' => 'Retrieve a PDF Reports',
    'description' => 'Retrieves all existing CRB Bank Income and Base reports for the consumer in PDF format. Response is PDF binary data. The `request_id` is returned in the `Plaid-Request-ID` header.',
    'icon' => 'ph:bank',
  ),
  'plaid_oauth_token' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidOauthToken',
    'type' => 'write',
    'name' => 'Create or refresh an OAuth access token',
    'description' => '`/oauth/token` issues an access token and refresh token depending on the `grant_type` provided. This endpoint supports `Content-Type: application/x-www-form-urlencoded` as well ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_oauth_introspect' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidOauthIntrospect',
    'type' => 'read',
    'name' => 'Get metadata about an OAuth token',
    'description' => '`/oauth/introspect` returns metadata about an access token or refresh token. Note: This endpoint supports `Content-Type: application/x-www-form-urlencoded` as well as JSON. The ...',
    'icon' => 'ph:bank',
  ),
  'plaid_oauth_revoke' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidOauthRevoke',
    'type' => 'write',
    'name' => 'Revoke an OAuth token',
    'description' => '`/oauth/revoke` revokes an access or refresh token, preventing any further use. If a refresh token is revoked, all access and refresh tokens derived from it are also revoked, in...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_statements_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidStatementsList',
    'type' => 'read',
    'name' => 'Retrieve a list of all statements associated with an item.',
    'description' => 'The `/statements/list` endpoint retrieves a list of all statements associated with an item.',
    'icon' => 'ph:bank',
  ),
  'plaid_statements_download' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidStatementsDownload',
    'type' => 'read',
    'name' => 'Retrieve a single statement.',
    'description' => 'The `/statements/download` endpoint retrieves a single statement PDF in binary format. The response will contain a `Plaid-Content-Hash` header containing a SHA 256 checksum of t...',
    'icon' => 'ph:bank',
  ),
  'plaid_statements_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidStatementsRefresh',
    'type' => 'write',
    'name' => 'Refresh statements data.',
    'description' => '`/statements/refresh` initiates an on-demand extraction to fetch the statements for the provided dates.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_consent_events_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidConsentEventsGet',
    'type' => 'read',
    'name' => 'List a historical log of item consent events',
    'description' => 'List a historical log of Item consent events. Consent logs are only available for events occurring on or after November 7, 2024. Extremely recent events (occurring within the pa...',
    'icon' => 'ph:bank',
  ),
  'plaid_item_activity_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemActivityList',
    'type' => 'read',
    'name' => 'List a historical log of user consent events',
    'description' => 'List a historical log of user consent events',
    'icon' => 'ph:bank',
  ),
  'plaid_item_application_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemApplicationList',
    'type' => 'read',
    'name' => 'List a user’s connected applications',
    'description' => 'List a user’s connected applications',
    'icon' => 'ph:bank',
  ),
  'plaid_item_application_unlink' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemApplicationUnlink',
    'type' => 'read',
    'name' => 'Unlink a user’s connected application',
    'description' => 'Unlink a user’s connected application. On an unlink request, Plaid will immediately revoke the Application’s access to the User’s data. The User will have to redo the OAut...',
    'icon' => 'ph:bank',
  ),
  'plaid_item_application_scopes_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemApplicationScopesUpdate',
    'type' => 'write',
    'name' => 'Update the scopes of access for a particular application',
    'description' => 'Enable consumers to update product access on selected accounts for an application.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_application_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidApplicationGet',
    'type' => 'read',
    'name' => 'Retrieve information about a Plaid application',
    'description' => 'Allows financial institutions to retrieve information about Plaid clients for the purpose of building control-tower experiences',
    'icon' => 'ph:bank',
  ),
  'plaid_item_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemGet',
    'type' => 'read',
    'name' => 'Retrieve an Item',
    'description' => 'Returns information about the status of an Item.',
    'icon' => 'ph:bank',
  ),
  'plaid_user_account_session_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserAccountSessionGet',
    'type' => 'read',
    'name' => 'Retrieve User Account',
    'description' => 'This endpoint returns user permissioned account data, including identity and Item access tokens, for use with [Plaid Layer](https://plaid.com/docs/layer). Note that end users ar...',
    'icon' => 'ph:bank',
  ),
  'plaid_user_account_session_event_send' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserAccountSessionEventSend',
    'type' => 'read',
    'name' => 'Send User Account Session Event',
    'description' => 'This endpoint allows sending client-specific events related to Layer sessions for analytics and tracking purposes.',
    'icon' => 'ph:bank',
  ),
  'plaid_profile_network_status_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProfileNetworkStatusGet',
    'type' => 'read',
    'name' => 'Check a user\'s Plaid Network status',
    'description' => 'The `/profile/network_status/get` endpoint can be used to check whether Plaid has a matching profile for the user.',
    'icon' => 'ph:bank',
  ),
  'plaid_network_status_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidNetworkStatusGet',
    'type' => 'read',
    'name' => 'Check a user\'s Plaid Network status',
    'description' => 'The `/network/status/get` endpoint can be used to check whether Plaid has a matching profile for the user. This is useful for determining if a user is eligible for a streamlined...',
    'icon' => 'ph:bank',
  ),
  'plaid_auth_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAuthGet',
    'type' => 'read',
    'name' => 'Retrieve auth data',
    'description' => 'The `/auth/get` endpoint returns the bank account and bank identification numbers (such as routing numbers, for US accounts) associated with an Item\'s checking, savings, and cas...',
    'icon' => 'ph:bank',
  ),
  'plaid_auth_verify' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAuthVerify',
    'type' => 'read',
    'name' => 'Verify auth data',
    'description' => 'The `/auth/verify` endpoint verifies bank account and routing numbers and (optionally) account owner names against Plaid\'s database via [Database Auth](https://plaid.com/docs/au...',
    'icon' => 'ph:bank',
  ),
  'plaid_transactions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsGet',
    'type' => 'read',
    'name' => 'Get transaction data',
    'description' => 'Note: All new implementations are encouraged to use `/transactions/sync` rather than `/transactions/get`. `/transactions/sync` provides the same functionality as `/transactions/...',
    'icon' => 'ph:bank',
  ),
  'plaid_transactions_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsRefresh',
    'type' => 'write',
    'name' => 'Refresh transaction data',
    'description' => '`/transactions/refresh` is an optional endpoint that initiates an on-demand extraction to fetch the newest transactions for an Item. The on-demand extraction takes place in addi...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transactions_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransactionsCreate',
    'type' => 'write',
    'name' => 'Create sandbox transactions',
    'description' => 'Use the `/sandbox/transactions/create` endpoint to create new transactions for an existing Item. This endpoint can be used to add up to 10 transactions to any Item at a time. Th...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cashflow_report_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCashflowReportRefresh',
    'type' => 'write',
    'name' => 'Refresh transaction data in `cashflow_report`',
    'description' => '`/cashflow_report/refresh` is an endpoint that initiates an on-demand extraction to fetch the newest transactions for an item (given an `item_id`). The item must already have Ca...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_cashflow_report_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCashflowReportGet',
    'type' => 'read',
    'name' => 'Gets transaction data in `cashflow_report`',
    'description' => 'The `/cashflow_report/get` endpoint retrieves transactions data associated with an item. Transactions data is standardized across financial institutions. Transactions are return...',
    'icon' => 'ph:bank',
  ),
  'plaid_cashflow_report_transactions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCashflowReportTransactionsGet',
    'type' => 'read',
    'name' => 'Gets transaction data in cashflow_report',
    'description' => 'The `/cashflow_report/transactions/get` endpoint retrieves transactions data associated with an item. Transactions data is standardized across financial institutions. Transactio...',
    'icon' => 'ph:bank',
  ),
  'plaid_cashflow_report_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCashflowReportInsightsGet',
    'type' => 'read',
    'name' => 'Gets insights data in Cashflow Report',
    'description' => 'The `/cashflow_report/insights/get` endpoint retrieves insights data associated with an item. Insights are only calculated on credit and depository accounts.',
    'icon' => 'ph:bank',
  ),
  'plaid_transactions_recurring_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsRecurringGet',
    'type' => 'read',
    'name' => 'Fetch recurring transaction streams',
    'description' => 'The `/transactions/recurring/get` endpoint allows developers to receive a summary of the recurring outflow and inflow streams (expenses and deposits) from a user’s checking, s...',
    'icon' => 'ph:bank',
  ),
  'plaid_transactions_sync' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsSync',
    'type' => 'read',
    'name' => 'Get incremental transaction updates on an Item',
    'description' => 'The `/transactions/sync` endpoint retrieves transactions associated with an Item and can fetch updates using a cursor to track which updates have already been seen. For importan...',
    'icon' => 'ph:bank',
  ),
  'plaid_transactions_enrich' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsEnrich',
    'type' => 'read',
    'name' => 'Enrich locally-held transaction data',
    'description' => 'The `/transactions/enrich` endpoint enriches raw transaction data generated by your own banking products or retrieved from other non-Plaid sources.',
    'icon' => 'ph:bank',
  ),
  'plaid_user_transactions_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserTransactionsRefresh',
    'type' => 'write',
    'name' => 'Refresh user items for Transactions bundle',
    'description' => '`/user/transactions/refresh` is an optional endpoint that initiates an on-demand extraction to fetch the newest transactions for a User using the Transactions bundle. This bundl...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_user_financial_data_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserFinancialDataRefresh',
    'type' => 'write',
    'name' => 'Refresh user items for Financial-Insights bundle',
    'description' => '`/user/financial_data/refresh` is an optional endpoint that initiates an on-demand extraction to fetch the newest transactions for a User using the Financial Insights bundle. Th...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_institutions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidInstitutionsGet',
    'type' => 'read',
    'name' => 'Get details of all supported institutions',
    'description' => 'Returns a JSON response containing details on all financial institutions currently supported by Plaid. Because Plaid supports thousands of institutions, results are paginated. I...',
    'icon' => 'ph:bank',
  ),
  'plaid_institutions_search' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidInstitutionsSearch',
    'type' => 'read',
    'name' => 'Search institutions',
    'description' => 'Returns a JSON response containing details for institutions that match the query parameters, up to a maximum of ten institutions per query. Versioning note: API versions 2019-05...',
    'icon' => 'ph:bank',
  ),
  'plaid_institutions_get_by_id' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidInstitutionsGetById',
    'type' => 'read',
    'name' => 'Get details of an institution',
    'description' => 'Returns a JSON response containing details on a specified financial institution currently supported by Plaid. Versioning note: API versions 2019-05-29 and earlier allow use of t...',
    'icon' => 'ph:bank',
  ),
  'plaid_item_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemRemove',
    'type' => 'write',
    'name' => 'Remove an Item',
    'description' => 'The `/item/remove` endpoint allows you to remove an Item. Once removed, the `access_token`, as well as any processor tokens or bank account tokens associated with the Item, is n...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_item_products_terminate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemProductsTerminate',
    'type' => 'read',
    'name' => 'Terminate products for an Item',
    'description' => 'The `/item/products/terminate` endpoint allows you to terminate an Item. Once terminated, the `access_token` associated with the Item is no longer valid, billing for the Item\'s ...',
    'icon' => 'ph:bank',
  ),
  'plaid_item_handle_fraud_report' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemHandleFraudReport',
    'type' => 'read',
    'name' => 'Report fraud for an Item',
    'description' => 'Use this endpoint to create a fraud report and terminate the associated Item. The `access_token` associated with the Item will be deactivated and billing for the Item\'s products...',
    'icon' => 'ph:bank',
  ),
  'plaid_accounts_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAccountsGet',
    'type' => 'read',
    'name' => 'Retrieve accounts',
    'description' => 'The `/accounts/get` endpoint can be used to retrieve a list of accounts associated with any linked Item. Plaid will only return active bank accounts — that is, accounts that a...',
    'icon' => 'ph:bank',
  ),
  'plaid_categories_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCategoriesGet',
    'type' => 'read',
    'name' => '(Deprecated) Get legacy categories',
    'description' => 'Send a request to the `/categories/get` endpoint to get detailed information on legacy categories returned by Plaid. This endpoint does not require authentication. All implement...',
    'icon' => 'ph:bank',
  ),
  'plaid_sandbox_processor_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxProcessorTokenCreate',
    'type' => 'write',
    'name' => 'Create a test Item and processor token',
    'description' => 'Use the `/sandbox/processor_token/create` endpoint to create a valid `processor_token` for an arbitrary institution ID and test credentials. The created `processor_token` corres...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_public_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxPublicTokenCreate',
    'type' => 'write',
    'name' => 'Create a test Item',
    'description' => 'Use the `/sandbox/public_token/create` endpoint to create a valid `public_token` for an arbitrary institution ID, initial products, and test credentials. The created `public_tok...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_item_fire_webhook' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxItemFireWebhook',
    'type' => 'write',
    'name' => 'Fire a test webhook',
    'description' => 'The `/sandbox/item/fire_webhook` endpoint is used to test that code correctly handles webhooks. This endpoint can trigger the following webhooks: `DEFAULT_UPDATE`: Webhook to be...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_accounts_balance_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidAccountsBalanceGet',
    'type' => 'read',
    'name' => 'Retrieve real-time balance data',
    'description' => 'The `/accounts/balance/get` endpoint returns the real-time balance for each of an Item\'s accounts. While other endpoints, such as `/accounts/get`, return a balance object, `/acc...',
    'icon' => 'ph:bank',
  ),
  'plaid_identity_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityGet',
    'type' => 'read',
    'name' => 'Retrieve identity data',
    'description' => 'The `/identity/get` endpoint allows you to retrieve various account holder information on file with the financial institution, including names, emails, phone numbers, and addres...',
    'icon' => 'ph:bank',
  ),
  'plaid_identity_documents_uploads_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityDocumentsUploadsGet',
    'type' => 'read',
    'name' => 'Returns uploaded document identity',
    'description' => 'Use `/identity/documents/uploads/get` to retrieve identity details when using [Identity Document Upload](https://plaid.com/docs/identity/identity-document-upload/).',
    'icon' => 'ph:bank',
  ),
  'plaid_identity_match' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityMatch',
    'type' => 'read',
    'name' => 'Retrieve identity match score',
    'description' => 'The `/identity/match` endpoint generates a match score, which indicates how well the provided identity data matches the identity information on file with the account holder\'s fi...',
    'icon' => 'ph:bank',
  ),
  'plaid_identity_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityRefresh',
    'type' => 'write',
    'name' => 'Refresh identity data',
    'description' => '`/identity/refresh` is an optional endpoint for users of the Identity product. It initiates an on-demand extraction to fetch the most up to date Identity information from the Fi...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_dashboard_user_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidDashboardUserGet',
    'type' => 'read',
    'name' => 'Retrieve a dashboard user',
    'description' => 'The `/dashboard_user/get` endpoint provides details (such as email address) about a specific Dashboard user based on the `dashboard_user_id` field, which is returned in the `aud...',
    'icon' => 'ph:bank',
  ),
  'plaid_dashboard_user_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidDashboardUserList',
    'type' => 'read',
    'name' => 'List dashboard users',
    'description' => 'The `/dashboard_user/list` endpoint provides details (such as email address) all Dashboard users associated with your account. This can use used to audit or track the list of re...',
    'icon' => 'ph:bank',
  ),
  'plaid_identity_verification_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityVerificationCreate',
    'type' => 'write',
    'name' => 'Create a new Identity Verification',
    'description' => 'Create a new Identity Verification for the user specified by the `client_user_id` and/or `user_id` field. At least one of these two fields must be provided. The requirements and...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_identity_verification_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityVerificationGet',
    'type' => 'read',
    'name' => 'Retrieve Identity Verification',
    'description' => 'Retrieve a previously created Identity Verification.',
    'icon' => 'ph:bank',
  ),
  'plaid_identity_verification_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityVerificationList',
    'type' => 'read',
    'name' => 'List Identity Verifications',
    'description' => 'Filter and list Identity Verifications created by your account',
    'icon' => 'ph:bank',
  ),
  'plaid_identity_verification_retry' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityVerificationRetry',
    'type' => 'write',
    'name' => 'Retry an Identity Verification',
    'description' => 'Allow a customer to retry their Identity Verification',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_watchlist_screening_entity_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityCreate',
    'type' => 'write',
    'name' => 'Create a watchlist screening for an entity',
    'description' => 'Create a new entity watchlist screening to check your customer against watchlists defined in the associated entity watchlist program. If your associated program has ongoing scre...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_watchlist_screening_entity_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityGet',
    'type' => 'read',
    'name' => 'Get an entity screening',
    'description' => 'Retrieve an entity watchlist screening.',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_entity_history_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityHistoryList',
    'type' => 'read',
    'name' => 'List history for entity watchlist screenings',
    'description' => 'List all changes to the entity watchlist screening in reverse-chronological order. If the watchlist screening has not been edited, no history will be returned.',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_entity_hit_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityHitList',
    'type' => 'read',
    'name' => 'List hits for entity watchlist screenings',
    'description' => 'List all hits for the entity watchlist screening.',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_entity_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityList',
    'type' => 'read',
    'name' => 'List entity watchlist screenings',
    'description' => 'List all entity screenings.',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_entity_program_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityProgramGet',
    'type' => 'read',
    'name' => 'Get entity watchlist screening program',
    'description' => 'Get an entity watchlist screening program',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_entity_program_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityProgramList',
    'type' => 'read',
    'name' => 'List entity watchlist screening programs',
    'description' => 'List all entity watchlist screening programs',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_entity_review_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityReviewCreate',
    'type' => 'write',
    'name' => 'Create a review for an entity watchlist screening',
    'description' => 'Create a review for an entity watchlist screening. Reviews are compliance reports created by users in your organization regarding the relevance of potential hits found by Plaid.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_watchlist_screening_entity_review_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityReviewList',
    'type' => 'read',
    'name' => 'List reviews for entity watchlist screenings',
    'description' => 'List all reviews for a particular entity watchlist screening. Reviews are compliance reports created by users in your organization regarding the relevance of potential hits foun...',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_entity_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningEntityUpdate',
    'type' => 'write',
    'name' => 'Update an entity screening',
    'description' => 'Update an entity watchlist screening.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_watchlist_screening_individual_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualCreate',
    'type' => 'write',
    'name' => 'Create a watchlist screening for a person',
    'description' => 'Create a new Watchlist Screening to check your customer against watchlists defined in the associated Watchlist Program. If your associated program has ongoing screening enabled,...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_watchlist_screening_individual_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualGet',
    'type' => 'read',
    'name' => 'Retrieve an individual watchlist screening',
    'description' => 'Retrieve a previously created individual watchlist screening',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_individual_history_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualHistoryList',
    'type' => 'read',
    'name' => 'List history for individual watchlist screenings',
    'description' => 'List all changes to the individual watchlist screening in reverse-chronological order. If the watchlist screening has not been edited, no history will be returned.',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_individual_hit_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualHitList',
    'type' => 'read',
    'name' => 'List hits for individual watchlist screening',
    'description' => 'List all hits found by Plaid for a particular individual watchlist screening.',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_individual_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualList',
    'type' => 'read',
    'name' => 'List Individual Watchlist Screenings',
    'description' => 'List previously created watchlist screenings for individuals',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_individual_program_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualProgramGet',
    'type' => 'read',
    'name' => 'Get individual watchlist screening program',
    'description' => 'Get an individual watchlist screening program',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_individual_program_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualProgramList',
    'type' => 'read',
    'name' => 'List individual watchlist screening programs',
    'description' => 'List all individual watchlist screening programs',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_individual_review_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualReviewCreate',
    'type' => 'write',
    'name' => 'Create a review for an individual watchlist screening',
    'description' => 'Create a review for the individual watchlist screening. Reviews are compliance reports created by users in your organization regarding the relevance of potential hits found by P...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_watchlist_screening_individual_review_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualReviewList',
    'type' => 'read',
    'name' => 'List reviews for individual watchlist screenings',
    'description' => 'List all reviews for the individual watchlist screening.',
    'icon' => 'ph:bank',
  ),
  'plaid_watchlist_screening_individual_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWatchlistScreeningIndividualUpdate',
    'type' => 'write',
    'name' => 'Update individual watchlist screening',
    'description' => 'Update a specific individual watchlist screening. This endpoint can be used to add additional customer information, correct outdated information, add a reference id, assign the ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_beacon_account_risk_evaluate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconAccountRiskEvaluate',
    'type' => 'read',
    'name' => 'Evaluate risk of a bank account',
    'description' => 'Use `/beacon/account_risk/v1/evaluate` to get risk insights for a linked account.',
    'icon' => 'ph:bank',
  ),
  'plaid_beacon_user_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconUserCreate',
    'type' => 'write',
    'name' => 'Create a Beacon User',
    'description' => 'Create and scan a Beacon User against your Beacon Program, according to your program\'s settings. When you submit a new user to `/beacon/user/create`, several checks are performe...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_beacon_user_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconUserGet',
    'type' => 'read',
    'name' => 'Get a Beacon User',
    'description' => 'Fetch a Beacon User. The Beacon User is returned with all of their associated information and a `status` based on the Beacon Network duplicate record and fraud checks.',
    'icon' => 'ph:bank',
  ),
  'plaid_beacon_user_review' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconUserReview',
    'type' => 'read',
    'name' => 'Review a Beacon User',
    'description' => 'Update the status of a Beacon User. When updating a Beacon User\'s status via this endpoint, Plaid validates that the status change is consistent with the related state for this ...',
    'icon' => 'ph:bank',
  ),
  'plaid_beacon_report_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconReportCreate',
    'type' => 'write',
    'name' => 'Create a Beacon Report',
    'description' => 'Create a fraud report for a given Beacon User.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_beacon_report_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconReportList',
    'type' => 'read',
    'name' => 'List Beacon Reports for a Beacon User',
    'description' => 'Use the `/beacon/report/list` endpoint to view all Beacon Reports you created for a specific Beacon User. The reports returned by this endpoint are exclusively reports you creat...',
    'icon' => 'ph:bank',
  ),
  'plaid_beacon_report_syndication_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconReportSyndicationList',
    'type' => 'read',
    'name' => 'List Beacon Report Syndications for a Beacon User',
    'description' => 'Use the `/beacon/report_syndication/list` endpoint to view all Beacon Reports that have been syndicated to a specific Beacon User. This endpoint returns Beacon Report Syndicatio...',
    'icon' => 'ph:bank',
  ),
  'plaid_beacon_report_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconReportGet',
    'type' => 'read',
    'name' => 'Get a Beacon Report',
    'description' => 'Returns a Beacon report for a given Beacon report id.',
    'icon' => 'ph:bank',
  ),
  'plaid_beacon_report_syndication_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconReportSyndicationGet',
    'type' => 'read',
    'name' => 'Get a Beacon Report Syndication',
    'description' => 'Returns a Beacon Report Syndication for a given Beacon Report Syndication id.',
    'icon' => 'ph:bank',
  ),
  'plaid_beacon_user_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconUserUpdate',
    'type' => 'write',
    'name' => 'Update the identity data of a Beacon User',
    'description' => 'Update the identity data for a Beacon User in your Beacon Program or add new accounts to the Beacon User. Similar to `/beacon/user/create`, several checks are performed immediat...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_beacon_duplicate_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconDuplicateGet',
    'type' => 'read',
    'name' => 'Get a Beacon Duplicate',
    'description' => 'Returns a Beacon Duplicate for a given Beacon Duplicate id. A Beacon Duplicate represents a pair of similar Beacon Users within your organization. Two Beacon User revisions are ...',
    'icon' => 'ph:bank',
  ),
  'plaid_identity_verification_autofill_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIdentityVerificationAutofillCreate',
    'type' => 'write',
    'name' => 'Create autofill for an Identity Verification',
    'description' => 'Try to autofill an Identity Verification based of the provided phone number, date of birth and country of residence.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_beacon_user_history_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconUserHistoryList',
    'type' => 'read',
    'name' => 'List a Beacon User\'s history',
    'description' => 'List all changes to the Beacon User in reverse-chronological order.',
    'icon' => 'ph:bank',
  ),
  'plaid_beacon_user_account_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBeaconUserAccountInsightsGet',
    'type' => 'read',
    'name' => 'Get Account Insights for a Beacon User',
    'description' => 'Get Account Insights for all Accounts linked to this Beacon User. The insights for each account are computed based on the information that was last retrieved from the financial ...',
    'icon' => 'ph:bank',
  ),
  'plaid_protect_user_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProtectUserInsightsGet',
    'type' => 'read',
    'name' => 'Get Protect user insights',
    'description' => 'Use this endpoint to get basic information about a user as it relates to their fraud profile with Protect.',
    'icon' => 'ph:bank',
  ),
  'plaid_protect_report_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProtectReportCreate',
    'type' => 'write',
    'name' => 'Create a Protect report',
    'description' => 'Use this endpoint to create a Protect report to document fraud incidents, investigation outcomes, or other risk events. This endpoint allows you to report various types of incid...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_protect_compute' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProtectCompute',
    'type' => 'read',
    'name' => 'Compute Protect Trust Index Score',
    'description' => 'Use this endpoint to compute a Protect Trust Index score and retrieve fraud attributes. For link-session models, if the Link session is not yet complete, the endpoint returns HT...',
    'icon' => 'ph:bank',
  ),
  'plaid_protect_event_send' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProtectEventSend',
    'type' => 'read',
    'name' => 'Send a new event to enrich user data',
    'description' => 'Send a new event to enrich user data and optionally get a Trust Index score for the event.',
    'icon' => 'ph:bank',
  ),
  'plaid_protect_event_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProtectEventGet',
    'type' => 'read',
    'name' => 'Get information about a user event',
    'description' => 'Get information about a user event including Trust Index score and fraud attributes.',
    'icon' => 'ph:bank',
  ),
  'plaid_business_verification_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBusinessVerificationGet',
    'type' => 'read',
    'name' => 'Get a business verification',
    'description' => 'Retrieve the current state of a specific business verification.',
    'icon' => 'ph:bank',
  ),
  'plaid_business_verification_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBusinessVerificationCreate',
    'type' => 'write',
    'name' => 'Create a business verification',
    'description' => 'Create a new business verification to check a business\'s identity and risk profile.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_processor_auth_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorAuthGet',
    'type' => 'read',
    'name' => 'Retrieve Auth data',
    'description' => 'The `/processor/auth/get` endpoint returns the bank account and bank identification number (such as the routing number, for US accounts), for a checking, savings, or cash manage...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_account_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorAccountGet',
    'type' => 'read',
    'name' => 'Retrieve the account associated with a processor token',
    'description' => 'This endpoint returns the account associated with a given processor token. This endpoint retrieves cached information, rather than extracting fresh information from the institut...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_investments_holdings_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorInvestmentsHoldingsGet',
    'type' => 'read',
    'name' => 'Retrieve Investment Holdings',
    'description' => 'This endpoint returns the stock position data of the account associated with a given processor token.',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_investments_auth_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorInvestmentsAuthGet',
    'type' => 'read',
    'name' => 'Get investment account authentication data',
    'description' => 'The `/processor/investments/auth/get` endpoint allows you to retrieve information about the account authorized by a processor token, including account numbers, account owners, h...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_investments_transactions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorInvestmentsTransactionsGet',
    'type' => 'read',
    'name' => 'Get investment transactions data',
    'description' => 'The `/processor/investments/transactions/get` endpoint allows developers to retrieve up to 24 months of user-authorized transaction data for the investment account associated wi...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_transactions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorTransactionsGet',
    'type' => 'read',
    'name' => 'Get transaction data',
    'description' => 'The `/processor/transactions/get` endpoint allows developers to receive user-authorized transaction data for credit, depository, and some loan-type accounts (only those with acc...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_transactions_sync' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorTransactionsSync',
    'type' => 'read',
    'name' => 'Get incremental transaction updates on a processor token',
    'description' => 'The `/processor/transactions/sync` endpoint retrieves transactions associated with an Item and can fetch updates using a cursor to track which updates have already been seen. Fo...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_transactions_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorTransactionsRefresh',
    'type' => 'write',
    'name' => 'Refresh transaction data',
    'description' => '`/processor/transactions/refresh` is an optional endpoint for users of the Transactions product. It initiates an on-demand extraction to fetch the newest transactions for a proc...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_processor_transactions_recurring_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorTransactionsRecurringGet',
    'type' => 'read',
    'name' => 'Fetch recurring transaction streams',
    'description' => 'The `/processor/transactions/recurring/get` endpoint allows developers to receive a summary of the recurring outflow and inflow streams (expenses and deposits) from a user’s c...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_signal_evaluate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorSignalEvaluate',
    'type' => 'read',
    'name' => 'Evaluate a planned ACH transaction',
    'description' => 'Use `/processor/signal/evaluate` to evaluate a planned ACH transaction to get a return risk assessment and additional risk signals. `/processor/signal/evaluate` uses Rulesets th...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_signal_decision_report' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorSignalDecisionReport',
    'type' => 'write',
    'name' => 'Report whether you initiated an ACH transaction',
    'description' => 'After you call `/processor/signal/evaluate`, Plaid will normally infer the outcome from your Signal Rules. However, if you are not using Signal Rules, if the Signal Rules outcom...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_processor_signal_return_report' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorSignalReturnReport',
    'type' => 'read',
    'name' => 'Report a return for an ACH transaction',
    'description' => 'Call the `/processor/signal/return/report` endpoint to report a returned transaction that was previously sent to the `/processor/signal/evaluate` endpoint. Your feedback will be...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_signal_prepare' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorSignalPrepare',
    'type' => 'read',
    'name' => 'Opt-in a processor token to Signal',
    'description' => 'When a processor token is not initialized with `signal`, call `/processor/signal/prepare` to opt-in that processor token to the data collection process, which will improve the a...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_bank_transfer_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorBankTransferCreate',
    'type' => 'write',
    'name' => 'Create a bank transfer as a processor',
    'description' => 'Use the `/processor/bank_transfer/create` endpoint to initiate a new bank transfer as a processor',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_processor_liabilities_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorLiabilitiesGet',
    'type' => 'read',
    'name' => 'Retrieve Liabilities data',
    'description' => 'The `/processor/liabilities/get` endpoint returns various details about a loan or credit account. Liabilities data is available primarily for US financial institutions, with som...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_identity_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorIdentityGet',
    'type' => 'read',
    'name' => 'Retrieve Identity data',
    'description' => 'The `/processor/identity/get` endpoint allows you to retrieve various account holder information on file with the financial institution, including names, emails, phone numbers, ...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_identity_match' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorIdentityMatch',
    'type' => 'read',
    'name' => 'Retrieve identity match score',
    'description' => 'The `/processor/identity/match` endpoint generates a match score, which indicates how well the provided identity data matches the identity information on file with the account h...',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_balance_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorBalanceGet',
    'type' => 'read',
    'name' => 'Retrieve Balance data',
    'description' => 'The `/processor/balance/get` endpoint returns the real-time balance for each of an Item\'s accounts. While other endpoints may return a balance object, only `/processor/balance/g...',
    'icon' => 'ph:bank',
  ),
  'plaid_item_webhook_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemWebhookUpdate',
    'type' => 'write',
    'name' => 'Update Webhook URL',
    'description' => 'The POST `/item/webhook/update` allows you to update the webhook URL associated with an Item. This request triggers a [`WEBHOOK_UPDATE_ACKNOWLEDGED`](https://plaid.com/docs/api/...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_item_access_token_invalidate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemAccessTokenInvalidate',
    'type' => 'write',
    'name' => 'Invalidate access_token',
    'description' => 'By default, the `access_token` associated with an Item does not expire and should be stored in a persistent, secure manner. You can use the `/item/access_token/invalidate` endpo...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_webhook_verification_key_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWebhookVerificationKeyGet',
    'type' => 'read',
    'name' => 'Get webhook verification key',
    'description' => 'Plaid signs all outgoing webhooks and provides JSON Web Tokens (JWTs) so that you can verify the authenticity of any incoming webhooks to your application. A message signature i...',
    'icon' => 'ph:bank',
  ),
  'plaid_liabilities_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidLiabilitiesGet',
    'type' => 'read',
    'name' => 'Retrieve Liabilities data',
    'description' => 'The `/liabilities/get` endpoint returns various details about an Item with loan or credit accounts. Liabilities data is available primarily for US financial institutions, with s...',
    'icon' => 'ph:bank',
  ),
  'plaid_payment_initiation_recipient_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationRecipientCreate',
    'type' => 'write',
    'name' => 'Create payment recipient',
    'description' => 'Create a payment recipient for payment initiation. The recipient must be in Europe, within a country that is a member of the Single Euro Payment Area (SEPA) or a non-Eurozone co...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_payment_initiation_payment_reverse' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationPaymentReverse',
    'type' => 'read',
    'name' => 'Reverse an existing payment',
    'description' => 'Reverse a settled payment from a Plaid virtual account. The original payment must be in a settled state to be refunded. To refund partially, specify the amount as part of the re...',
    'icon' => 'ph:bank',
  ),
  'plaid_payment_initiation_recipient_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationRecipientGet',
    'type' => 'read',
    'name' => 'Get payment recipient',
    'description' => 'Get details about a payment recipient you have previously created.',
    'icon' => 'ph:bank',
  ),
  'plaid_payment_initiation_recipient_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationRecipientList',
    'type' => 'read',
    'name' => 'List payment recipients',
    'description' => 'The `/payment_initiation/recipient/list` endpoint list the payment recipients that you have previously created.',
    'icon' => 'ph:bank',
  ),
  'plaid_payment_initiation_payment_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationPaymentCreate',
    'type' => 'write',
    'name' => 'Create a payment',
    'description' => 'After creating a payment recipient, you can use the `/payment_initiation/payment/create` endpoint to create a payment to that recipient. Payments can be one-time or standing ord...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_create_payment_token' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreatePaymentToken',
    'type' => 'write',
    'name' => 'Create payment token',
    'description' => 'The `/payment_initiation/payment/token/create` endpoint has been deprecated. New Plaid customers will be unable to use this endpoint, and existing customers are encouraged to mi...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_payment_initiation_consent_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationConsentCreate',
    'type' => 'write',
    'name' => 'Create payment consent',
    'description' => 'The `/payment_initiation/consent/create` endpoint is used to create a payment consent, which can be used to initiate payments on behalf of the user. Payment consents are created...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_payment_initiation_consent_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationConsentGet',
    'type' => 'read',
    'name' => 'Get payment consent',
    'description' => 'The `/payment_initiation/consent/get` endpoint can be used to check the status of a payment consent, as well as to receive basic information such as recipient and constraints.',
    'icon' => 'ph:bank',
  ),
  'plaid_payment_initiation_consent_revoke' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationConsentRevoke',
    'type' => 'write',
    'name' => 'Revoke payment consent',
    'description' => 'The `/payment_initiation/consent/revoke` endpoint can be used to revoke the payment consent. Once the consent is revoked, it is not possible to initiate payments using it.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_payment_initiation_consent_payment_execute' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationConsentPaymentExecute',
    'type' => 'read',
    'name' => 'Execute a single payment using consent',
    'description' => 'The `/payment_initiation/consent/payment/execute` endpoint can be used to execute payments using payment consent.',
    'icon' => 'ph:bank',
  ),
  'plaid_sandbox_item_reset_login' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxItemResetLogin',
    'type' => 'write',
    'name' => 'Force a Sandbox Item into an error state',
    'description' => '`/sandbox/item/reset_login/` forces an Item into an `ITEM_LOGIN_REQUIRED` state in order to simulate an Item whose login is no longer valid. This makes it easy to test Link\'s [u...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_item_application_seed' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxItemApplicationSeed',
    'type' => 'write',
    'name' => 'Seed a connected application for a Permissions Manager sandbox item',
    'description' => '`/sandbox/item/application/seed` creates a test connected application on an existing Permissions Manager Item\'s login. The seeded application will appear in subsequent calls to ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_item_set_verification_status' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxItemSetVerificationStatus',
    'type' => 'write',
    'name' => 'Set verification status for Sandbox account',
    'description' => 'The `/sandbox/item/set_verification_status` endpoint can be used to change the verification status of an Item in in the Sandbox in order to simulate the Automated Micro-deposit ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_user_reset_login' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxUserResetLogin',
    'type' => 'write',
    'name' => 'Force item(s) for a Sandbox User into an error state',
    'description' => '`/sandbox/user/reset_login/` functions the same as `/sandbox/item/reset_login`, but will modify Items related to a User. This endpoint forces each Item into an `ITEM_LOGIN_REQUI...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_item_public_token_exchange' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemPublicTokenExchange',
    'type' => 'write',
    'name' => 'Exchange public token for an access token',
    'description' => 'Exchange a Link `public_token` for an API `access_token`. Link hands off the `public_token` client-side via the `onSuccess` callback once a user has successfully created an Item...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_item_create_public_token' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemCreatePublicToken',
    'type' => 'write',
    'name' => 'Create public token',
    'description' => 'Note: As of July 2020, the `/item/public_token/create` endpoint is deprecated. Instead, use `/link/token/create` with an `access_token` to create a Link token for use with [upda...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_user_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserCreate',
    'type' => 'write',
    'name' => 'Create user',
    'description' => 'For Plaid products and flows that use the user object, `/user/create` provides you a single token to access all data associated with the user. You must call this endpoint before...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_user_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserGet',
    'type' => 'read',
    'name' => 'Retrieve user identity and information',
    'description' => 'Get user details using a `user_id`. This endpoint only supports users that were created on the new user API flow, without a `user_token`. For more details, see [New User APIs](h...',
    'icon' => 'ph:bank',
  ),
  'plaid_user_identity_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserIdentityRemove',
    'type' => 'write',
    'name' => 'Remove user identity data',
    'description' => 'This endpoint allows customers to explicitly purge identity/PII data provided to Plaid for a given user. This is not exposed to customers by default, as it is meant for special ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_user_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserUpdate',
    'type' => 'write',
    'name' => 'Update user information',
    'description' => 'This endpoint updates user information for an existing `user_id` or `user_token`. If an existing `user_id` or `user_token` is missing fields required for a given use case (e.g. ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_user_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserRemove',
    'type' => 'write',
    'name' => 'Remove user',
    'description' => '`/user/remove` deletes a `user_id` or `user_token` and and associated information, including any Items associated with the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_user_products_terminate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserProductsTerminate',
    'type' => 'read',
    'name' => 'Terminate user-based products',
    'description' => '`/user/products/terminate` terminates user-based recurring subscriptions for a given client user. This will remove user-based products (Financial Management, Protect, and CRA pr...',
    'icon' => 'ph:bank',
  ),
  'plaid_user_items_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserItemsGet',
    'type' => 'read',
    'name' => 'Get Items associated with a User',
    'description' => 'Returns Items associated with a `user_id`, along with their corresponding statuses. Plaid associates an Item with a User when it has been successfully connected within a Link se...',
    'icon' => 'ph:bank',
  ),
  'plaid_user_items_associate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserItemsAssociate',
    'type' => 'read',
    'name' => 'Associate Items to a User',
    'description' => 'Associates Items to the target user. If an Item is already associated to another user, the Item will be disassociated with the existing user and associated to the target user. T...',
    'icon' => 'ph:bank',
  ),
  'plaid_user_items_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserItemsRemove',
    'type' => 'write',
    'name' => 'Remove Items from a User',
    'description' => 'Removes specific Items associated with a user. It is equivalent to calling `/item/remove` on each Item individually, but supports use cases (such as Plaid Check) where access to...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_user_third_party_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserThirdPartyTokenCreate',
    'type' => 'write',
    'name' => 'Create a third-party user token',
    'description' => 'This endpoint is used to create a third-party user token. This token can be shared with and used by a specified third-party client to access data associated with the user throug...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_user_third_party_token_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidUserThirdPartyTokenRemove',
    'type' => 'write',
    'name' => 'Remove a third-party user token',
    'description' => 'This endpoint is used to delete a third-party user token. Once removed, the token can longer be used to access data associated with the user. Any subsequent calls to retrieve in...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_sessions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditSessionsGet',
    'type' => 'read',
    'name' => 'Retrieve Link sessions for your user',
    'description' => 'This endpoint can be used for your end users after they complete the Link flow. This endpoint returns a list of Link sessions that your user completed, where each session includ...',
    'icon' => 'ph:bank',
  ),
  'plaid_payment_initiation_payment_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationPaymentGet',
    'type' => 'read',
    'name' => 'Get payment details',
    'description' => 'The `/payment_initiation/payment/get` endpoint can be used to check the status of a payment, as well as to receive basic information such as recipient and payment amount. In the...',
    'icon' => 'ph:bank',
  ),
  'plaid_payment_initiation_payment_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentInitiationPaymentList',
    'type' => 'read',
    'name' => 'List payments',
    'description' => 'The `/payment_initiation/payment/list` endpoint can be used to retrieve all created payments. By default, the 10 most recent payments are returned. You can request more payments...',
    'icon' => 'ph:bank',
  ),
  'plaid_investments_holdings_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidInvestmentsHoldingsGet',
    'type' => 'read',
    'name' => 'Get Investment holdings',
    'description' => 'The `/investments/holdings/get` endpoint allows developers to receive user-authorized stock position data for `investment`-type accounts.',
    'icon' => 'ph:bank',
  ),
  'plaid_investments_transactions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidInvestmentsTransactionsGet',
    'type' => 'read',
    'name' => 'Get investment transactions',
    'description' => 'The `/investments/transactions/get` endpoint allows developers to retrieve up to 24 months of user-authorized transaction data for investment accounts. Transactions are returned...',
    'icon' => 'ph:bank',
  ),
  'plaid_investments_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidInvestmentsRefresh',
    'type' => 'write',
    'name' => 'Refresh investment data',
    'description' => '`/investments/refresh` is an optional endpoint for users of the Investments product. It initiates an on-demand extraction to fetch the newest investment holdings and transaction...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_investments_auth_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidInvestmentsAuthGet',
    'type' => 'read',
    'name' => 'Get data needed to authorize an investments transfer',
    'description' => 'The `/investments/auth/get` endpoint allows developers to receive user-authorized data to facilitate the transfer of holdings',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorTokenCreate',
    'type' => 'write',
    'name' => 'Create processor token',
    'description' => 'Used to create a token suitable for sending to one of Plaid\'s partners to enable integrations. Note that Stripe partnerships use bank account tokens instead; see `/processor/str...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_processor_token_permissions_set' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorTokenPermissionsSet',
    'type' => 'write',
    'name' => 'Control a processor\'s access to products',
    'description' => 'Used to control a processor\'s access to products on the given processor token. By default, a processor will have access to all available products on the corresponding item. To r...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_processor_token_permissions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorTokenPermissionsGet',
    'type' => 'read',
    'name' => 'Get a processor token\'s product permissions',
    'description' => 'Used to get a processor token\'s product permissions. The `products` field will be an empty list if the processor can access all available products.',
    'icon' => 'ph:bank',
  ),
  'plaid_processor_token_webhook_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorTokenWebhookUpdate',
    'type' => 'write',
    'name' => 'Update a processor token\'s webhook URL',
    'description' => 'This endpoint allows you, the processor, to update the webhook URL associated with a processor token. This request triggers a `WEBHOOK_UPDATE_ACKNOWLEDGED` webhook to the newly ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_processor_stripe_bank_account_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorStripeBankAccountTokenCreate',
    'type' => 'write',
    'name' => 'Create Stripe bank account token',
    'description' => 'Used to create a token suitable for sending to Stripe to enable Plaid-Stripe integrations. For a detailed guide on integrating Stripe, see [Add Stripe to your app](https://plaid...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_processor_apex_processor_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidProcessorApexProcessorTokenCreate',
    'type' => 'write',
    'name' => 'Create Apex bank account token',
    'description' => 'Used to create a token suitable for sending to Apex to enable Plaid-Apex integrations.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_item_import' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidItemImport',
    'type' => 'write',
    'name' => 'Import Item',
    'description' => '`/item/import` creates an Item via your Plaid Exchange Integration and returns an `access_token`. As part of an `/item/import` request, you will include a User ID (`user_auth.us...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_link_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidLinkTokenCreate',
    'type' => 'write',
    'name' => 'Create Link Token',
    'description' => 'The `/link/token/create` endpoint creates a `link_token`, which is required as a parameter when initializing Link. Once Link has been initialized, it returns a `public_token`. F...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_link_token_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidLinkTokenGet',
    'type' => 'read',
    'name' => 'Get Link Token',
    'description' => 'The `/link/token/get` endpoint gets information about a Link session, including all callbacks fired during the session along with their metadata, including the public token. Thi...',
    'icon' => 'ph:bank',
  ),
  'plaid_link_oauth_correlation_id_exchange' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidLinkOauthCorrelationIdExchange',
    'type' => 'write',
    'name' => 'Exchange the Link Correlation Id for a Link Token',
    'description' => 'Exchange an OAuth `link_correlation_id` for the corresponding `link_token`. The `link_correlation_id` is only available for `payment_initiation` products and is provided to the ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_session_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSessionTokenCreate',
    'type' => 'write',
    'name' => 'Create a Link token for Layer',
    'description' => '`/session/token/create` is used to create a Link token for Layer. The returned Link token is used as an parameter when initializing the Link SDK. For more details, see the [Link...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferGet',
    'type' => 'read',
    'name' => 'Retrieve a transfer',
    'description' => 'The `/transfer/get` endpoint fetches information about the transfer corresponding to the given `transfer_id` or `authorization_id`. One of `transfer_id` or `authorization_id` mu...',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_recurring_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRecurringGet',
    'type' => 'read',
    'name' => 'Retrieve a recurring transfer',
    'description' => 'The `/transfer/recurring/get` fetches information about the recurring transfer corresponding to the given `recurring_transfer_id`.',
    'icon' => 'ph:bank',
  ),
  'plaid_bank_transfer_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferGet',
    'type' => 'read',
    'name' => 'Retrieve a bank transfer',
    'description' => 'The `/bank_transfer/get` fetches information about the bank transfer corresponding to the given `bank_transfer_id`.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_authorization_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferAuthorizationCreate',
    'type' => 'write',
    'name' => 'Create a transfer authorization',
    'description' => 'Use the `/transfer/authorization/create` endpoint to authorize a transfer. This endpoint must be called prior to calling `/transfer/create`. The transfer authorization will expi...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_authorization_cancel' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferAuthorizationCancel',
    'type' => 'write',
    'name' => 'Cancel a transfer authorization',
    'description' => 'Use the `/transfer/authorization/cancel` endpoint to cancel a transfer authorization. A transfer authorization is eligible for cancellation if it has not yet been used to create...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_balance_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferBalanceGet',
    'type' => 'read',
    'name' => '(Deprecated) Retrieve a balance held with Plaid',
    'description' => '(Deprecated) Use the `/transfer/balance/get` endpoint to view a balance held with Plaid.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_capabilities_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferCapabilitiesGet',
    'type' => 'read',
    'name' => 'Get RTP eligibility information of a transfer',
    'description' => 'Use the `/transfer/capabilities/get` endpoint to determine the RTP eligibility information of an account to be used with Transfer. This endpoint works on all Transfer-capable It...',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_configuration_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferConfigurationGet',
    'type' => 'read',
    'name' => 'Get transfer product configuration',
    'description' => 'Use the `/transfer/configuration/get` endpoint to view your transfer product configurations.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_ledger_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferLedgerGet',
    'type' => 'read',
    'name' => 'Retrieve Plaid Ledger balance',
    'description' => 'Use the `/transfer/ledger/get` endpoint to view a balance on the ledger held with Plaid.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_ledger_distribute' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferLedgerDistribute',
    'type' => 'write',
    'name' => 'Move available balance between ledgers',
    'description' => 'Use the `/transfer/ledger/distribute` endpoint to move available balance between ledgers, if you have multiple. If you’re a platform, you can move funds between one of your le...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_ledger_deposit' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferLedgerDeposit',
    'type' => 'write',
    'name' => 'Deposit funds into a Plaid Ledger balance',
    'description' => 'Use the `/transfer/ledger/deposit` endpoint to deposit funds into Plaid Ledger.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_ledger_withdraw' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferLedgerWithdraw',
    'type' => 'write',
    'name' => 'Withdraw funds from a Plaid Ledger balance',
    'description' => 'Use the `/transfer/ledger/withdraw` endpoint to withdraw funds from a Plaid Ledger balance.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_originator_funding_account_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferOriginatorFundingAccountUpdate',
    'type' => 'write',
    'name' => 'Update the funding account associated with the originator',
    'description' => 'Use the `/transfer/originator/funding_account/update` endpoint to update the funding account associated with the originator.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_originator_funding_account_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferOriginatorFundingAccountCreate',
    'type' => 'write',
    'name' => 'Create a new funding account for an originator',
    'description' => 'Use the `/transfer/originator/funding_account/create` endpoint to create a new funding account for the originator.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_metrics_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferMetricsGet',
    'type' => 'read',
    'name' => 'Get transfer product usage metrics',
    'description' => 'Use the `/transfer/metrics/get` endpoint to view your transfer product usage metrics. In the Sandbox environment, this endpoint returns static placeholder values rather than met...',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferCreate',
    'type' => 'write',
    'name' => 'Create a transfer',
    'description' => 'Use the `/transfer/create` endpoint to initiate a new transfer. This endpoint is retryable and idempotent; if a transfer with the provided `transfer_id` has already been created...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_recurring_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRecurringCreate',
    'type' => 'write',
    'name' => 'Create a recurring transfer',
    'description' => 'Use the `/transfer/recurring/create` endpoint to initiate a new recurring transfer. This capability is not currently supported for Transfer UI or Transfer for Platforms (beta) c...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_bank_transfer_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferCreate',
    'type' => 'write',
    'name' => 'Create a bank transfer',
    'description' => 'Use the `/bank_transfer/create` endpoint to initiate a new bank transfer.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferList',
    'type' => 'read',
    'name' => 'List transfers',
    'description' => 'Use the `/transfer/list` endpoint to see a list of all your transfers and their statuses. Results are paginated; use the `count` and `offset` query parameters to retrieve the de...',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_recurring_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRecurringList',
    'type' => 'read',
    'name' => 'List recurring transfers',
    'description' => 'Use the `/transfer/recurring/list` endpoint to see a list of all your recurring transfers and their statuses. Results are paginated; use the `count` and `offset` query parameter...',
    'icon' => 'ph:bank',
  ),
  'plaid_bank_transfer_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferList',
    'type' => 'read',
    'name' => 'List bank transfers',
    'description' => 'Use the `/bank_transfer/list` endpoint to see a list of all your bank transfers and their statuses. Results are paginated; use the `count` and `offset` query parameters to retri...',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_cancel' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferCancel',
    'type' => 'write',
    'name' => 'Cancel a transfer',
    'description' => 'Use the `/transfer/cancel` endpoint to cancel a transfer. A transfer is eligible for cancellation if the `cancellable` property returned by `/transfer/get` is `true`.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_recurring_cancel' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRecurringCancel',
    'type' => 'write',
    'name' => 'Cancel a recurring transfer.',
    'description' => 'Use the `/transfer/recurring/cancel` endpoint to cancel a recurring transfer. Scheduled transfer that hasn\'t been submitted to bank will be cancelled.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_bank_transfer_cancel' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferCancel',
    'type' => 'write',
    'name' => 'Cancel a bank transfer',
    'description' => 'Use the `/bank_transfer/cancel` endpoint to cancel a bank transfer. A transfer is eligible for cancelation if the `cancellable` property returned by `/bank_transfer/get` is `true`.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_event_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferEventList',
    'type' => 'read',
    'name' => 'List transfer events',
    'description' => 'Use the `/transfer/event/list` endpoint to get a list of transfer events based on specified filter criteria.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_ledger_event_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferLedgerEventList',
    'type' => 'read',
    'name' => 'List transfer ledger events',
    'description' => 'Use the `/transfer/ledger/event/list` endpoint to get a list of ledger events for a specific ledger based on specified filter criteria.',
    'icon' => 'ph:bank',
  ),
  'plaid_bank_transfer_event_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferEventList',
    'type' => 'read',
    'name' => 'List bank transfer events',
    'description' => 'Use the `/bank_transfer/event/list` endpoint to get a list of Plaid-initiated ACH or bank transfer events based on specified filter criteria. When using Auth with micro-deposit ...',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_event_sync' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferEventSync',
    'type' => 'write',
    'name' => 'Sync transfer events',
    'description' => '`/transfer/event/sync` allows you to request up to the next 500 transfer events that happened after a specific `event_id`. Use the `/transfer/event/sync` endpoint to guarantee y...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_bank_transfer_event_sync' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferEventSync',
    'type' => 'write',
    'name' => 'Sync bank transfer events',
    'description' => '`/bank_transfer/event/sync` allows you to request up to the next 25 Plaid-initiated bank transfer events that happened after a specific `event_id`. When using Auth with micro-de...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_sweep_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferSweepGet',
    'type' => 'read',
    'name' => 'Retrieve a sweep',
    'description' => 'The `/transfer/sweep/get` endpoint fetches a sweep corresponding to the given `sweep_id`.',
    'icon' => 'ph:bank',
  ),
  'plaid_bank_transfer_sweep_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferSweepGet',
    'type' => 'read',
    'name' => 'Retrieve a sweep',
    'description' => 'The `/bank_transfer/sweep/get` endpoint fetches information about the sweep corresponding to the given `sweep_id`.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_sweep_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferSweepList',
    'type' => 'read',
    'name' => 'List sweeps',
    'description' => 'The `/transfer/sweep/list` endpoint fetches sweeps matching the given filters.',
    'icon' => 'ph:bank',
  ),
  'plaid_bank_transfer_sweep_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferSweepList',
    'type' => 'read',
    'name' => 'List sweeps',
    'description' => 'The `/bank_transfer/sweep/list` endpoint fetches information about the sweeps matching the given filters.',
    'icon' => 'ph:bank',
  ),
  'plaid_bank_transfer_balance_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferBalanceGet',
    'type' => 'read',
    'name' => 'Get balance of your Bank Transfer account',
    'description' => 'Use the `/bank_transfer/balance/get` endpoint to see the available balance in your bank transfer account. Debit transfers increase this balance once their status is posted. Cred...',
    'icon' => 'ph:bank',
  ),
  'plaid_bank_transfer_migrate_account' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBankTransferMigrateAccount',
    'type' => 'write',
    'name' => 'Migrate account into Bank Transfers',
    'description' => 'As an alternative to adding Items via Link, you can also use the `/bank_transfer/migrate_account` endpoint to migrate known account and routing numbers to Plaid Items. Note that...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_migrate_account' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferMigrateAccount',
    'type' => 'write',
    'name' => 'Migrate account into Transfers',
    'description' => 'As an alternative to adding Items via Link, you can also use the `/transfer/migrate_account` endpoint to migrate previously-verified account and routing numbers to Plaid Items. ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_intent_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferIntentCreate',
    'type' => 'write',
    'name' => 'Create a transfer intent object to invoke the Transfer UI',
    'description' => 'Use the `/transfer/intent/create` endpoint to generate a transfer intent object and invoke the Transfer UI.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_intent_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferIntentGet',
    'type' => 'read',
    'name' => 'Retrieve more information about a transfer intent',
    'description' => 'Use the `/transfer/intent/get` endpoint to retrieve more information about a transfer intent.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_repayment_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRepaymentList',
    'type' => 'read',
    'name' => 'Lists historical repayments',
    'description' => 'The `/transfer/repayment/list` endpoint fetches repayments matching the given filters. Repayments are returned in reverse-chronological order (most recent first) starting at the...',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_repayment_return_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRepaymentReturnList',
    'type' => 'read',
    'name' => 'List the returns included in a repayment',
    'description' => 'The `/transfer/repayment/return/list` endpoint retrieves the set of returns that were batched together into the specified repayment. The sum of amounts of returns retrieved by t...',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_platform_requirement_submit' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferPlatformRequirementSubmit',
    'type' => 'write',
    'name' => 'Submit additional onboarding information on behalf of an originator',
    'description' => 'Use the `/transfer/platform/requirement/submit` endpoint to submit additional onboarding information that is needed by Plaid to approve or decline the originator. See [Requireme...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_originator_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferOriginatorCreate',
    'type' => 'write',
    'name' => 'Create a new originator',
    'description' => 'Use the `/transfer/originator/create` endpoint to create a new originator and return an `originator_client_id`.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_questionnaire_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferQuestionnaireCreate',
    'type' => 'write',
    'name' => 'Generate a Plaid-hosted onboarding UI URL.',
    'description' => 'The `/transfer/questionnaire/create` endpoint generates a Plaid-hosted onboarding UI URL. Redirect the originator to this URL to provide their due diligence information and agre...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_diligence_submit' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferDiligenceSubmit',
    'type' => 'write',
    'name' => 'Submit transfer diligence on behalf of the originator',
    'description' => 'Use the `/transfer/diligence/submit` endpoint to submit transfer diligence on behalf of the originator (i.e., the end customer).',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_diligence_document_upload' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferDiligenceDocumentUpload',
    'type' => 'write',
    'name' => 'Upload transfer diligence document on behalf of the originator',
    'description' => 'Third-party sender customers can use `/transfer/diligence/document/upload` endpoint to upload a document on behalf of its end customer (i.e. originator) to Plaid. You’ll need ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_originator_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferOriginatorGet',
    'type' => 'read',
    'name' => 'Get status of an originator\'s onboarding',
    'description' => 'The `/transfer/originator/get` endpoint gets status updates for an originator\'s onboarding process. This information is also available via the Transfer page on the Plaid dashboard.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_originator_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferOriginatorList',
    'type' => 'read',
    'name' => 'Get status of all originators\' onboarding',
    'description' => 'The `/transfer/originator/list` endpoint gets status updates for all of your originators\' onboarding. This information is also available via the Plaid dashboard.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_refund_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRefundCreate',
    'type' => 'write',
    'name' => 'Create a refund',
    'description' => 'Use the `/transfer/refund/create` endpoint to create a refund for a transfer. A transfer can be refunded if the transfer was initiated in the past 180 days. Refunds come out of ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_refund_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRefundGet',
    'type' => 'read',
    'name' => 'Retrieve a refund',
    'description' => 'The `/transfer/refund/get` endpoint fetches information about the refund corresponding to the given `refund_id`.',
    'icon' => 'ph:bank',
  ),
  'plaid_transfer_refund_cancel' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferRefundCancel',
    'type' => 'write',
    'name' => 'Cancel a refund',
    'description' => 'Use the `/transfer/refund/cancel` endpoint to cancel a refund. A refund is eligible for cancellation if it has not yet been submitted to the payment network.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_platform_originator_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferPlatformOriginatorCreate',
    'type' => 'write',
    'name' => 'Create an originator for Transfer for Platforms customers',
    'description' => 'Use the `/transfer/platform/originator/create` endpoint to submit information about the originator you are onboarding, including the originator\'s agreement to the required legal...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transfer_platform_person_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransferPlatformPersonCreate',
    'type' => 'write',
    'name' => 'Create a person associated with an originator',
    'description' => 'Use the `/transfer/platform/person/create` endpoint to create a person associated with an originator (e.g. beneficial owner or control person) and optionally submit personal ide...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_bank_transfer_simulate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxBankTransferSimulate',
    'type' => 'write',
    'name' => 'Simulate a bank transfer event in Sandbox',
    'description' => 'Use the `/sandbox/bank_transfer/simulate` endpoint to simulate a bank transfer event in the Sandbox environment. Note that while an event will be simulated and will appear when ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_sweep_simulate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferSweepSimulate',
    'type' => 'write',
    'name' => 'Simulate creating a sweep',
    'description' => 'Use the `/sandbox/transfer/sweep/simulate` endpoint to create a sweep and associated events in the Sandbox environment. Upon calling this endpoint, all transfers with a sweep st...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_simulate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferSimulate',
    'type' => 'write',
    'name' => 'Simulate a transfer event in Sandbox',
    'description' => 'Use the `/sandbox/transfer/simulate` endpoint to simulate a transfer event in the Sandbox environment. Note that while an event will be simulated and will appear when using endp...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_refund_simulate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferRefundSimulate',
    'type' => 'write',
    'name' => 'Simulate a refund event in Sandbox',
    'description' => 'Use the `/sandbox/transfer/refund/simulate` endpoint to simulate a refund event in the Sandbox environment. Note that while an event will be simulated and will appear when using...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_ledger_simulate_available' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferLedgerSimulateAvailable',
    'type' => 'write',
    'name' => 'Simulate converting pending balance to available balance',
    'description' => 'Use the `/sandbox/transfer/ledger/simulate_available` endpoint to simulate converting pending balance to available balance for all originators in the Sandbox environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_ledger_deposit_simulate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferLedgerDepositSimulate',
    'type' => 'write',
    'name' => 'Simulate a ledger deposit event in Sandbox',
    'description' => 'Use the `/sandbox/transfer/ledger/deposit/simulate` endpoint to simulate a ledger deposit event in the Sandbox environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_ledger_withdraw_simulate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferLedgerWithdrawSimulate',
    'type' => 'write',
    'name' => 'Simulate a ledger withdraw event in Sandbox',
    'description' => 'Use the `/sandbox/transfer/ledger/withdraw/simulate` endpoint to simulate a ledger withdraw event in the Sandbox environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_repayment_simulate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferRepaymentSimulate',
    'type' => 'write',
    'name' => 'Trigger the creation of a repayment',
    'description' => 'Use the `/sandbox/transfer/repayment/simulate` endpoint to trigger the creation of a repayment. As a side effect of calling this route, a repayment is created that includes all ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_fire_webhook' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferFireWebhook',
    'type' => 'write',
    'name' => 'Manually fire a Transfer webhook',
    'description' => 'Use the `/sandbox/transfer/fire_webhook` endpoint to manually trigger a `TRANSFER_EVENTS_UPDATE` webhook in the Sandbox environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_test_clock_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferTestClockCreate',
    'type' => 'write',
    'name' => 'Create a test clock',
    'description' => 'Use the `/sandbox/transfer/test_clock/create` endpoint to create a `test_clock` in the Sandbox environment. A test clock object represents an independent timeline and has a `vir...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_test_clock_advance' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferTestClockAdvance',
    'type' => 'write',
    'name' => 'Advance a test clock',
    'description' => 'Use the `/sandbox/transfer/test_clock/advance` endpoint to advance a `test_clock` in the Sandbox environment. A test clock object represents an independent timeline and has a `v...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_transfer_test_clock_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferTestClockGet',
    'type' => 'read',
    'name' => 'Get a test clock',
    'description' => 'Use the `/sandbox/transfer/test_clock/get` endpoint to get a `test_clock` in the Sandbox environment.',
    'icon' => 'ph:bank',
  ),
  'plaid_sandbox_transfer_test_clock_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxTransferTestClockList',
    'type' => 'read',
    'name' => 'List test clocks',
    'description' => 'Use the `/sandbox/transfer/test_clock/list` endpoint to see a list of all your test clocks in the Sandbox environment, by ascending `virtual_time`. Results are paginated; use th...',
    'icon' => 'ph:bank',
  ),
  'plaid_sandbox_payment_profile_reset_login' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxPaymentProfileResetLogin',
    'type' => 'write',
    'name' => 'Reset the login of a Payment Profile',
    'description' => '`/sandbox/payment_profile/reset_login/` forces a Payment Profile into a state where the login is no longer valid. This makes it easy to test update mode for Payment Profile in t...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_payment_simulate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxPaymentSimulate',
    'type' => 'write',
    'name' => 'Simulate a payment event in Sandbox',
    'description' => 'Use the `/sandbox/payment/simulate` endpoint to simulate various payment events in the Sandbox environment. This endpoint will trigger the corresponding payment status webhook.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_employers_search' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidEmployersSearch',
    'type' => 'read',
    'name' => 'Search employer database',
    'description' => '`/employers/search` allows you the ability to search Plaid’s database of known employers, for use with Deposit Switch. You can use this endpoint to look up a user\'s employer i...',
    'icon' => 'ph:bank',
  ),
  'plaid_income_verification_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIncomeVerificationCreate',
    'type' => 'write',
    'name' => '(Deprecated) Create an income verification instance',
    'description' => '`/income/verification/create` begins the income verification process by returning an `income_verification_id`. You can then provide the `income_verification_id` to `/link/token/...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_income_verification_paystubs_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIncomeVerificationPaystubsGet',
    'type' => 'read',
    'name' => '(Deprecated) Retrieve information from the paystubs used for income verification',
    'description' => '`/income/verification/paystubs/get` returns the information collected from the paystubs that were used to verify an end user\'s income. It can be called once the status of the ve...',
    'icon' => 'ph:bank',
  ),
  'plaid_income_verification_documents_download' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIncomeVerificationDocumentsDownload',
    'type' => 'read',
    'name' => '(Deprecated) Download the original documents used for income verification',
    'description' => '`/income/verification/documents/download` provides the ability to download the source documents associated with the verification. If Document Income was used, the documents will...',
    'icon' => 'ph:bank',
  ),
  'plaid_income_verification_taxforms_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIncomeVerificationTaxformsGet',
    'type' => 'read',
    'name' => '(Deprecated) Retrieve information from the tax documents used for income verification',
    'description' => '`/income/verification/taxforms/get` returns the information collected from forms that were used to verify an end user\'\'s income. It can be called once the status of the verifica...',
    'icon' => 'ph:bank',
  ),
  'plaid_income_verification_precheck' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIncomeVerificationPrecheck',
    'type' => 'read',
    'name' => '(Deprecated) Check digital income verification eligibility and optimize conversion',
    'description' => '`/income/verification/precheck` is an optional endpoint that can be called before initializing a Link session for income verification. It evaluates whether a given user is suppo...',
    'icon' => 'ph:bank',
  ),
  'plaid_employment_verification_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidEmploymentVerificationGet',
    'type' => 'read',
    'name' => '(Deprecated) Retrieve a summary of an individual\'s employment information',
    'description' => '`/employment/verification/get` returns a list of employments through a user payroll that was verified by an end user. This endpoint has been deprecated; new integrations should ...',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_audit_copy_token_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditAuditCopyTokenCreate',
    'type' => 'write',
    'name' => 'Create Asset or Income Report Audit Copy Token',
    'description' => 'Plaid can create an Audit Copy token of an Asset Report and/or Income Report to share with a participating Government Sponsored Entity (GSE) if you participate in Fannie Mae\'s D...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_report_audit_copy_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditReportAuditCopyRemove',
    'type' => 'write',
    'name' => 'Remove an Audit Copy token',
    'description' => 'The `/credit/audit_copy_token/remove` endpoint allows you to remove an Audit Copy. Removing an Audit Copy invalidates the `audit_copy_token` associated with it, meaning both you...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_asset_report_freddie_mac_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditAssetReportFreddieMacGet',
    'type' => 'read',
    'name' => 'Retrieve an Asset Report with Freddie Mac format. Only Freddie Mac can use this endpoint.',
    'description' => 'The `credit/asset_report/freddie_mac/get` endpoint retrieves the Asset Report in Freddie Mac\'s JSON format.',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_freddie_mac_reports_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditFreddieMacReportsGet',
    'type' => 'read',
    'name' => 'Retrieve an Asset Report with Freddie Mac format (aka VOA - Verification Of Assets), and a Verification Of Employment (VOE) report if this one is available. Only Freddie Mac can use this endpoint.',
    'description' => 'The `credit/asset_report/freddie_mac/get` endpoint retrieves the Verification of Assets and Verification of Employment reports.',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_bank_employment_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditBankEmploymentGet',
    'type' => 'read',
    'name' => 'Retrieve information from the bank accounts used for employment verification',
    'description' => '`/credit/bank_employment/get` returns the employment report(s) derived from bank transaction data for a specified user.',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_bank_income_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditBankIncomeGet',
    'type' => 'read',
    'name' => 'Retrieve information from the bank accounts used for income verification',
    'description' => '`/credit/bank_income/get` returns the bank income report(s) for a specified user. A single report corresponds to all institutions linked in a single Link session. To include mul...',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_bank_income_pdf_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditBankIncomePdfGet',
    'type' => 'read',
    'name' => 'Retrieve information from the bank accounts used for income verification in PDF format',
    'description' => '`/credit/bank_income/pdf/get` returns the most recent bank income report for a specified user in PDF format. A single report corresponds to all institutions linked in a single L...',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_bank_income_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditBankIncomeRefresh',
    'type' => 'write',
    'name' => 'Refresh a user\'s bank income information',
    'description' => '`/credit/bank_income/refresh` is deprecated. The backend implementation was removed (returns an `Unimplemented` error at runtime), and the endpoint is no longer part of the docu...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_bank_income_webhook_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditBankIncomeWebhookUpdate',
    'type' => 'write',
    'name' => 'Subscribe and unsubscribe to proactive notifications for a user\'s income profile',
    'description' => '`/credit/bank_income/webhook/update` allows you to subscribe or unsubscribe a user for income webhook notifications. By default, all users start out unsubscribed. If a user is s...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_payroll_income_parsing_config_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditPayrollIncomeParsingConfigUpdate',
    'type' => 'write',
    'name' => 'Update the parsing configuration for a document income verification',
    'description' => '`/credit/payroll_income/parsing_config/update` updates the parsing configuration for a document income verification.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_bank_statements_uploads_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditBankStatementsUploadsGet',
    'type' => 'read',
    'name' => 'Retrieve data for a user\'s uploaded bank statements',
    'description' => '`/credit/bank_statements/uploads/get` returns parsed data from bank statements uploaded by users as part of the Document Income flow. If your account is not enabled for Document...',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_payroll_income_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditPayrollIncomeGet',
    'type' => 'read',
    'name' => 'Retrieve a user\'s payroll information',
    'description' => 'This endpoint gets payroll income information for a specific user, either as a result of the user connecting to their payroll provider or uploading a pay related document.',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_payroll_income_risk_signals_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditPayrollIncomeRiskSignalsGet',
    'type' => 'read',
    'name' => 'Retrieve fraud insights for a user\'s manually uploaded document(s).',
    'description' => '`/credit/payroll_income/risk_signals/get` can be used as part of the Document Income flow to assess a user-uploaded document for signs of potential fraud or tampering. It return...',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_payroll_income_precheck' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditPayrollIncomePrecheck',
    'type' => 'read',
    'name' => 'Check income verification eligibility and optimize conversion',
    'description' => '`/credit/payroll_income/precheck` is an optional endpoint that can be called before initializing a Link session for income verification. It evaluates whether a given user is sup...',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_employment_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditEmploymentGet',
    'type' => 'read',
    'name' => 'Retrieve a summary of an individual\'s employment information',
    'description' => '`/credit/employment/get` returns a list of items with employment information from a user\'s payroll provider that was verified by an end user.',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_payroll_income_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditPayrollIncomeRefresh',
    'type' => 'write',
    'name' => 'Refresh a digital payroll income verification',
    'description' => '`/credit/payroll_income/refresh` refreshes a given digital payroll income verification.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_relay_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditRelayCreate',
    'type' => 'write',
    'name' => 'Create a relay token to share an Asset Report with a partner client',
    'description' => 'Plaid can share an Asset Report directly with a participating third party on your behalf. The shared Asset Report is the exact same Asset Report originally created in `/asset_re...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_relay_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditRelayGet',
    'type' => 'read',
    'name' => 'Retrieve the reports associated with a relay token that was shared with you',
    'description' => '`/credit/relay/get` allows third parties to receive a report that was shared with them, using a `relay_token` that was created by the report owner.',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_relay_pdf_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditRelayPdfGet',
    'type' => 'read',
    'name' => 'Retrieve the pdf reports associated with a relay token that was shared with you (beta)',
    'description' => '`/credit/relay/pdf/get` allows third parties to receive a pdf report that was shared with them, using a `relay_token` that was created by the report owner. The `/credit/relay/pd...',
    'icon' => 'ph:bank',
  ),
  'plaid_credit_relay_refresh' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditRelayRefresh',
    'type' => 'write',
    'name' => 'Refresh a report of a relay token',
    'description' => 'The `/credit/relay/refresh` endpoint allows third parties to refresh a report that was relayed to them, using a `relay_token` that was created by the report owner. A new report ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_credit_relay_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidCreditRelayRemove',
    'type' => 'write',
    'name' => 'Remove relay token',
    'description' => 'The `/credit/relay/remove` endpoint allows you to invalidate a `relay_token`. The third party holding the token will no longer be able to access or refresh the reports which the...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_bank_transfer_fire_webhook' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxBankTransferFireWebhook',
    'type' => 'write',
    'name' => 'Manually fire a Bank Transfer webhook',
    'description' => 'Use the `/sandbox/bank_transfer/fire_webhook` endpoint to manually trigger a Bank Transfers webhook in the Sandbox environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_income_fire_webhook' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxIncomeFireWebhook',
    'type' => 'write',
    'name' => 'Manually fire an Income webhook',
    'description' => 'Use the `/sandbox/income/fire_webhook` endpoint to manually trigger a Payroll or Document Income webhook in the Sandbox environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_bank_income_fire_webhook' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxBankIncomeFireWebhook',
    'type' => 'write',
    'name' => 'Manually fire a bank income webhook in sandbox',
    'description' => 'Use the `/sandbox/bank_income/fire_webhook` endpoint to manually trigger a Bank Income webhook in the Sandbox environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_cra_cashflow_updates_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxCraCashflowUpdatesUpdate',
    'type' => 'write',
    'name' => 'Trigger an update for Cash Flow Updates',
    'description' => 'Use the `/sandbox/cra/cashflow_updates/update` endpoint to manually trigger an update for Cash Flow Updates (Monitoring) in the Sandbox environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_sandbox_oauth_select_accounts' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSandboxOauthSelectAccounts',
    'type' => 'write',
    'name' => 'Save the selected accounts when connecting to the Platypus Oauth institution',
    'description' => 'Save the selected accounts when connecting to the Platypus Oauth institution',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_signal_evaluate' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSignalEvaluate',
    'type' => 'read',
    'name' => 'Evaluate a planned ACH transaction',
    'description' => 'Use `/signal/evaluate` to evaluate a planned ACH transaction to get a return risk assessment and additional risk signals. Before using `/signal/evaluate`, you must first [create...',
    'icon' => 'ph:bank',
  ),
  'plaid_signal_schedule' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSignalSchedule',
    'type' => 'read',
    'name' => 'Schedule a planned ACH transaction',
    'description' => 'Use `/signal/schedule` to schedule a planned ACH transaction.',
    'icon' => 'ph:bank',
  ),
  'plaid_signal_decision_report' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSignalDecisionReport',
    'type' => 'write',
    'name' => 'Report whether you initiated an ACH transaction',
    'description' => 'After you call `/signal/evaluate`, Plaid will normally infer the outcome from your Signal Rules. However, if you are not using Signal Rules, if the Signal Rules outcome was `REV...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_signal_return_report' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSignalReturnReport',
    'type' => 'read',
    'name' => 'Report a return for an ACH transaction',
    'description' => 'Call the `/signal/return/report` endpoint to report a returned transaction that was previously sent to the `/signal/evaluate` endpoint. Your feedback will be used by the model t...',
    'icon' => 'ph:bank',
  ),
  'plaid_signal_prepare' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidSignalPrepare',
    'type' => 'read',
    'name' => 'Opt-in an Item to Signal Transaction Scores',
    'description' => 'When an Item is not initialized with `signal`, call `/signal/prepare` to opt-in that Item to the data collection process used to develop a Signal Transaction Score. This should ...',
    'icon' => 'ph:bank',
  ),
  'plaid_wallet_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWalletCreate',
    'type' => 'write',
    'name' => 'Create an e-wallet',
    'description' => 'Create an e-wallet. The response is the newly created e-wallet object.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_wallet_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWalletGet',
    'type' => 'read',
    'name' => 'Fetch an e-wallet',
    'description' => 'Fetch an e-wallet. The response includes the current balance.',
    'icon' => 'ph:bank',
  ),
  'plaid_wallet_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWalletList',
    'type' => 'read',
    'name' => 'Fetch a list of e-wallets',
    'description' => 'This endpoint lists all e-wallets in descending order of creation.',
    'icon' => 'ph:bank',
  ),
  'plaid_wallet_transaction_execute' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWalletTransactionExecute',
    'type' => 'read',
    'name' => 'Execute a transaction using an e-wallet',
    'description' => 'Execute a transaction using the specified e-wallet. Specify the e-wallet to debit from, the counterparty to credit to, the idempotency key to prevent duplicate transactions, the...',
    'icon' => 'ph:bank',
  ),
  'plaid_wallet_transaction_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWalletTransactionGet',
    'type' => 'read',
    'name' => 'Fetch an e-wallet transaction',
    'description' => 'Fetch a specific e-wallet transaction',
    'icon' => 'ph:bank',
  ),
  'plaid_wallet_transaction_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidWalletTransactionList',
    'type' => 'read',
    'name' => 'List e-wallet transactions',
    'description' => 'This endpoint lists the latest transactions of the specified e-wallet. Transactions are returned in descending order by the `created_at` time.',
    'icon' => 'ph:bank',
  ),
  'plaid_transactions_enhance' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsEnhance',
    'type' => 'read',
    'name' => 'enhance locally-held transaction data',
    'description' => 'The `/beta/transactions/v1/enhance` endpoint enriches raw transaction data provided directly by clients. The product is currently in beta.',
    'icon' => 'ph:bank',
  ),
  'plaid_transactions_rules_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsRulesCreate',
    'type' => 'write',
    'name' => 'Create transaction category rule',
    'description' => 'The `/transactions/rules/v1/create` endpoint creates transaction categorization rules. Rules will be applied on the Item\'s transactions returned in `/transactions/get` response....',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transactions_rules_list' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsRulesList',
    'type' => 'read',
    'name' => 'Return a list of rules created for the Item associated with the access token.',
    'description' => 'The `/transactions/rules/v1/list` returns a list of transaction rules created for the Item associated with the access token.',
    'icon' => 'ph:bank',
  ),
  'plaid_transactions_rules_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsRulesRemove',
    'type' => 'write',
    'name' => 'Remove transaction rule',
    'description' => 'The `/transactions/rules/v1/remove` endpoint is used to remove a transaction rule.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_transactions_user_insights_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidTransactionsUserInsightsGet',
    'type' => 'read',
    'name' => 'Obtain user insights based on transactions sent through /transactions/enrich',
    'description' => 'The `/beta/transactions/user_insights/v1/get` gets user insights for clients who have enriched data with `/transactions/enrich`. The product is currently in beta.',
    'icon' => 'ph:bank',
  ),
  'plaid_beta_ewa_report_v1_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBetaEwaReportV1Get',
    'type' => 'read',
    'name' => 'Get EWA Score Report',
    'description' => 'The `/beta/ewa_report/v1/get` endpoint provides an Earned Wage Access (EWA) score that quantifies the delinquency risk associated with a given item. The score is derived from a ...',
    'icon' => 'ph:bank',
  ),
  'plaid_issues_search' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIssuesSearch',
    'type' => 'read',
    'name' => 'Search for an Issue',
    'description' => 'Search for an issue associated with one of the following identifiers: `item_id`, `link_session_id` or Link session `request_id`. This endpoint returns a list of `Issue` objects,...',
    'icon' => 'ph:bank',
  ),
  'plaid_issues_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIssuesGet',
    'type' => 'read',
    'name' => 'Get an Issue',
    'description' => 'Retrieve detailed information about a specific `Issue`. This endpoint returns a single `Issue` object.',
    'icon' => 'ph:bank',
  ),
  'plaid_issues_subscribe' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidIssuesSubscribe',
    'type' => 'write',
    'name' => 'Subscribe to an Issue',
    'description' => 'Allows a user to subscribe to updates on a specific `Issue` using a POST method. Subscribers will receive webhook notifications when the issue status changes, particularly when ...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_payment_profile_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentProfileCreate',
    'type' => 'write',
    'name' => 'Create payment profile',
    'description' => 'Use `/payment_profile/create` endpoint to create a new payment profile. To initiate the account linking experience, call `/link/token/create` and provide the `payment_profile_to...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_payment_profile_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentProfileGet',
    'type' => 'read',
    'name' => 'Get payment profile',
    'description' => 'Use `/payment_profile/get` endpoint to get the status of a given Payment Profile.',
    'icon' => 'ph:bank',
  ),
  'plaid_payment_profile_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPaymentProfileRemove',
    'type' => 'write',
    'name' => 'Remove payment profile',
    'description' => 'Use the `/payment_profile/remove` endpoint to remove a given Payment Profile. Once it’s removed, it can no longer be used to create transfers.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_partner_customer_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPartnerCustomerCreate',
    'type' => 'write',
    'name' => 'Creates a new end customer for a Plaid reseller.',
    'description' => 'The `/partner/customer/create` endpoint is used by reseller partners to create end customers. To create end customers, it should be called in the Production environment only, ev...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_partner_customer_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPartnerCustomerGet',
    'type' => 'read',
    'name' => 'Returns a Plaid reseller\'s end customer.',
    'description' => 'The `/partner/customer/get` endpoint is used by reseller partners to retrieve data about a single end customer.',
    'icon' => 'ph:bank',
  ),
  'plaid_partner_customer_enable' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPartnerCustomerEnable',
    'type' => 'write',
    'name' => 'Enables a Plaid reseller\'s end customer in the Production environment.',
    'description' => 'The `/partner/customer/enable` endpoint is used by reseller partners to enable an end customer in the full Production environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_partner_customer_remove' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPartnerCustomerRemove',
    'type' => 'write',
    'name' => 'Removes a Plaid reseller\'s end customer.',
    'description' => 'The `/partner/customer/remove` endpoint is used by reseller partners to remove an end customer. Removing an end customer will remove it from view in the Plaid Dashboard and deac...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_partner_customer_oauth_institutions_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidPartnerCustomerOauthInstitutionsGet',
    'type' => 'read',
    'name' => 'Returns OAuth-institution registration information for a given end customer.',
    'description' => 'The `/partner/customer/oauth_institutions/get` endpoint is used by reseller partners to retrieve OAuth-institution registration information about a single end customer. To learn...',
    'icon' => 'ph:bank',
  ),
  'plaid_beta_partner_customer_v1_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBetaPartnerCustomerV1Create',
    'type' => 'write',
    'name' => 'Creates a new end customer for a Plaid reseller.',
    'description' => 'The `/beta/partner/customer/v1/create` endpoint creates a new end customer record. You can provide as much information as you have available. If any required information is miss...',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_beta_partner_customer_v1_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBetaPartnerCustomerV1Get',
    'type' => 'read',
    'name' => 'Retrieves the details of a Plaid reseller\'s end customer.',
    'description' => 'The `/beta/partner/customer/v1/get` endpoint is used by reseller partners to retrieve data about a single end customer.',
    'icon' => 'ph:bank',
  ),
  'plaid_beta_partner_customer_v1_update' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBetaPartnerCustomerV1Update',
    'type' => 'write',
    'name' => 'Updates an existing end customer.',
    'description' => 'The `/beta/partner/customer/v1/update` endpoint updates an existing end customer record.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_beta_partner_customer_v1_enable' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidBetaPartnerCustomerV1Enable',
    'type' => 'write',
    'name' => 'Enables a Plaid reseller\'s end customer in the Production environment.',
    'description' => 'The `/beta/partner/customer/v1/enable` endpoint is used by reseller partners to enable an end customer in the full Production environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_link_delivery_create' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidLinkDeliveryCreate',
    'type' => 'write',
    'name' => 'Create Hosted Link session',
    'description' => 'Use the `/link_delivery/create` endpoint to create a Hosted Link session.',
    'icon' => 'ph:pencil-simple',
  ),
  'plaid_link_delivery_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidLinkDeliveryGet',
    'type' => 'read',
    'name' => 'Get Hosted Link session',
    'description' => 'Use the `/link_delivery/get` endpoint to get the status of a Hosted Link session.',
    'icon' => 'ph:bank',
  ),
  'plaid_fdx_notifications' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidFdxNotifications',
    'type' => 'read',
    'name' => 'Webhook receiver for fdx notifications',
    'description' => 'A generic webhook receiver endpoint for FDX Event Notifications',
    'icon' => 'ph:bank',
  ),
  'plaid_get_recipients' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidGetRecipients',
    'type' => 'read',
    'name' => 'Get Recipients',
    'description' => 'Returns a list of Recipients',
    'icon' => 'ph:bank',
  ),
  'plaid_get_recipient' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidGetRecipient',
    'type' => 'read',
    'name' => 'Get Recipient',
    'description' => 'Get a specific recipient',
    'icon' => 'ph:bank',
  ),
  'plaid_network_insights_report_get' =>
  array (
    'class' => '\\OpenCompany\\Integrations\\Plaid\\Tools\\PlaidNetworkInsightsReportGet',
    'type' => 'read',
    'name' => 'Retrieve network insights for the provided `access_tokens`',
    'description' => 'This endpoint allows you to retrieve the Network Insights from a list of `access_tokens`.',
    'icon' => 'ph:bank',
  ),
];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/plaid.md';
    }

    /**
     * Resolve a Plaid API client for the requested account context.
     *
     * @param  array<string, mixed>  $context  Optional account context from the host.
     */
    private function resolveService(array $context = []): PlaidService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PlaidService(
                clientId: $creds->get('plaid', 'client_id', '', $account),
                secret: $creds->get('plaid', 'secret', '', $account),
                plaidVersion: $creds->get('plaid', 'plaid_version', '2020-09-14', $account),
                baseUrl: $creds->get('plaid', 'url', 'https://sandbox.plaid.com', $account),
            );
        }

        return app(PlaidService::class);
    }
}
