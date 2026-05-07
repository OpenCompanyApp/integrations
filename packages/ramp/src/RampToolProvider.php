<?php

namespace OpenCompany\Integrations\Ramp;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Ramp.
 *
 * Exposes Ramp's official Developer API OpenAPI operation set as endpoint-specific
 * agent tools and resolves account-specific OAuth tokens in multi-account hosts.
 */
class RampToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'oauth_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>true,'token_keys'=>['access_token'],'notes'=>[]],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'ramp'; } public function appMeta(): array { return ['label'=>'Ramp','description'=>'Spend management, cards, accounting, vendors, reimbursements, treasury, and travel','icon'=>'ph:currency-dollar','logo'=>'ph:currency-dollar']; }
    public function integrationMeta(): array { return ['name'=>'Ramp','description'=>'Manage Ramp accounting, cards, bills, reimbursements, vendors, transactions, transfers, treasury, users, departments, locations, and travel data.','icon'=>'ph:currency-dollar','logo'=>'ph:currency-dollar','category'=>'data','badge'=>'verified','docs_url'=>'https://developer-docs.ramp.com/']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Ramp OAuth access token','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://api.ramp.com','default'=>'https://api.ramp.com']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $token=(string)($config['access_token']??''); $baseUrl=rtrim((string)($config['url']??'https://api.ramp.com'),'/'); if($token==='')return ['success'=>false,'error'=>'Ramp access token is required.']; try{$response=Http::withHeaders(['Authorization'=>'Bearer '.$token,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/developer/v1/business'); if(!$response->successful())return ['success'=>false,'error'=>'Ramp API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Ramp at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['access_token'=>'required|string','url'=>'nullable|url']; } public function credentialFields(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>false,'default'=>'https://api.ramp.com']]; }
    public function tools(): array { return [
  'ramp_get_gl_account_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetGlAccountListResource',
    'type' => 'read',
    'name' => 'List general ledger accounts',
    'description' => 'List general ledger accounts',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_gl_account_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostGlAccountListResource',
    'type' => 'write',
    'name' => 'Upload general ledger accounts',
    'description' => 'You can upload up to 500 general ledger accounts in an all-or-nothing fashion. If a general ledger accounts within a batch is malformed or violates a database constraint, the en...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_gl_account_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteGlAccountResource',
    'type' => 'write',
    'name' => 'Delete a general ledger account',
    'description' => 'Delete a general ledger account',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_gl_account_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetGlAccountResource',
    'type' => 'read',
    'name' => 'Fetch a general ledger account',
    'description' => 'Fetch a general ledger account',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_gl_account_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchGlAccountResource',
    'type' => 'write',
    'name' => 'Update a general ledger account',
    'description' => 'This endpoint can be used to update the name or code of a GL account;',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_accounting_all_connections_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetAccountingAllConnectionsResource',
    'type' => 'read',
    'name' => 'Fetch all accounting connections for the current business',
    'description' => 'Fetch all accounting connections for the current business',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_delete_accounting_connection_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteAccountingConnectionResource',
    'type' => 'write',
    'name' => 'Disconnect an accounting connection',
    'description' => 'This endpoint only allows disconnecting API based connections.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_accounting_current_connection_resource_deprecated' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetAccountingCurrentConnectionResourceDeprecated',
    'type' => 'read',
    'name' => 'Fetch the current active accounting connection',
    'description' => 'This endpoint is now deprecated. Please use the `/all-connections` endpoint instead here.',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_accounting_connection_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostAccountingConnectionResource',
    'type' => 'write',
    'name' => 'Register a new API based accounting connection',
    'description' => 'A connection is required in order to use our accounting API functionality. If a Universal CSV connection already exists, it will be upgraded to an API based connection.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_accounting_connection_detail_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetAccountingConnectionDetailResource',
    'type' => 'read',
    'name' => 'Fetch an accounting connection by ID',
    'description' => 'Fetch an accounting connection by ID',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_accounting_connection_detail_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchAccountingConnectionDetailResource',
    'type' => 'write',
    'name' => 'Update an accounting connection',
    'description' => 'This endpoint is restricted to Accounting API based connections.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_reactivate_connection_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostReactivateConnectionResource',
    'type' => 'write',
    'name' => 'Reactivate a previously unlinked accounting connection',
    'description' => 'This endpoint allows reactivating a previously disconnected accounting connection by changing its status back to linked. This preserves all previous accounting field configurati...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_custom_field_option_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCustomFieldOptionListResource',
    'type' => 'read',
    'name' => 'List options for a given custom accounting field',
    'description' => 'List options for a given custom accounting field',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_custom_field_option_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostCustomFieldOptionListResource',
    'type' => 'write',
    'name' => 'Upload new options',
    'description' => 'You can upload up to 500 new field options for a given custom accounting field in an all-or-nothing fashion. If a field option within a batch is malformed or violates a database...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_custom_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteCustomFieldOptionResource',
    'type' => 'write',
    'name' => 'Delete a custom accounting field option',
    'description' => 'Delete a custom accounting field option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_custom_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCustomFieldOptionResource',
    'type' => 'read',
    'name' => 'Fetch a custom accounting field option',
    'description' => 'Fetch a custom accounting field option',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_custom_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchCustomFieldOptionResource',
    'type' => 'write',
    'name' => 'Update a custom accounting field option',
    'description' => 'Update a custom accounting field option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_put_custom_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPutCustomFieldOptionResource',
    'type' => 'write',
    'name' => 'Update a custom accounting field option',
    'description' => 'Update a custom accounting field option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_custom_field_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCustomFieldListResource',
    'type' => 'read',
    'name' => 'List custom accounting fields',
    'description' => 'List custom accounting fields',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_custom_field_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostCustomFieldListResource',
    'type' => 'write',
    'name' => 'Create a new custom accounting field',
    'description' => 'If a custom field with the same id already exists on Ramp, then that existing one will be returned instead of creating a new one; If the existing custom field is inactive, it wi...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_custom_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteCustomFieldResource',
    'type' => 'write',
    'name' => 'Delete a custom accounting field',
    'description' => 'Delete a custom accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_custom_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCustomFieldResource',
    'type' => 'read',
    'name' => 'Fetch a custom accounting field',
    'description' => 'Fetch a custom accounting field',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_custom_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchCustomFieldResource',
    'type' => 'write',
    'name' => 'Update a custom accounting field',
    'description' => 'Update a custom accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_inventory_item_field_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteInventoryItemFieldListResource',
    'type' => 'write',
    'name' => 'Delete inventory item accounting field',
    'description' => 'Delete inventory item accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_inventory_item_field_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetInventoryItemFieldListResource',
    'type' => 'read',
    'name' => 'Fetch inventory item accounting field',
    'description' => 'Returns the inventory item accounting field for the current accounting connection.',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_inventory_item_field_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchInventoryItemFieldListResource',
    'type' => 'write',
    'name' => 'Update inventory item accounting field',
    'description' => 'Update inventory item accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_inventory_item_field_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostInventoryItemFieldListResource',
    'type' => 'write',
    'name' => 'Create a new inventory item accounting field',
    'description' => 'There can only be one active inventory item accounting field per accounting connection.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_inventory_item_field_options_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetInventoryItemFieldOptionsListResource',
    'type' => 'read',
    'name' => 'List inventory item options',
    'description' => 'List inventory item options',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_inventory_item_field_options_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostInventoryItemFieldOptionsListResource',
    'type' => 'write',
    'name' => 'Upload inventory item options',
    'description' => 'There must be an active inventory item accounting field for the accounting connection.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_inventory_item_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteInventoryItemFieldOptionResource',
    'type' => 'write',
    'name' => 'Delete an inventory item option',
    'description' => 'Delete an inventory item option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_inventory_item_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchInventoryItemFieldOptionResource',
    'type' => 'write',
    'name' => 'Update an inventory item option',
    'description' => 'Update an inventory item option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_ramp_field_option_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostRampFieldOptionListResource',
    'type' => 'write',
    'name' => 'Upload new options for a Ramp-only field',
    'description' => 'Upload new options for a Ramp-only field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_ramp_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteRampFieldOptionResource',
    'type' => 'write',
    'name' => 'Delete a Ramp-only field option',
    'description' => 'Delete a Ramp-only field option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_ramp_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchRampFieldOptionResource',
    'type' => 'write',
    'name' => 'Update a Ramp-only field option',
    'description' => 'Update a Ramp-only field option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_ramp_field_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetRampFieldListResource',
    'type' => 'read',
    'name' => 'List Ramp-only accounting fields',
    'description' => 'List Ramp-only accounting fields',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_ramp_field_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostRampFieldListResource',
    'type' => 'write',
    'name' => 'Create a Ramp-only accounting field',
    'description' => 'Create a Ramp-only accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_ramp_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteRampFieldResource',
    'type' => 'write',
    'name' => 'Delete a Ramp-only accounting field',
    'description' => 'Delete a Ramp-only accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_ramp_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetRampFieldResource',
    'type' => 'read',
    'name' => 'Fetch a Ramp-only accounting field',
    'description' => 'Fetch a Ramp-only accounting field',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_ramp_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchRampFieldResource',
    'type' => 'write',
    'name' => 'Update a Ramp-only accounting field',
    'description' => 'Update a Ramp-only accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_ready_to_sync_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostReadyToSyncResource',
    'type' => 'write',
    'name' => 'Post ready to sync status',
    'description' => 'This endpoint allows customers to mark a list of objects as ready to sync by their object IDs.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_sync_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostSyncListResource',
    'type' => 'write',
    'name' => 'Post sync status',
    'description' => 'This endpoint allows customers to notify Ramp of a list of sync results. An idempotency key is required to ensure that subsequent requests are properly handled.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_tax_code_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteTaxCodeFieldResource',
    'type' => 'write',
    'name' => 'Delete tax code accounting field',
    'description' => 'Delete tax code accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_tax_code_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTaxCodeFieldResource',
    'type' => 'read',
    'name' => 'Fetch tax code accounting field',
    'description' => 'Returns the tax code accounting field for the current accounting connection.',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_tax_code_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchTaxCodeFieldResource',
    'type' => 'write',
    'name' => 'Update tax code accounting field',
    'description' => 'Update tax code accounting field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_tax_code_field_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostTaxCodeFieldResource',
    'type' => 'write',
    'name' => 'Create a new tax code accounting field',
    'description' => 'There can only be one active tax code accounting field per accounting connection.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_tax_code_field_options_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTaxCodeFieldOptionsListResource',
    'type' => 'read',
    'name' => 'List tax code options',
    'description' => 'List tax code options',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_tax_code_field_options_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostTaxCodeFieldOptionsListResource',
    'type' => 'write',
    'name' => 'Upload tax code options',
    'description' => 'There must be an active tax code accounting field for the accounting connection.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_tax_code_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteTaxCodeFieldOptionResource',
    'type' => 'write',
    'name' => 'Delete a tax code option',
    'description' => 'Delete a tax code option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_tax_code_field_option_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchTaxCodeFieldOptionResource',
    'type' => 'write',
    'name' => 'Update a tax code option',
    'description' => 'Update a tax code option',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_tax_code_rates_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTaxCodeRatesListResource',
    'type' => 'read',
    'name' => 'List tax rates',
    'description' => 'List tax rates',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_tax_code_rates_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostTaxCodeRatesListResource',
    'type' => 'write',
    'name' => 'Upload tax rates',
    'description' => 'You can upload up to 500 tax rates in an all-or-nothing fashion. If a tax rate within a batch is malformed or violates a database constraint, the entire batch will be disregarde...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_tax_rate_detail_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteTaxRateDetailResource',
    'type' => 'write',
    'name' => 'Delete a tax rate',
    'description' => 'Delete a tax rate',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_tax_rate_detail_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchTaxRateDetailResource',
    'type' => 'write',
    'name' => 'Update a tax rate',
    'description' => 'Update a tax rate',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_accounting_vendor_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetAccountingVendorListResource',
    'type' => 'read',
    'name' => 'List vendors',
    'description' => 'List vendors',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_accounting_vendor_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostAccountingVendorListResource',
    'type' => 'write',
    'name' => 'Upload vendors',
    'description' => 'You can upload up to 500 vendors in an all-or-nothing fashion. If a vendors within a batch is malformed or violates a database constraint, the entire batch containing that vendo...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_accounting_vendor_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteAccountingVendorResource',
    'type' => 'write',
    'name' => 'Delete a vendor',
    'description' => 'Delete a vendor',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_accounting_vendor_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetAccountingVendorResource',
    'type' => 'read',
    'name' => 'Fetch a vendor',
    'description' => 'Fetch a vendor',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_accounting_vendor_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchAccountingVendorResource',
    'type' => 'write',
    'name' => 'Update a vendor',
    'description' => 'Update a vendor',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_application_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetApplicationResource',
    'type' => 'read',
    'name' => 'Fetch a financing application',
    'description' => 'Since each business can only have one active financing application, this endpoint will only ever return a single application.',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_application_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostApplicationResource',
    'type' => 'write',
    'name' => 'Create a financing application',
    'description' => 'This endpoint will create a new business for the applicant and email them with instructions to sign up and continue the application. If the applicant email already exists in Ram...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_audit_log_events_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetAuditLogEventsListResource',
    'type' => 'read',
    'name' => 'Get audit log events',
    'description' => 'Get audit log events',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_bank_account_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetBankAccountListWithPagination',
    'type' => 'read',
    'name' => 'List bank accounts',
    'description' => 'List bank accounts',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_bank_account_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetBankAccountResource',
    'type' => 'read',
    'name' => 'Get bank account details',
    'description' => 'Get bank account details',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_bill_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetBillListWithPagination',
    'type' => 'read',
    'name' => 'List bills',
    'description' => 'List bills',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_bill_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostBillListWithPagination',
    'type' => 'write',
    'name' => 'Create a bill',
    'description' => 'Batch payments cannot be created in the API.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_draft_bill_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDraftBillListWithPagination',
    'type' => 'read',
    'name' => 'List draft bills',
    'description' => 'List draft bills',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_draft_bill_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDraftBillListWithPagination',
    'type' => 'write',
    'name' => 'Create a draft bill',
    'description' => 'Create a draft bill',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_draft_bill_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDraftBillResource',
    'type' => 'read',
    'name' => 'Fetch a draft bill',
    'description' => 'Fetch a draft bill',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_draft_bill_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchDraftBillResource',
    'type' => 'write',
    'name' => 'Update a draft bill',
    'description' => 'Update a draft bill',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_draft_bill_attachment_upload_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDraftBillAttachmentUploadResource',
    'type' => 'write',
    'name' => 'Upload a file attachment to an existing draft bill',
    'description' => 'Upload a file as an attachment to a draft bill. INVOICE type attachments cannot be uploaded if one already exists on the draft bill. This endpoint accepts the [multipart/form-da...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_bill_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteBillResource',
    'type' => 'write',
    'name' => 'Archive a bill',
    'description' => 'This is a destructive action. Associated inflight payments will be cancelled if possible or any attached one-time-card will be terminated. Paid bills and bills belonging to a ba...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_bill_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetBillResource',
    'type' => 'read',
    'name' => 'Fetch a bill',
    'description' => 'Fetch a bill',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_bill_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchBillResource',
    'type' => 'write',
    'name' => 'Update a bill',
    'description' => 'Only approved bills can be updated.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_bill_attachment_upload_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostBillAttachmentUploadResource',
    'type' => 'write',
    'name' => 'Upload a file attachment to an existing bill',
    'description' => 'Upload a file as an attachment to a bill. INVOICE type attachments cannot be uploaded if one already exists on the bill. This endpoint accepts the [multipart/form-data](https://...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_blank_canvas_approval_document_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostBlankCanvasApprovalDocumentResource',
    'type' => 'write',
    'name' => 'Upload a document for a blank canvas workflow step',
    'description' => 'This endpoint accepts the [multipart/form-data](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods/POST) format. Include the document as a part with `Content-Disposition:...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_blank_canvas_approval_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostBlankCanvasApprovalResource',
    'type' => 'write',
    'name' => 'Approve or reject a blank canvas workflow step',
    'description' => 'Approve or reject a blank canvas workflow step',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_blank_canvas_approval_external_approval_metadata_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchBlankCanvasApprovalExternalApprovalMetadataResource',
    'type' => 'write',
    'name' => 'Update metadata for a blank canvas external approval request',
    'description' => 'Update metadata for a blank canvas external approval request',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_business_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetBusinessResource',
    'type' => 'read',
    'name' => 'Fetch the company information',
    'description' => 'Fetch the company information',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_business_balance_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetBusinessBalanceResource',
    'type' => 'read',
    'name' => 'Fetch the company balance information',
    'description' => 'Fetch the company balance information',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_card_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCardListWithPagination',
    'type' => 'read',
    'name' => 'List cards',
    'description' => 'List cards',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_physical_card' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostPhysicalCard',
    'type' => 'write',
    'name' => 'Create a physical card',
    'description' => 'Call this endpoint to create an async task to request for new physical card.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_card_deferred_task_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCardDeferredTaskResource',
    'type' => 'read',
    'name' => 'Fetch deferred task status',
    'description' => 'Fetch deferred task status',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_virtual_card' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVirtualCard',
    'type' => 'write',
    'name' => 'Create a virtual card',
    'description' => 'Call this endpoint to create an async task to request for new virtual card.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_card_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCardResource',
    'type' => 'read',
    'name' => 'Fetch a card',
    'description' => 'Fetch a card',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_card_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchCardResource',
    'type' => 'write',
    'name' => 'Update a card',
    'description' => 'This endpoint allow you update the owner, display name, and spend restrictions of a card.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_card_suspension_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostCardSuspensionResource',
    'type' => 'write',
    'name' => 'Suspend a card',
    'description' => 'Call this endpoint to create an async task to suspend a card so that it is locked from use. The suspension is revertable.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_card_termination_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostCardTerminationResource',
    'type' => 'write',
    'name' => 'Terminate a card',
    'description' => 'Call this endpoint to create an async task to terminate a card permanently. Please note that this action is irreversible.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_card_unsuspension_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostCardUnsuspensionResource',
    'type' => 'write',
    'name' => 'Unlock a card',
    'description' => 'Call this endpoint to create an async task to remove a card\'s suspension so that it may be used again.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_cashback_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCashbackListWithPagination',
    'type' => 'read',
    'name' => 'List cashback payments',
    'description' => 'List cashback payments',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_cashback_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCashbackResource',
    'type' => 'read',
    'name' => 'Fetch a cashback payment',
    'description' => 'Fetch a cashback payment',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_comments_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCommentsResource',
    'type' => 'read',
    'name' => 'List comments on an object\'s discussion thread',
    'description' => 'Requires `{resource_name}:read` scope and may require additional access. See `object_type` description for more information.',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_comments_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostCommentsResource',
    'type' => 'write',
    'name' => 'Create a comment on an object\'s discussion thread',
    'description' => 'Requires `{resource_name}:write` scope and may require additional access. See `object_type` description for more information.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_custom_form_collection_response_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCustomFormCollectionResponseResource',
    'type' => 'read',
    'name' => 'Fetch a custom form collection response by ID',
    'description' => 'Fetch a custom form collection response by ID',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_dev_api_configure_custom_tables' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiConfigureCustomTables',
    'type' => 'write',
    'name' => 'Create Custom Table',
    'description' => 'Create Custom Table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_configure_custom_table_columns' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiConfigureCustomTableColumns',
    'type' => 'write',
    'name' => 'Create Custom Table column',
    'description' => 'Create Custom Table column',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_dev_api_rename_custom_table_column' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchDevApiRenameCustomTableColumn',
    'type' => 'write',
    'name' => 'Change the API name of a Custom Table\'s Column',
    'description' => 'Change the API name of a Custom Table\'s Column',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_configure_native_tables' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiConfigureNativeTables',
    'type' => 'write',
    'name' => 'Extend Native Ramp table',
    'description' => 'Extend Native Ramp table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_configure_native_table_columns' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiConfigureNativeTableColumns',
    'type' => 'write',
    'name' => 'Create Native Ramp table field',
    'description' => 'Create Native Ramp table field',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_dev_api_rename_native_table_column' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchDevApiRenameNativeTableColumn',
    'type' => 'write',
    'name' => 'Change the API name of a Native Table\'s Custom Record Column',
    'description' => 'Change the API name of a Native Table\'s Custom Record Column',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_dev_api_custom_table' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDevApiCustomTable',
    'type' => 'read',
    'name' => 'List Custom Tables',
    'description' => 'List Custom Tables',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_dev_api_custom_table_column' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDevApiCustomTableColumn',
    'type' => 'read',
    'name' => 'List Custom Table columns',
    'description' => 'List Custom Table columns',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_delete_dev_api_custom_row' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteDevApiCustomRow',
    'type' => 'write',
    'name' => 'Delete rows from a Custom Table',
    'description' => 'Delete rows from a Custom Table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_dev_api_custom_row' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDevApiCustomRow',
    'type' => 'read',
    'name' => 'List Custom Table rows',
    'description' => 'List Custom Table rows',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_put_dev_api_custom_row' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPutDevApiCustomRow',
    'type' => 'write',
    'name' => 'Set values for rows of a Custom Table',
    'description' => 'Set values for rows of a Custom Table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_dev_api_change_custom_row_external_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchDevApiChangeCustomRowExternalKey',
    'type' => 'write',
    'name' => 'Change the external key of a Custom Table row',
    'description' => 'Change the external key of a Custom Table row',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_append_custom_row_cells' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiAppendCustomRowCells',
    'type' => 'write',
    'name' => 'Append cells to a Custom Table',
    'description' => 'Append cells to a Custom Table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_remove_custom_row_cells' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiRemoveCustomRowCells',
    'type' => 'write',
    'name' => 'Remove cells from a Custom Table',
    'description' => 'Remove cells from a Custom Table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_dev_api_matrix_tables' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDevApiMatrixTables',
    'type' => 'read',
    'name' => 'List all Matrix tables for the business',
    'description' => 'List all Matrix tables for the business',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_dev_api_matrix_tables' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiMatrixTables',
    'type' => 'write',
    'name' => 'Create a Matrix table',
    'description' => 'Matrix tables are special-purpose lookup tables where unique combinations of input values map to result values.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_add_matrix_result_column' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiAddMatrixResultColumn',
    'type' => 'write',
    'name' => 'Add a result column to an existing Matrix table',
    'description' => 'Allows adding result columns to already-created matrix tables without modifying the input columns. Only result columns (users and accounting_field_options) can be added. Input c...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_dev_api_rename_matrix_column' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchDevApiRenameMatrixColumn',
    'type' => 'write',
    'name' => 'Change the API name of a Matrix table column (input or result)',
    'description' => 'This changes the internal name used in API calls while preserving the human-readable label. Both input and result columns can be renamed.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_matrix_list_rows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiMatrixListRows',
    'type' => 'write',
    'name' => 'List Matrix table rows',
    'description' => 'Returns rows with inputs and results separated. Inputs are always complete (all input columns), results are sparse (only set values).',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_rename_matrix_table' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiRenameMatrixTable',
    'type' => 'write',
    'name' => 'Change the API name of a Matrix table',
    'description' => 'Change the API name of a Matrix table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_put_dev_api_matrix_put_rows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPutDevApiMatrixPutRows',
    'type' => 'write',
    'name' => 'Upsert Matrix table rows',
    'description' => 'Creates new rows or updates existing rows based on input values. Input values define row identity (via external_key). Result values are mutable and can be partially updated.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_matrix_append_cells' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiMatrixAppendCells',
    'type' => 'write',
    'name' => 'Append cells to Matrix table rows',
    'description' => 'Adds values to many-to-many result columns without replacing existing values. Only works on many-to-many result columns. Set ignore_duplicates=true to skip existing duplicate ce...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_matrix_remove_cells' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiMatrixRemoveCells',
    'type' => 'write',
    'name' => 'Remove cells from Matrix table rows',
    'description' => 'Removes specific values from many-to-many result columns without affecting other values.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_dev_api_delete_matrix_row' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteDevApiDeleteMatrixRow',
    'type' => 'write',
    'name' => 'Delete a single Matrix table row by ID',
    'description' => 'Deletes the matrix row with the specified ID from the matrix table.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_dev_api_native_table' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDevApiNativeTable',
    'type' => 'read',
    'name' => 'List Native Ramp tables',
    'description' => 'List Native Ramp tables',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_dev_api_native_table_column' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDevApiNativeTableColumn',
    'type' => 'read',
    'name' => 'List Custom Columns for a Native Ramp table',
    'description' => 'List Custom Columns for a Native Ramp table',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_dev_api_native_row' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDevApiNativeRow',
    'type' => 'read',
    'name' => 'List Custom Column values for rows of a Native Ramp table',
    'description' => 'List Custom Column values for rows of a Native Ramp table',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_put_dev_api_native_row' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPutDevApiNativeRow',
    'type' => 'write',
    'name' => 'Set values for rows of a Native Ramp table',
    'description' => 'Set values for rows of a Native Ramp table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_append_native_row_cells' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiAppendNativeRowCells',
    'type' => 'write',
    'name' => 'Append cells to a Native Ramp table',
    'description' => 'Append cells to a Native Ramp table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_dev_api_remove_native_row_cells' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDevApiRemoveNativeRowCells',
    'type' => 'write',
    'name' => 'Remove cells from a Native Ramp table',
    'description' => 'Remove cells from a Native Ramp table',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_department_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDepartmentListWithPagination',
    'type' => 'read',
    'name' => 'List departments',
    'description' => 'List departments',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_department_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostDepartmentListWithPagination',
    'type' => 'write',
    'name' => 'Create a department',
    'description' => 'Create a department',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_department_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetDepartmentResource',
    'type' => 'read',
    'name' => 'Fetch a department',
    'description' => 'Fetch a department',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_department_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchDepartmentResource',
    'type' => 'write',
    'name' => 'Update a department',
    'description' => 'Update a department',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_ramp_embedded_card_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostRampEmbeddedCardResource',
    'type' => 'write',
    'name' => 'Create an embed init token for a card',
    'description' => 'The specified card must be activated and currently active',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_entity_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetEntityListWithPagination',
    'type' => 'read',
    'name' => 'List business entities',
    'description' => 'List business entities',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_entity_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetEntityResource',
    'type' => 'read',
    'name' => 'Get a business entity',
    'description' => 'Get a business entity',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_item_receipts_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetItemReceiptsResource',
    'type' => 'read',
    'name' => 'List item receipts',
    'description' => 'List item receipts',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_item_receipts_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostItemReceiptsResource',
    'type' => 'write',
    'name' => 'Create an item receipt',
    'description' => 'Create an item receipt',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_item_receipt_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteItemReceiptSingleResource',
    'type' => 'write',
    'name' => 'Delete an item receipt',
    'description' => 'Delete an item receipt',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_item_receipt_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetItemReceiptSingleResource',
    'type' => 'read',
    'name' => 'Fetch an item receipt',
    'description' => 'Fetch an item receipt',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_spend_limit_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetSpendLimitListWithPagination',
    'type' => 'read',
    'name' => 'List limits',
    'description' => 'List limits',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_spend_limit_creation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostSpendLimitCreation',
    'type' => 'write',
    'name' => 'Create a limit',
    'description' => 'Limit may either be created with spend program id (can provide display name and spending restrictions, cannot permitted spend types) or without (must provide display name, spend...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_spend_limit_deferred_task_status' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetSpendLimitDeferredTaskStatus',
    'type' => 'read',
    'name' => 'Fetch deferred task status',
    'description' => 'Fetch deferred task status',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_spend_limit_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetSpendLimitResource',
    'type' => 'read',
    'name' => 'Fetch a limit',
    'description' => 'Fetch a limit',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_spend_limit_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchSpendLimitResource',
    'type' => 'write',
    'name' => 'Update a limit',
    'description' => 'Update a limit',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_put_spend_limit_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPutSpendLimitResource',
    'type' => 'write',
    'name' => 'Update a limit',
    'description' => 'Update a limit',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_put_spend_allocation_add_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPutSpendAllocationAddUsers',
    'type' => 'write',
    'name' => 'Add new users into a shared limit',
    'description' => 'Add new users into a shared limit',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_spend_limit_termination_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostSpendLimitTerminationResource',
    'type' => 'write',
    'name' => 'Terminate a limit',
    'description' => 'This endpoint creates an async task to terminate a limit permanently.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_spend_allocation_delete_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteSpendAllocationDeleteUsers',
    'type' => 'write',
    'name' => 'Remove users from a shared limit',
    'description' => 'Remove users from a shared limit',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_spend_limit_suspension_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostSpendLimitSuspensionResource',
    'type' => 'write',
    'name' => 'Suspend a limit',
    'description' => 'Suspend a limit',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_spend_limit_unsuspension_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostSpendLimitUnsuspensionResource',
    'type' => 'write',
    'name' => 'Unsuspend a limit',
    'description' => 'Unsuspend a limit',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_location_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetLocationListResource',
    'type' => 'read',
    'name' => 'List locations',
    'description' => 'List locations',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_location_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostLocationListResource',
    'type' => 'write',
    'name' => 'Create a location',
    'description' => 'Create a location',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_location_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetLocationSingleResource',
    'type' => 'read',
    'name' => 'Fetch a location',
    'description' => 'Fetch a location',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_location_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchLocationSingleResource',
    'type' => 'write',
    'name' => 'Update a location',
    'description' => 'Update a location',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_memo_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetMemoListWithPagination',
    'type' => 'read',
    'name' => 'List memos',
    'description' => 'List memos',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_memo_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetMemoSingleResource',
    'type' => 'read',
    'name' => 'Fetch a transaction memo',
    'description' => 'Fetch a transaction memo',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_memo_create_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostMemoCreateSingleResource',
    'type' => 'write',
    'name' => 'Upload a new memo for a transaction',
    'description' => 'Upload a new memo for a transaction',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_merchant_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetMerchantListWithPagination',
    'type' => 'read',
    'name' => 'List merchants',
    'description' => 'List merchants',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_purchase_orders_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetPurchaseOrdersResource',
    'type' => 'read',
    'name' => 'List purchase orders',
    'description' => 'List purchase orders',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_purchase_orders_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostPurchaseOrdersResource',
    'type' => 'write',
    'name' => 'Create a purchase order',
    'description' => 'Create a purchase order',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_purchase_order_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetPurchaseOrderSingleResource',
    'type' => 'read',
    'name' => 'Fetch a purchase order',
    'description' => 'Fetch a purchase order',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_purchase_order_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchPurchaseOrderSingleResource',
    'type' => 'write',
    'name' => 'Update a purchase order',
    'description' => 'Purchase order must be approved.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_purchase_order_archive_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostPurchaseOrderArchiveResource',
    'type' => 'write',
    'name' => 'Archive a purchase order',
    'description' => 'Archive a purchase order',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_purchase_order_line_items_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostPurchaseOrderLineItemsResource',
    'type' => 'write',
    'name' => 'Add line items to an existing purchase order',
    'description' => 'Add line items to an existing purchase order',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_purchase_order_line_item_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeletePurchaseOrderLineItemSingleResource',
    'type' => 'write',
    'name' => 'Delete a single line item from an existing purchase order',
    'description' => 'Purchase order must be approved.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_purchase_order_line_item_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchPurchaseOrderLineItemSingleResource',
    'type' => 'write',
    'name' => 'Update a single line item on an existing purchase order',
    'description' => 'Purchase order must be approved.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_receipt_integration_opted_out_emails_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetReceiptIntegrationOptedOutEmailsListResource',
    'type' => 'read',
    'name' => 'List emails opted out of receipt integrations',
    'description' => 'List emails opted out of receipt integrations',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_receipt_integration_opted_out_emails_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostReceiptIntegrationOptedOutEmailsListResource',
    'type' => 'write',
    'name' => 'Add a new email to receipt integrations opt-out list',
    'description' => 'Add a new email to receipt integrations opt-out list',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_receipt_integration_opted_out_emails_delete_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteReceiptIntegrationOptedOutEmailsDeleteResource',
    'type' => 'write',
    'name' => 'Remove an email from receipt integration opt-out list',
    'description' => 'Successful request will opt-in email to receipt integrations.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_receipt_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetReceiptList',
    'type' => 'read',
    'name' => 'List receipts',
    'description' => 'List receipts',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_receipt_upload' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostReceiptUpload',
    'type' => 'write',
    'name' => 'Upload a receipt',
    'description' => 'image and optionally associate it with a transaction. If a `transaction_id` is provided, the receipt will be linked directly to that transaction. If not, Ramp will attempt to au...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_receipt_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetReceiptSingleResource',
    'type' => 'read',
    'name' => 'Fetch a receipt',
    'description' => 'Fetch a receipt',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_reimbursement_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetReimbursementListWithPagination',
    'type' => 'read',
    'name' => 'List reimbursements',
    'description' => 'List reimbursements',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_mileage_reimbursement_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostMileageReimbursementResource',
    'type' => 'write',
    'name' => 'Create a mileage reimbursement',
    'description' => 'Create a mileage reimbursement',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_reimbursement_receipt_upload' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostReimbursementReceiptUpload',
    'type' => 'write',
    'name' => 'Upload a receipt for a reimbursement',
    'description' => 'If a `reimbursement_id` is provided, the receipt will be linked directly to that reimbursement. If not, Ramp will attempt to automatically create a draft reimbursement via OCR. ...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_reimbursement_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetReimbursementResource',
    'type' => 'read',
    'name' => 'Fetch a reimbursement',
    'description' => 'Fetch a reimbursement',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_repayment_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetRepaymentListWithPagination',
    'type' => 'read',
    'name' => 'List repayments',
    'description' => 'This endpoint supports filtering. Results are sorted by creation date in descending order. Note that entity_id filtering is not supported yet.',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_spend_program_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetSpendProgramResource',
    'type' => 'read',
    'name' => 'List spend programs',
    'description' => 'List spend programs',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_spend_program_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostSpendProgramResource',
    'type' => 'write',
    'name' => 'Create a spend program',
    'description' => 'Create a spend program',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_spend_program_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetSpendProgramSingleResource',
    'type' => 'read',
    'name' => 'Fetch a spend program',
    'description' => 'Fetch a spend program',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_spend_program_workflow_nodes_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetSpendProgramWorkflowNodesResource',
    'type' => 'read',
    'name' => 'Fetch blank canvas workflow nodes for a spend program',
    'description' => 'Fetch blank canvas workflow nodes for a spend program',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_spend_request_draft_via_ocr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostSpendRequestDraftViaOcr',
    'type' => 'write',
    'name' => 'Create a draft spend request via OCR',
    'description' => 'Requests should be made with `multipart/form-data` content type.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_statement_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetStatementListWithPagination',
    'type' => 'read',
    'name' => 'List statements',
    'description' => 'List statements',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_statement_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetStatementResource',
    'type' => 'read',
    'name' => 'Fetch a statement',
    'description' => 'Fetch a statement',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostToken',
    'type' => 'write',
    'name' => 'Create a token',
    'description' => 'Expects two headers: - Authorization header formed from base-64 encoded client credentials as `Authorization: Basic ` - `Content-Type: application/x-www-form-urlencoded` Require...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_revoke_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostRevokeToken',
    'type' => 'write',
    'name' => 'Revoke an access or refresh token',
    'description' => 'Expects an authorization header formed from base-64 encoded client credentials as `Authorization: Basic `. Content body must be form-encoded. Example: ``` curl \\ -X POST \\ -H "A...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_transactions_canonical_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTransactionsCanonicalListWithPagination',
    'type' => 'read',
    'name' => 'List transactions',
    'description' => 'This endpoint supports filtering and ordering. If state is not set, all transactions except declined transactions will be returned. Note that setting multiple ordering parameter...',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_transaction_canonical_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTransactionCanonicalResource',
    'type' => 'read',
    'name' => 'Fetch a transaction',
    'description' => 'Fetch a transaction',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_transfer_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTransferListWithPagination',
    'type' => 'write',
    'name' => 'List transfer payments',
    'description' => 'For information on how to use this endpoint, refer to the [Transfers Guide](/developer-api/v1/guides/transfers).',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_transfer_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTransferResource',
    'type' => 'write',
    'name' => 'Fetch a transfer payment',
    'description' => 'For information on how to use this endpoint, refer to the [Transfers Guide](/developer-api/v1/guides/transfers).',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_trip_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTripListResource',
    'type' => 'read',
    'name' => 'List all trips for the business',
    'description' => 'List all trips for the business',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_trip_single_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetTripSingleResource',
    'type' => 'read',
    'name' => 'Fetch a trip',
    'description' => 'Fetch a trip',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_unified_request_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetUnifiedRequestListWithPagination',
    'type' => 'read',
    'name' => 'List unified requests with pagination',
    'description' => 'NOTE: - Response schema is not finalized and will have breaking changes prior to release - This endpoint _is_ user aware, meaning perm-based filtering is applied to the query',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_unified_request_detail_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetUnifiedRequestDetailResource',
    'type' => 'read',
    'name' => 'Get details for a specific UnifiedRequest',
    'description' => 'NOTE: - Response schema is not finalized and will have breaking changes prior to release - This endpoint _is_ user aware, meaning perm-based filtering is applied to the query',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_user_list_with_pagination' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetUserListWithPagination',
    'type' => 'read',
    'name' => 'List users',
    'description' => 'List users',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_user_creation_deferred_task' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostUserCreationDeferredTask',
    'type' => 'write',
    'name' => 'Create a user invite',
    'description' => 'Call this endpoint to trigger an async task to send out a user invite via email. Users will need to accept the invite in order to be onboarded. Assign a user to a specific entit...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_user_deferred_task_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetUserDeferredTaskResource',
    'type' => 'read',
    'name' => 'Fetch deferred task status',
    'description' => 'Fetch deferred task status',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_user_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetUserResource',
    'type' => 'read',
    'name' => 'Fetch a user',
    'description' => 'Fetch a user',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_user_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchUserResource',
    'type' => 'write',
    'name' => 'Update a user',
    'description' => 'Update a user',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_user_deactivation_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchUserDeactivationResource',
    'type' => 'write',
    'name' => 'Deactivate a user',
    'description' => 'When users are deactivated, they will no longer be able to log in, spend on cards, or receive any notifications from Ramp.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_user_invite_action_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostUserInviteActionResource',
    'type' => 'write',
    'name' => 'Manage a user\'s invite lifecycle',
    'description' => 'Performs one of three actions against a draft user, delegating to the Identity-owned invite / scheduled-invitation services: - `SCHEDULE`: Create or update a scheduled invitatio...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_patch_user_reactivation_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchUserReactivationResource',
    'type' => 'write',
    'name' => 'Reactivate a user',
    'description' => 'Upon reactivation, users can log in to Ramp again, spend on their previously issued cards and resume receiving Ramp notifications.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_card_vault_creation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostCardVaultCreation',
    'type' => 'write',
    'name' => 'Create a spend limit and retrieve sensitive card details',
    'description' => 'Vault API access is required to use this endpoint.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_card_vault_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetCardVaultResource',
    'type' => 'read',
    'name' => 'Fetch a card\'s sensitive details',
    'description' => 'Accepts a card\'s ID and returns its sensitive details. Vault API access is required to use this endpoint.',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_vendor_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorListResource',
    'type' => 'read',
    'name' => 'List vendors',
    'description' => 'List vendors',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_vendor_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVendorListResource',
    'type' => 'write',
    'name' => 'Create a new vendor',
    'description' => 'Vendors created in the API are approved by default, and are not subject to existing approval policies.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_vendor_agreement_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVendorAgreementListResource',
    'type' => 'write',
    'name' => 'List vendor agreements',
    'description' => 'List vendor agreements',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_vendor_agreement_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteVendorAgreementResource',
    'type' => 'write',
    'name' => 'Delete a vendor agreement',
    'description' => 'Delete a vendor agreement',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_vendor_agreement_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorAgreementResource',
    'type' => 'read',
    'name' => 'Fetch a vendor agreement',
    'description' => 'Fetch a vendor agreement',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_vendor_agreement_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchVendorAgreementResource',
    'type' => 'write',
    'name' => 'Update a vendor agreement',
    'description' => 'Update a vendor agreement',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_vendor_agreement_document_upload_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVendorAgreementDocumentUploadResource',
    'type' => 'write',
    'name' => 'Upload documents for a vendor agreement',
    'description' => 'This endpoint accepts the [multipart/form-data](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods/POST) format. Include each agreement file as a repeated `documents` par...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_vendor_agreement_link_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVendorAgreementLinkResource',
    'type' => 'write',
    'name' => 'Link purchase orders or documents to a vendor agreement',
    'description' => 'Link purchase orders or documents to a vendor agreement',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_vendor_agreement_spend_request_link_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVendorAgreementSpendRequestLinkResource',
    'type' => 'write',
    'name' => 'Link a spend request to a vendor agreement',
    'description' => 'Link a spend request to a vendor agreement',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_vendor_agreement_unlink_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteVendorAgreementUnlinkResource',
    'type' => 'write',
    'name' => 'Unlink purchase orders or documents from a vendor agreement',
    'description' => 'Unlink purchase orders or documents from a vendor agreement',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_all_vendor_credits_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetAllVendorCreditsList',
    'type' => 'read',
    'name' => 'List all vendor credits for all vendors of a business',
    'description' => 'List all vendor credits for all vendors of a business',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_vendor_credit_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorCreditDetail',
    'type' => 'read',
    'name' => 'Fetch a vendor credit',
    'description' => 'Fetch a vendor credit',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_delete_vendor_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteVendorResource',
    'type' => 'write',
    'name' => 'Delete a vendor',
    'description' => 'A vendor cannot be deleted if it has associated transactions, bills, contracts, or spend requests.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_vendor_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorResource',
    'type' => 'read',
    'name' => 'Fetch a vendor',
    'description' => 'Fetch a vendor',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_patch_vendor_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPatchVendorResource',
    'type' => 'write',
    'name' => 'Update a vendor',
    'description' => 'Update a vendor',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_vendor_bank_account_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorBankAccountListResource',
    'type' => 'read',
    'name' => 'List vendor bank accounts',
    'description' => 'List vendor bank accounts',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_vendor_bank_account_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorBankAccountResource',
    'type' => 'read',
    'name' => 'Fetch a vendor bank account',
    'description' => 'Fetch a vendor bank account',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_vendor_bank_account_archive_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVendorBankAccountArchiveResource',
    'type' => 'write',
    'name' => 'Archive a vendor bank account',
    'description' => 'If the bank account has associated bills, drafts, or recurring templates, a replacement_bank_account_id must be provided in the request body.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_vendor_agreement_create_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVendorAgreementCreateResource',
    'type' => 'write',
    'name' => 'Create a vendor agreement',
    'description' => 'Create a vendor agreement',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_vendor_contact_list_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorContactListResource',
    'type' => 'read',
    'name' => 'List vendor contacts for vendor',
    'description' => 'List vendor contacts for vendor',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_vendor_contact_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorContactResource',
    'type' => 'read',
    'name' => 'Fetch a vendor contact',
    'description' => 'Fetch a vendor contact',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_get_vendor_credits_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetVendorCreditsList',
    'type' => 'read',
    'name' => 'List vendor credits by vendor',
    'description' => 'List vendor credits by vendor',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_vendor_bank_account_update_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostVendorBankAccountUpdateResource',
    'type' => 'write',
    'name' => 'Add to a vendor\'s bank account details',
    'description' => 'Adds payment details for the vendor through the approval workflow. The proposal may require approval depending on the business\'s approval policies. Supported payment methods: - ...',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_outbound_webhook_subscription_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetOutboundWebhookSubscriptionResource',
    'type' => 'read',
    'name' => 'Get all webhook subscriptions',
    'description' => 'Get all webhook subscriptions',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_outbound_webhook_subscription_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostOutboundWebhookSubscriptionResource',
    'type' => 'write',
    'name' => 'Creates a new webhook subscription',
    'description' => 'The newly registered subscription will be in the pending verficiation state. You will need to verify your endpoint with the provided challenge.',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_post_mock_outbound_webhook_event_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostMockOutboundWebhookEventResource',
    'type' => 'write',
    'name' => 'Create a mock webhook event for active subscriptions matching the event type',
    'description' => 'Create a mock webhook event for active subscriptions matching the event type',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_delete_outbound_webhook_subscription_detail_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampDeleteOutboundWebhookSubscriptionDetailResource',
    'type' => 'write',
    'name' => 'Delete a webhook subscription by id',
    'description' => 'Delete a webhook subscription by id',
    'icon' => 'ph:pencil-simple',
  ),
  'ramp_get_outbound_webhook_subscription_detail_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampGetOutboundWebhookSubscriptionDetailResource',
    'type' => 'read',
    'name' => 'Get a webhook subscription by id',
    'description' => 'Get a webhook subscription by id',
    'icon' => 'ph:currency-dollar',
  ),
  'ramp_post_outbound_webhook_subscription_verify_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Ramp\\Tools\\RampPostOutboundWebhookSubscriptionVerifyResource',
    'type' => 'write',
    'name' => 'Verify a webhook subscription',
    'description' => 'Verify a webhook subscription',
    'icon' => 'ph:pencil-simple',
  ),
]; }
    public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); } public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/ramp.md'; }
    /** @param  array<string, mixed>  $context  Optional account context from the host. */ private function resolveService(array $context = []): RampService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new RampService(accessToken:$creds->get('ramp','access_token','',$account), baseUrl:$creds->get('ramp','url','https://api.ramp.com',$account));} return app(RampService::class); }
}