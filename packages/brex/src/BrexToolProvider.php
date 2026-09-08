<?php

namespace OpenCompany\Integrations\Brex;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Brex.
 *
 * Combines Brex's official OpenAPI descriptions into endpoint-specific agent
 * tools and resolves account-specific OAuth tokens in multi-account hosts.
 */
class BrexToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'oauth_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>true,'token_keys'=>['access_token'],'notes'=>[]],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]];
    }
    public function appName(): string { return 'brex'; }
    public function appMeta(): array { return ['label'=>'Brex','description'=>'Spend management, cards, expenses, payments, travel, accounting, and webhooks','icon'=>'ph:briefcase','logo'=>'ph:briefcase']; }
    public function integrationMeta(): array { return ['name'=>'Brex','description'=>'Manage Brex users, cards, budgets, expenses, fields, referrals, payments, transactions, travel, accounting exports, and webhooks.','icon'=>'ph:briefcase','logo'=>'ph:briefcase','category'=>'data','badge'=>'verified','docs_url'=>'https://developer.brex.com/openapi/team_api']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Brex OAuth access token','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://api.brex.com','default'=>'https://api.brex.com']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $token=(string)($config['access_token']??''); $baseUrl=rtrim((string)($config['url']??'https://api.brex.com'),'/');
        if($token==='') return ['success'=>false,'error'=>'Brex access token is required.'];
        try{$response=Http::withHeaders(['Authorization'=>'Bearer '.$token,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/v2/users/me'); if(!$response->successful()) return ['success'=>false,'error'=>'Brex API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Brex at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];}
    }
    public function validationRules(): array { return ['access_token'=>'required|string','url'=>'nullable|url']; }
    public function credentialFields(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>false,'default'=>'https://api.brex.com']]; }
    public function tools(): array { return [
  'brex_accounting_create_integration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexAccountingCreateIntegration',
    'type' => 'write',
    'name' => 'Create accounting integration',
    'description' => 'Create a new accounting integration. The behavior depends on the existing active integration: - If no active integration exists: Creates and returns new integration - If active ...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_accounting_disconnect_integration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexAccountingDisconnectIntegration',
    'type' => 'write',
    'name' => 'Disconnect accounting integration',
    'description' => 'Disconnect an active accounting integration. - If integration is ACTIVE: Disconnects and returns success - If integration ID doesn\'t exist: Returns 404 error - If integration is...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_accounting_reactivate_integration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexAccountingReactivateIntegration',
    'type' => 'write',
    'name' => 'Reactivate accounting integration',
    'description' => 'Reactivate a disconnected accounting integration. - If integration is DISABLED: Reactivates and returns success - If integration ID doesn\'t exist: Returns 404 error - If an acti...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_accounting_get_accounting_record' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexAccountingGetAccountingRecord',
    'type' => 'read',
    'name' => 'Get accounting record by ID',
    'description' => 'Retrieve a single accounting record by its unique identifier',
    'icon' => 'ph:briefcase',
  ),
  'brex_accounting_query_accounting_records' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexAccountingQueryAccountingRecords',
    'type' => 'read',
    'name' => 'Query accounting records',
    'description' => 'Query accounting records by IDs or with filters for polling. When building integrations with Brex accounting workflow, use filter-based polling as a fallback mechanism. Suggeste...',
    'icon' => 'ph:briefcase',
  ),
  'brex_accounting_report_accounting_export_results' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexAccountingReportAccountingExportResults',
    'type' => 'write',
    'name' => 'Report accounting export results',
    'description' => 'Report export success or failure for accounting records.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_list_budget_programs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsListBudgetPrograms',
    'type' => 'read',
    'name' => 'List Budget Programs',
    'description' => 'Lists Budget Programs belonging to this account',
    'icon' => 'ph:briefcase',
  ),
  'brex_budgets_get_budget_program_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsGetBudgetProgramById',
    'type' => 'read',
    'name' => 'Get Budget Program',
    'description' => 'Retrieves a Budget Program by ID',
    'icon' => 'ph:briefcase',
  ),
  'brex_budgets_list_budgets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsListBudgets',
    'type' => 'read',
    'name' => 'List Spend Limits',
    'description' => 'Lists Spend Limits belonging to this account',
    'icon' => 'ph:briefcase',
  ),
  'brex_budgets_create_budget' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsCreateBudget',
    'type' => 'write',
    'name' => 'Create Spend Limit',
    'description' => 'Creates a Spend Limit',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_get_budget_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsGetBudgetById',
    'type' => 'read',
    'name' => 'Get Spend Limit',
    'description' => 'Retrieves a Spend Limit by ID',
    'icon' => 'ph:briefcase',
  ),
  'brex_budgets_update_budget' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsUpdateBudget',
    'type' => 'write',
    'name' => 'Update Spend Limit',
    'description' => 'Updates a Spend Limit',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_archive_budget' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsArchiveBudget',
    'type' => 'write',
    'name' => 'Archive a Spend Limit',
    'description' => 'Archives a Spend Limit, making it unusable for future expenses and removing it from the UI',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_list_spend_budgets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsListSpendBudgets',
    'type' => 'read',
    'name' => 'List Budgets',
    'description' => 'Retrieves a list of Budgets',
    'icon' => 'ph:briefcase',
  ),
  'brex_budgets_create_spend_budget' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsCreateSpendBudget',
    'type' => 'write',
    'name' => 'Create Budget',
    'description' => 'Creates a Budget',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_get_spend_budget_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsGetSpendBudgetById',
    'type' => 'read',
    'name' => 'Get Budget',
    'description' => 'Retrieves a Budget by ID',
    'icon' => 'ph:briefcase',
  ),
  'brex_budgets_update_spend_budget' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsUpdateSpendBudget',
    'type' => 'write',
    'name' => 'Update Budget',
    'description' => 'Updates a Budget',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_archive_spend_budget' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsArchiveSpendBudget',
    'type' => 'write',
    'name' => 'Archive a Budget',
    'description' => 'Archives a Budget, making any Spend Limits beneath it unusable for future expenses and removing it from the UI',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_list_spend_limits' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsListSpendLimits',
    'type' => 'read',
    'name' => 'List Spend Limits',
    'description' => 'Retrieves a list of Spend Limits',
    'icon' => 'ph:briefcase',
  ),
  'brex_budgets_create_spend_limit' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsCreateSpendLimit',
    'type' => 'write',
    'name' => 'Create Spend Limit',
    'description' => 'Creates a Spend Limit',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_get_spend_limit_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsGetSpendLimitById',
    'type' => 'read',
    'name' => 'Get Spend Limit',
    'description' => 'Retrieves a Spend Limit by ID',
    'icon' => 'ph:briefcase',
  ),
  'brex_budgets_update_spend_limit' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsUpdateSpendLimit',
    'type' => 'write',
    'name' => 'Update Spend Limit',
    'description' => 'Updates a Spend Limit',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_budgets_archive_spend_limit' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexBudgetsArchiveSpendLimit',
    'type' => 'write',
    'name' => 'Archive a Spend Limit',
    'description' => 'Archives a Spend Limit, making it unusable for future expenses and removing it from the UI',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_expenses_list_expenses' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexExpensesListExpenses',
    'type' => 'read',
    'name' => 'List expenses',
    'description' => 'List expenses under the same account. Admin and bookkeeper have access to any expense, and regular users can only access their own.',
    'icon' => 'ph:briefcase',
  ),
  'brex_expenses_list_expenses_1' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexExpensesListExpenses1',
    'type' => 'read',
    'name' => 'List card expenses',
    'description' => 'This endpoint is deprecated. Use the "List expenses" (`GET /v1/expenses`) endpoint instead.',
    'icon' => 'ph:briefcase',
  ),
  'brex_expenses_receipt_match' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexExpensesReceiptMatch',
    'type' => 'write',
    'name' => 'Create a new receipt match',
    'description' => 'The `uri` will be a pre-signed S3 URL allowing you to upload the receipt securely. This URL can only be used for a `PUT` operation and expires 30 minutes after its creation. Onc...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_expenses_get_card_expense' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexExpensesGetCardExpense',
    'type' => 'read',
    'name' => 'Get a card expense',
    'description' => 'This endpoint is deprecated. Use the "Get an expense" (`GET /v1/expenses/{id}`) endpoint instead.',
    'icon' => 'ph:briefcase',
  ),
  'brex_expenses_update_expense' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexExpensesUpdateExpense',
    'type' => 'write',
    'name' => 'Update an expense',
    'description' => 'Update an expense. Admin and bookkeeper have access to any expense, and regular users can only access their own.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_expenses_receipt_upload' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexExpensesReceiptUpload',
    'type' => 'write',
    'name' => 'Create a new receipt upload',
    'description' => 'The `uri` will be a pre-signed S3 URL allowing you to upload the receipt securely. This URL can only be used for a `PUT` operation and expires 30 minutes after its creation. Onc...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_expenses_get_expense' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexExpensesGetExpense',
    'type' => 'read',
    'name' => 'Get an expense',
    'description' => 'Get an expense by its ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_fields_list_fields' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsListFields',
    'type' => 'read',
    'name' => 'List custom fields',
    'description' => 'List custom fields under the same account',
    'icon' => 'ph:briefcase',
  ),
  'brex_fields_create_field' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsCreateField',
    'type' => 'write',
    'name' => 'Create a custom field',
    'description' => 'Create a custom field',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_fields_list_field_values' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsListFieldValues',
    'type' => 'read',
    'name' => 'List custom field values',
    'description' => 'List values under the same custom field',
    'icon' => 'ph:briefcase',
  ),
  'brex_fields_update_field_values' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsUpdateFieldValues',
    'type' => 'write',
    'name' => 'Update custom field values',
    'description' => 'Update custom field values (up to 1000 values at once) for a specific field',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_fields_create_field_values' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsCreateFieldValues',
    'type' => 'write',
    'name' => 'Create custom field values',
    'description' => 'Create custom field values (up to 1000 values at once) for a specific field',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_fields_delete_field_values' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsDeleteFieldValues',
    'type' => 'write',
    'name' => 'Delete custom field values',
    'description' => 'Delete custom field values (up to 1000 values at once) for a specific field',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_fields_get_field_value_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsGetFieldValueById',
    'type' => 'read',
    'name' => 'Get a field value',
    'description' => 'Get a field value by field ID and field value ID',
    'icon' => 'ph:briefcase',
  ),
  'brex_fields_get_field_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsGetFieldById',
    'type' => 'read',
    'name' => 'Get custom field',
    'description' => 'Get a custom field by Brex ID',
    'icon' => 'ph:briefcase',
  ),
  'brex_fields_update_field' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsUpdateField',
    'type' => 'write',
    'name' => 'Update a custom field',
    'description' => 'Update a field by ID',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_fields_delete_field' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexFieldsDeleteField',
    'type' => 'write',
    'name' => 'Delete a custom field',
    'description' => 'Delete a custom field by Brex ID',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_onboarding_list_referrals' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexOnboardingListReferrals',
    'type' => 'read',
    'name' => 'List referrals',
    'description' => 'Returns referrals created. *Note*: This doesn\'t include referrals that have expired.',
    'icon' => 'ph:briefcase',
  ),
  'brex_onboarding_create_referral_request' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexOnboardingCreateReferralRequest',
    'type' => 'write',
    'name' => 'Creates a referral',
    'description' => 'This creates new referrals. The response will contain an identifier and a unique personalized link to an application flow. Many fields are optional and when they\'re provided the...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_onboarding_get_referral' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexOnboardingGetReferral',
    'type' => 'read',
    'name' => 'Gets a referral by ID',
    'description' => 'Returns a referral object by ID if it exists.',
    'icon' => 'ph:briefcase',
  ),
  'brex_onboarding_create_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexOnboardingCreateDocument',
    'type' => 'write',
    'name' => 'Create a new document upload',
    'description' => 'The `uri` will be a presigned S3 URL allowing you to upload the referral doc securely. This URL can only be used for a `PUT` operation and expires 30 minutes after its creation....',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_onboarding_process_delayed_eindocument' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexOnboardingProcessDelayedEINDocument',
    'type' => 'write',
    'name' => 'Process a delayed EIN document after upload',
    'description' => 'Processes a delayed EIN document after it has been uploaded. This endpoint should be called after successfully uploading an IRS EIN Confirmation document (CP-575, CP-575 fax she...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_payments_create_incoming_transfer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsCreateIncomingTransfer',
    'type' => 'write',
    'name' => 'Create incoming transfer',
    'description' => 'This endpoint creates a new incoming transfer. You may use use any eligible bank account connection to fund (ACH Debit) any active Brex business account. **Reminder**: You may n...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_payments_list_linked_accounts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsListLinkedAccounts',
    'type' => 'read',
    'name' => 'Lists linked accounts',
    'description' => 'This endpoint lists all bank connections that are eligible to make ACH transfers to Brex business account',
    'icon' => 'ph:briefcase',
  ),
  'brex_payments_list_transfers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsListTransfers',
    'type' => 'read',
    'name' => 'Lists transfers',
    'description' => 'This endpoint lists existing transfers for an account. Currently, the API can only return transfers for the following payment rails: - ACH - DOMESTIC_WIRE - CHEQUE - INTERNATION...',
    'icon' => 'ph:briefcase',
  ),
  'brex_payments_create_transfer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsCreateTransfer',
    'type' => 'write',
    'name' => 'Create transfer',
    'description' => 'This endpoint creates a new transfer. Currently, the API can only create transfers for the following payment rails: - ACH - DOMESTIC_WIRE - CHEQUE - INTERNATIONAL_WIRES **Transa...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_payments_get_transfers_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsGetTransfersById',
    'type' => 'read',
    'name' => 'Get transfer',
    'description' => 'This endpoint gets a transfer by ID. Currently, the API can only return transfers for the following payment rails: - ACH - DOMESTIC_WIRE - CHEQUE - INTERNATIONAL_WIRE',
    'icon' => 'ph:briefcase',
  ),
  'brex_payments_list_vendors' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsListVendors',
    'type' => 'read',
    'name' => 'Lists vendors',
    'description' => 'This endpoint lists all existing vendors for an account. Takes an optional parameter to match by vendor name.',
    'icon' => 'ph:briefcase',
  ),
  'brex_payments_create_vendor' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsCreateVendor',
    'type' => 'write',
    'name' => 'Create vendor',
    'description' => 'This endpoint creates a new vendor.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_payments_get_vendor_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsGetVendorById',
    'type' => 'read',
    'name' => 'Get vendor',
    'description' => 'This endpoint gets a vendor by ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_payments_update_vendor' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsUpdateVendor',
    'type' => 'write',
    'name' => 'Update vendor',
    'description' => 'Updates an existing vendor by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_payments_delete_vendor' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexPaymentsDeleteVendor',
    'type' => 'write',
    'name' => 'Delete vendor.',
    'description' => 'This endpoint deletes a vendor by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_list_cards_by_user_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamListCardsByUserId',
    'type' => 'read',
    'name' => 'List cards',
    'description' => 'Lists all cards by a `user_id`. Only cards with `limit_type = CARD` have `spend_controls`',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_create_card' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamCreateCard',
    'type' => 'write',
    'name' => 'Create card',
    'description' => 'Creates a new card. The `spend_controls` field is required when `limit_type` = `CARD`. The `mailing_address` field is required for physical cards and is the shipping address use...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_get_card_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetCardById',
    'type' => 'read',
    'name' => 'Get card',
    'description' => 'Retrieves a card by ID. Only cards with `limit_type = CARD` have `spend_controls`',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_update_card' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamUpdateCard',
    'type' => 'write',
    'name' => 'Update card',
    'description' => 'Update an existing vendor card',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_lock_card' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamLockCard',
    'type' => 'write',
    'name' => 'Lock card',
    'description' => 'Locks an existing, unlocked card. And the card owner will receive a notification about it.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_get_card_number' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetCardNumber',
    'type' => 'read',
    'name' => 'Get card number',
    'description' => 'Retrieves card number, CVV, and expiration date of a card by ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_email_card_number' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamEmailCardNumber',
    'type' => 'write',
    'name' => 'Create secure email to send card number',
    'description' => 'Creates a secure email to send card number, CVV, and expiration date of a card by ID to the specified email. This endpoint is currently gated. If you would like to request acces...',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_terminate_card' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamTerminateCard',
    'type' => 'write',
    'name' => 'Terminate card',
    'description' => 'Terminates an existing card. The card owner will receive a notification about it.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_unlock_card' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamUnlockCard',
    'type' => 'write',
    'name' => 'Unlock card',
    'description' => 'Unlocks an existing card.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_get_company' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetCompany',
    'type' => 'read',
    'name' => 'Get company',
    'description' => 'This endpoint returns the company associated with the OAuth2 access token.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_list_departments' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamListDepartments',
    'type' => 'read',
    'name' => 'List departments',
    'description' => 'This endpoint lists all departments.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_create_department' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamCreateDepartment',
    'type' => 'write',
    'name' => 'Create department',
    'description' => 'This endpoint creates a new department',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_get_department_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetDepartmentById',
    'type' => 'read',
    'name' => 'Get department',
    'description' => 'This endpoint gets a department by ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_list_legal_entities' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamListLegalEntities',
    'type' => 'read',
    'name' => 'List legal entities',
    'description' => 'List legal entities for the account.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_get_legal_entity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetLegalEntity',
    'type' => 'read',
    'name' => 'Get legal entity',
    'description' => 'Get a legal entity by its ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_list_locations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamListLocations',
    'type' => 'read',
    'name' => 'List locations',
    'description' => 'This endpoint lists all locations.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_create_location' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamCreateLocation',
    'type' => 'write',
    'name' => 'Create location',
    'description' => 'This endpoint creates a new location.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_get_location_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetLocationById',
    'type' => 'read',
    'name' => 'Get location',
    'description' => 'This endpoint gets a location by ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_list_titles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamListTitles',
    'type' => 'read',
    'name' => 'List titles',
    'description' => 'This endpoint lists all titles.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_create_title' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamCreateTitle',
    'type' => 'write',
    'name' => 'Create title',
    'description' => 'This endpoint creates a new title',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_get_title_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetTitleById',
    'type' => 'read',
    'name' => 'Get title',
    'description' => 'This endpoint gets a title by ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_list_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamListUsers',
    'type' => 'read',
    'name' => 'List users',
    'description' => 'This endpoint lists all users. To find a user id by email, you can filter using the `email` query parameter.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_create_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamCreateUser',
    'type' => 'write',
    'name' => 'Invite user',
    'description' => 'This endpoint invites a new user as an employee. To update user\'s role, check out [this article](https://support.brex.com/how-do-i-change-another-user-s-role/).',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_get_me' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetMe',
    'type' => 'read',
    'name' => 'Get current user',
    'description' => 'This endpoint returns the user associated with the OAuth2 access token.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_get_user_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetUserById',
    'type' => 'read',
    'name' => 'Get user',
    'description' => 'This endpoint gets a user by ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_update_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamUpdateUser',
    'type' => 'write',
    'name' => 'Update user',
    'description' => 'This endpoint updates a user. Any parameters not provided will be left unchanged.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_team_get_user_limit' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamGetUserLimit',
    'type' => 'read',
    'name' => 'Get limit for the user',
    'description' => 'This endpoint gets the monthly limit for the user including the monthly available limit.',
    'icon' => 'ph:briefcase',
  ),
  'brex_team_set_user_limit' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTeamSetUserLimit',
    'type' => 'write',
    'name' => 'Set limit for the user',
    'description' => 'This endpoint sets the monthly limit for a user. The limit amount must be non-negative. To unset the monthly limit of the user, just set `monthly_limit` to null.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_transactions_list_card_accounts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTransactionsListCardAccounts',
    'type' => 'read',
    'name' => 'List card accounts',
    'description' => 'This endpoint lists all accounts of card type.',
    'icon' => 'ph:briefcase',
  ),
  'brex_transactions_list_primary_card_statements' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTransactionsListPrimaryCardStatements',
    'type' => 'read',
    'name' => 'List primary card account statements.',
    'description' => 'This endpoint lists all finalized statements for the primary card account.',
    'icon' => 'ph:briefcase',
  ),
  'brex_transactions_list_accounts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTransactionsListAccounts',
    'type' => 'read',
    'name' => 'List cash accounts',
    'description' => 'This endpoint lists all the existing cash accounts with their status.',
    'icon' => 'ph:briefcase',
  ),
  'brex_transactions_get_primary_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTransactionsGetPrimaryAccount',
    'type' => 'read',
    'name' => 'Get primary cash account',
    'description' => 'This endpoint returns the primary cash account with its status. There will always be only one primary account.',
    'icon' => 'ph:briefcase',
  ),
  'brex_transactions_get_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTransactionsGetAccount',
    'type' => 'read',
    'name' => 'Get cash account by ID',
    'description' => 'This endpoint returns the cash account associated with the provided ID with its status.',
    'icon' => 'ph:briefcase',
  ),
  'brex_transactions_list_cash_statements' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTransactionsListCashStatements',
    'type' => 'read',
    'name' => 'List cash account statements.',
    'description' => 'This endpoint lists all finalized statements for the cash account by ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_transactions_list_primary_card_transactions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTransactionsListPrimaryCardTransactions',
    'type' => 'read',
    'name' => 'List transactions for all card accounts.',
    'description' => 'This endpoint lists all settled transactions for all card accounts. Regular users may only fetch their own "PURCHASE","REFUND" and "CHARGEBACK" settled transactions.',
    'icon' => 'ph:briefcase',
  ),
  'brex_transactions_list_cash_transactions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTransactionsListCashTransactions',
    'type' => 'read',
    'name' => 'List transactions for the selected cash account.',
    'description' => 'This endpoint lists all transactions for the cash account with the selected ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_travel_list_trips' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTravelListTrips',
    'type' => 'read',
    'name' => 'List trips',
    'description' => 'Lists trips according to the filters passed in the query string.',
    'icon' => 'ph:briefcase',
  ),
  'brex_travel_get_trip' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTravelGetTrip',
    'type' => 'read',
    'name' => 'Get trip',
    'description' => 'Retrieves a trip by ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_travel_list_trip_bookings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTravelListTripBookings',
    'type' => 'read',
    'name' => 'List trip bookings',
    'description' => 'Lists the bookings within a trip.',
    'icon' => 'ph:briefcase',
  ),
  'brex_travel_get_booking' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexTravelGetBooking',
    'type' => 'read',
    'name' => 'Get booking',
    'description' => 'Retrieves a booking by trip and booking ID.',
    'icon' => 'ph:briefcase',
  ),
  'brex_webhooks_list_webhook_subscriptions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksListWebhookSubscriptions',
    'type' => 'read',
    'name' => 'List Webhooks',
    'description' => 'List the webhooks you have registered',
    'icon' => 'ph:briefcase',
  ),
  'brex_webhooks_create_webhook_subscription' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksCreateWebhookSubscription',
    'type' => 'write',
    'name' => 'Register Webhook',
    'description' => 'Register an endpoint to start receiving selected webhook events',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_webhooks_list_webhook_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksListWebhookGroups',
    'type' => 'read',
    'name' => 'List Webhook Groups',
    'description' => 'Lists webhook groups.',
    'icon' => 'ph:briefcase',
  ),
  'brex_webhooks_create_webhook_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksCreateWebhookGroup',
    'type' => 'write',
    'name' => 'Create Webhook Group',
    'description' => 'Creates a webhook group.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_webhooks_get_webhook_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksGetWebhookGroup',
    'type' => 'read',
    'name' => 'Get Webhook Group',
    'description' => 'Gets a webhook group.',
    'icon' => 'ph:briefcase',
  ),
  'brex_webhooks_delete_webhook_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksDeleteWebhookGroup',
    'type' => 'write',
    'name' => 'Delete Webhook Group',
    'description' => 'Deletes a webhook group and all its members.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_webhooks_add_webhook_group_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksAddWebhookGroupMembers',
    'type' => 'write',
    'name' => 'Add Webhook Group Members',
    'description' => 'Adds members to webhook groups.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_webhooks_list_webhook_group_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksListWebhookGroupMembers',
    'type' => 'read',
    'name' => 'List Webhook Group Members',
    'description' => 'Lists the members currently in the specified webhook group.',
    'icon' => 'ph:briefcase',
  ),
  'brex_webhooks_remove_webhook_group_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksRemoveWebhookGroupMembers',
    'type' => 'write',
    'name' => 'Remove Webhook Group Members',
    'description' => 'Removes members from webhook groups.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_webhooks_list_webhook_secrets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksListWebhookSecrets',
    'type' => 'read',
    'name' => 'List Webhook Secrets',
    'description' => 'This endpoint returns a set of webhook signing secrets used to validate the webhook. Usually only one key will be returned in the response. After key rotation, this endpoint wil...',
    'icon' => 'ph:briefcase',
  ),
  'brex_webhooks_get_webhook_subscription' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksGetWebhookSubscription',
    'type' => 'read',
    'name' => 'Get Webhook',
    'description' => 'Get details of a webhook',
    'icon' => 'ph:briefcase',
  ),
  'brex_webhooks_update_webhook_subscription' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksUpdateWebhookSubscription',
    'type' => 'write',
    'name' => 'Update Webhook',
    'description' => 'Update a webhook. You can update the endpoint url, event types that the endpoint receives, or temporarily deactivate the webhook.',
    'icon' => 'ph:pencil-simple',
  ),
  'brex_webhooks_delete_webhook_subscription' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Brex\\Tools\\BrexWebhooksDeleteWebhookSubscription',
    'type' => 'write',
    'name' => 'Unregister Webhook',
    'description' => 'Unregister a webhook if you want to stop receiving webhook events',
    'icon' => 'ph:pencil-simple',
  ),
];
    }
    public function isIntegration(): bool { return true; }
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/brex.md'; }
    /** @param  array<string, mixed>  $context  Optional account context from the host. */
    private function resolveService(array $context = []): BrexService
    {
        $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new BrexService(accessToken:$creds->get('brex','access_token','',$account), baseUrl:$creds->get('brex','url','https://api.brex.com',$account));}
        return app(BrexService::class);
    }
}