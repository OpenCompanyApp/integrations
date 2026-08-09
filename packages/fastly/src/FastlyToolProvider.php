<?php

namespace OpenCompany\Integrations\Fastly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Fastly.
 *
 * Exposes Fastly's maintained generated API client operations for services,
 * configuration, purging, TLS, logging, products, stats, IAM, and edge data.
 */
class FastlyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'api_key_header','legacy_auth_type'=>'api_token','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Fastly authenticates with the Fastly-Key HTTP header.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'fastly'; } public function appMeta(): array { return ['label'=>'Fastly','description'=>'CDN, edge cloud, TLS, logging, purge, and service configuration','icon'=>'ph:cloud','logo'=>'simple-icons:fastly']; }
    public function integrationMeta(): array { return ['name'=>'Fastly','description'=>'Manage Fastly services, domains, versions, VCL, dictionaries, ACLs, logging endpoints, TLS, purge, stats, IAM, and product configuration.','icon'=>'ph:cloud','logo'=>'simple-icons:fastly','category'=>'data','badge'=>'verified','docs_url'=>'https://www.fastly.com/documentation/reference/api/','source_url'=>'https://github.com/fastly/fastly-php/tree/main/lib/Api']; }
    public function configSchema(): array { return [['key'=>'api_token','type'=>'secret','label'=>'API Token','required'=>true],['key'=>'api_url','type'=>'url','label'=>'API URL','default'=>'https://api.fastly.com','required'=>false],['key'=>'rt_url','type'=>'url','label'=>'Real-time API URL','default'=>'https://rt.fastly.com','required'=>false]]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $token=(string)($config['api_token']??''); $baseUrl=rtrim((string)($config['api_url']??'https://api.fastly.com'),'/'); if($token==='') return ['success'=>false,'error'=>'Fastly API token is required.']; try{$response=Http::withHeaders(['Fastly-Key'=>$token,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/service'); if(!$response->successful()) return ['success'=>false,'error'=>'Fastly API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Fastly at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['api_token'=>'required|string','api_url'=>'nullable|url','rt_url'=>'nullable|url']; } public function credentialFields(): array { return [['key'=>'api_token','type'=>'secret','label'=>'API Token','required'=>true],['key'=>'api_url','type'=>'url','label'=>'API URL','required'=>false,'default'=>'https://api.fastly.com'],['key'=>'rt_url','type'=>'url','label'=>'Real-time API URL','required'=>false,'default'=>'https://rt.fastly.com']]; }
    public function tools(): array { return array (
  'fastly_acl_create_acl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclCreateAcl',
    'type' => 'write',
    'name' => 'Create a new ACL',
    'description' => 'Create a new ACL',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acl_delete_acl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclDeleteAcl',
    'type' => 'write',
    'name' => 'Delete an ACL',
    'description' => 'Delete an ACL',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acl_entry_bulk_update_acl_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclEntryBulkUpdateAclEntries',
    'type' => 'write',
    'name' => 'Update multiple ACL entries',
    'description' => 'Update multiple ACL entries',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acl_entry_create_acl_entry' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclEntryCreateAclEntry',
    'type' => 'write',
    'name' => 'Create an ACL entry',
    'description' => 'Create an ACL entry',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acl_entry_delete_acl_entry' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclEntryDeleteAclEntry',
    'type' => 'write',
    'name' => 'Delete an ACL entry',
    'description' => 'Delete an ACL entry',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acl_entry_get_acl_entry' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclEntryGetAclEntry',
    'type' => 'read',
    'name' => 'Describe an ACL entry',
    'description' => 'Describe an ACL entry',
    'icon' => 'ph:cloud',
  ),
  'fastly_acl_entry_list_acl_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclEntryListAclEntries',
    'type' => 'read',
    'name' => 'List ACL entries',
    'description' => 'List ACL entries',
    'icon' => 'ph:cloud',
  ),
  'fastly_acl_entry_update_acl_entry' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclEntryUpdateAclEntry',
    'type' => 'write',
    'name' => 'Update an ACL entry',
    'description' => 'Update an ACL entry',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acl_get_acl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclGetAcl',
    'type' => 'read',
    'name' => 'Describe an ACL',
    'description' => 'Describe an ACL',
    'icon' => 'ph:cloud',
  ),
  'fastly_acl_list_acls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclListAcls',
    'type' => 'read',
    'name' => 'List ACLs',
    'description' => 'List ACLs',
    'icon' => 'ph:cloud',
  ),
  'fastly_acl_update_acl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclUpdateAcl',
    'type' => 'write',
    'name' => 'Update an ACL',
    'description' => 'Update an ACL',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acls_in_compute_compute_acl_create_acls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclsInComputeComputeAclCreateAcls',
    'type' => 'write',
    'name' => 'Create a new ACL',
    'description' => 'Create a new ACL',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acls_in_compute_compute_acl_delete_sacl_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclsInComputeComputeAclDeleteSaclId',
    'type' => 'write',
    'name' => 'Delete an ACL',
    'description' => 'Delete an ACL',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_acls_in_compute_compute_acl_list_acl_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclsInComputeComputeAclListAclEntries',
    'type' => 'read',
    'name' => 'List an ACL',
    'description' => 'List an ACL',
    'icon' => 'ph:cloud',
  ),
  'fastly_acls_in_compute_compute_acl_list_acls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclsInComputeComputeAclListAcls',
    'type' => 'read',
    'name' => 'List ACLs',
    'description' => 'List ACLs',
    'icon' => 'ph:cloud',
  ),
  'fastly_acls_in_compute_compute_acl_list_acls_sacl_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclsInComputeComputeAclListAclsSaclId',
    'type' => 'read',
    'name' => 'Describe an ACL',
    'description' => 'Describe an ACL',
    'icon' => 'ph:cloud',
  ),
  'fastly_acls_in_compute_compute_acl_lookup_acls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclsInComputeComputeAclLookupAcls',
    'type' => 'read',
    'name' => 'Lookup an ACL',
    'description' => 'Lookup an ACL',
    'icon' => 'ph:cloud',
  ),
  'fastly_acls_in_compute_compute_acl_update_acls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAclsInComputeComputeAclUpdateAcls',
    'type' => 'write',
    'name' => 'Update an ACL',
    'description' => 'Update an ACL',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apex_redirect_create_apex_redirect' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApexRedirectCreateApexRedirect',
    'type' => 'write',
    'name' => 'Create an apex redirect',
    'description' => 'Create an apex redirect',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apex_redirect_delete_apex_redirect' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApexRedirectDeleteApexRedirect',
    'type' => 'write',
    'name' => 'Delete an apex redirect',
    'description' => 'Delete an apex redirect',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apex_redirect_get_apex_redirect' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApexRedirectGetApexRedirect',
    'type' => 'read',
    'name' => 'Get an apex redirect',
    'description' => 'Get an apex redirect',
    'icon' => 'ph:cloud',
  ),
  'fastly_apex_redirect_list_apex_redirects' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApexRedirectListApexRedirects',
    'type' => 'read',
    'name' => 'List apex redirects',
    'description' => 'List apex redirects',
    'icon' => 'ph:cloud',
  ),
  'fastly_apex_redirect_update_apex_redirect' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApexRedirectUpdateApexRedirect',
    'type' => 'write',
    'name' => 'Update an apex redirect',
    'description' => 'Update an apex redirect',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_bulk_add_tags_to_operations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityBulkAddTagsToOperations',
    'type' => 'write',
    'name' => 'Bulk add tags to operations',
    'description' => 'Bulk add tags to operations',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_bulk_create_operations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityBulkCreateOperations',
    'type' => 'write',
    'name' => 'Bulk create operations',
    'description' => 'Bulk create operations',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_bulk_delete_operations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityBulkDeleteOperations',
    'type' => 'write',
    'name' => 'Bulk delete operations',
    'description' => 'Bulk delete operations',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_create_operation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityCreateOperation',
    'type' => 'write',
    'name' => 'Create operation',
    'description' => 'Create operation',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_create_operation_tag' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityCreateOperationTag',
    'type' => 'write',
    'name' => 'Create operation tag',
    'description' => 'Create operation tag',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_delete_operation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityDeleteOperation',
    'type' => 'write',
    'name' => 'Delete operation',
    'description' => 'Delete operation',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_delete_operation_tag' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityDeleteOperationTag',
    'type' => 'write',
    'name' => 'Delete operation tag',
    'description' => 'Delete operation tag',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_get_operation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityGetOperation',
    'type' => 'read',
    'name' => 'Retrieve operation',
    'description' => 'Retrieve operation',
    'icon' => 'ph:cloud',
  ),
  'fastly_apisecurity_operations_api_security_get_operation_tag' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityGetOperationTag',
    'type' => 'read',
    'name' => 'Retrieve operation tag',
    'description' => 'Retrieve operation tag',
    'icon' => 'ph:cloud',
  ),
  'fastly_apisecurity_operations_api_security_list_discovered_operations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityListDiscoveredOperations',
    'type' => 'read',
    'name' => 'List discovered operations',
    'description' => 'List discovered operations',
    'icon' => 'ph:cloud',
  ),
  'fastly_apisecurity_operations_api_security_list_operation_tags' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityListOperationTags',
    'type' => 'read',
    'name' => 'List operation tags',
    'description' => 'List operation tags',
    'icon' => 'ph:cloud',
  ),
  'fastly_apisecurity_operations_api_security_list_operations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityListOperations',
    'type' => 'read',
    'name' => 'List operations',
    'description' => 'List operations',
    'icon' => 'ph:cloud',
  ),
  'fastly_apisecurity_operations_api_security_update_operation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityUpdateOperation',
    'type' => 'write',
    'name' => 'Update operation',
    'description' => 'Update operation',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_apisecurity_operations_api_security_update_operation_tag' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyApisecurityOperationsApiSecurityUpdateOperationTag',
    'type' => 'write',
    'name' => 'Update operation tag',
    'description' => 'Update operation tag',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_automation_tokens_create_automation_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAutomationTokensCreateAutomationToken',
    'type' => 'write',
    'name' => 'Create Automation Token',
    'description' => 'Create Automation Token',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_automation_tokens_get_automation_token_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAutomationTokensGetAutomationTokenId',
    'type' => 'read',
    'name' => 'Retrieve an Automation Token by ID',
    'description' => 'Retrieve an Automation Token by ID',
    'icon' => 'ph:cloud',
  ),
  'fastly_automation_tokens_get_automation_tokens_id_services' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAutomationTokensGetAutomationTokensIdServices',
    'type' => 'read',
    'name' => 'List Automation Token Services',
    'description' => 'List Automation Token Services',
    'icon' => 'ph:cloud',
  ),
  'fastly_automation_tokens_list_automation_tokens' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAutomationTokensListAutomationTokens',
    'type' => 'read',
    'name' => 'List Customer Automation Tokens',
    'description' => 'List Customer Automation Tokens',
    'icon' => 'ph:cloud',
  ),
  'fastly_automation_tokens_revoke_automation_token_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyAutomationTokensRevokeAutomationTokenId',
    'type' => 'write',
    'name' => 'Revoke an Automation Token by ID',
    'description' => 'Revoke an Automation Token by ID',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_backend_create_backend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBackendCreateBackend',
    'type' => 'write',
    'name' => 'Create a backend',
    'description' => 'Create a backend',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_backend_delete_backend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBackendDeleteBackend',
    'type' => 'write',
    'name' => 'Delete a backend',
    'description' => 'Delete a backend',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_backend_get_backend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBackendGetBackend',
    'type' => 'read',
    'name' => 'Describe a backend',
    'description' => 'Describe a backend',
    'icon' => 'ph:cloud',
  ),
  'fastly_backend_list_backends' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBackendListBackends',
    'type' => 'read',
    'name' => 'List backends',
    'description' => 'List backends',
    'icon' => 'ph:cloud',
  ),
  'fastly_backend_update_backend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBackendUpdateBackend',
    'type' => 'write',
    'name' => 'Update a backend',
    'description' => 'Update a backend',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_billing_address_add_billing_addr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingAddressAddBillingAddr',
    'type' => 'write',
    'name' => 'Add a billing address to a customer',
    'description' => 'Add a billing address to a customer',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_billing_address_delete_billing_addr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingAddressDeleteBillingAddr',
    'type' => 'write',
    'name' => 'Delete a billing address',
    'description' => 'Delete a billing address',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_billing_address_get_billing_addr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingAddressGetBillingAddr',
    'type' => 'read',
    'name' => 'Get a billing address',
    'description' => 'Get a billing address',
    'icon' => 'ph:cloud',
  ),
  'fastly_billing_address_update_billing_addr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingAddressUpdateBillingAddr',
    'type' => 'write',
    'name' => 'Update a billing address',
    'description' => 'Update a billing address',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_billing_invoices_get_invoice_by_invoice_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingInvoicesGetInvoiceByInvoiceId',
    'type' => 'read',
    'name' => 'Get invoice by ID.',
    'description' => 'Get invoice by ID.',
    'icon' => 'ph:cloud',
  ),
  'fastly_billing_invoices_get_month_to_date_invoice' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingInvoicesGetMonthToDateInvoice',
    'type' => 'read',
    'name' => 'Get month-to-date invoice.',
    'description' => 'Get month-to-date invoice.',
    'icon' => 'ph:cloud',
  ),
  'fastly_billing_invoices_list_invoices' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingInvoicesListInvoices',
    'type' => 'read',
    'name' => 'List of invoices.',
    'description' => 'List of invoices.',
    'icon' => 'ph:cloud',
  ),
  'fastly_billing_usage_metrics_get_service_level_usage' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingUsageMetricsGetServiceLevelUsage',
    'type' => 'read',
    'name' => 'Retrieve service-level usage metrics for services with non-zero usage units.',
    'description' => 'Retrieve service-level usage metrics for services with non-zero usage units.',
    'icon' => 'ph:cloud',
  ),
  'fastly_billing_usage_metrics_get_usage_metrics' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyBillingUsageMetricsGetUsageMetrics',
    'type' => 'read',
    'name' => 'Get monthly usage metrics',
    'description' => 'Get monthly usage metrics',
    'icon' => 'ph:cloud',
  ),
  'fastly_cache_settings_create_cache_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCacheSettingsCreateCacheSettings',
    'type' => 'write',
    'name' => 'Create a cache settings object',
    'description' => 'Create a cache settings object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_cache_settings_delete_cache_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCacheSettingsDeleteCacheSettings',
    'type' => 'write',
    'name' => 'Delete a cache settings object',
    'description' => 'Delete a cache settings object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_cache_settings_get_cache_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCacheSettingsGetCacheSettings',
    'type' => 'read',
    'name' => 'Get a cache settings object',
    'description' => 'Get a cache settings object',
    'icon' => 'ph:cloud',
  ),
  'fastly_cache_settings_list_cache_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCacheSettingsListCacheSettings',
    'type' => 'read',
    'name' => 'List cache settings objects',
    'description' => 'List cache settings objects',
    'icon' => 'ph:cloud',
  ),
  'fastly_cache_settings_update_cache_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCacheSettingsUpdateCacheSettings',
    'type' => 'write',
    'name' => 'Update a cache settings object',
    'description' => 'Update a cache settings object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_condition_create_condition' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConditionCreateCondition',
    'type' => 'write',
    'name' => 'Create a condition',
    'description' => 'Create a condition',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_condition_delete_condition' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConditionDeleteCondition',
    'type' => 'write',
    'name' => 'Delete a condition',
    'description' => 'Delete a condition',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_condition_get_condition' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConditionGetCondition',
    'type' => 'read',
    'name' => 'Describe a condition',
    'description' => 'Describe a condition',
    'icon' => 'ph:cloud',
  ),
  'fastly_condition_list_conditions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConditionListConditions',
    'type' => 'read',
    'name' => 'List conditions',
    'description' => 'List conditions',
    'icon' => 'ph:cloud',
  ),
  'fastly_condition_update_condition' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConditionUpdateCondition',
    'type' => 'write',
    'name' => 'Update a condition',
    'description' => 'Update a condition',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_config_store_create_config_store' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreCreateConfigStore',
    'type' => 'write',
    'name' => 'Create a config store',
    'description' => 'Create a config store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_config_store_delete_config_store' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreDeleteConfigStore',
    'type' => 'write',
    'name' => 'Delete a config store',
    'description' => 'Delete a config store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_config_store_get_config_store' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreGetConfigStore',
    'type' => 'read',
    'name' => 'Describe a config store',
    'description' => 'Describe a config store',
    'icon' => 'ph:cloud',
  ),
  'fastly_config_store_get_config_store_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreGetConfigStoreInfo',
    'type' => 'read',
    'name' => 'Get config store metadata',
    'description' => 'Get config store metadata',
    'icon' => 'ph:cloud',
  ),
  'fastly_config_store_item_bulk_update_config_store_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreItemBulkUpdateConfigStoreItem',
    'type' => 'write',
    'name' => 'Update multiple entries in a config store',
    'description' => 'Update multiple entries in a config store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_config_store_item_create_config_store_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreItemCreateConfigStoreItem',
    'type' => 'write',
    'name' => 'Create an entry in a config store',
    'description' => 'Create an entry in a config store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_config_store_item_delete_config_store_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreItemDeleteConfigStoreItem',
    'type' => 'write',
    'name' => 'Delete an item from a config store',
    'description' => 'Delete an item from a config store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_config_store_item_get_config_store_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreItemGetConfigStoreItem',
    'type' => 'read',
    'name' => 'Get an item from a config store',
    'description' => 'Get an item from a config store',
    'icon' => 'ph:cloud',
  ),
  'fastly_config_store_item_list_config_store_items' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreItemListConfigStoreItems',
    'type' => 'read',
    'name' => 'List items in a config store',
    'description' => 'List items in a config store',
    'icon' => 'ph:cloud',
  ),
  'fastly_config_store_item_update_config_store_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreItemUpdateConfigStoreItem',
    'type' => 'write',
    'name' => 'Update an entry in a config store',
    'description' => 'Update an entry in a config store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_config_store_item_upsert_config_store_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreItemUpsertConfigStoreItem',
    'type' => 'write',
    'name' => 'Insert or update an entry in a config store',
    'description' => 'Insert or update an entry in a config store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_config_store_list_config_store_services' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreListConfigStoreServices',
    'type' => 'read',
    'name' => 'List linked services',
    'description' => 'List linked services',
    'icon' => 'ph:cloud',
  ),
  'fastly_config_store_list_config_stores' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreListConfigStores',
    'type' => 'read',
    'name' => 'List config stores',
    'description' => 'List config stores',
    'icon' => 'ph:cloud',
  ),
  'fastly_config_store_update_config_store' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyConfigStoreUpdateConfigStore',
    'type' => 'write',
    'name' => 'Update a config store',
    'description' => 'Update a config store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_contact_create_contacts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyContactCreateContacts',
    'type' => 'write',
    'name' => 'Add a new customer contact',
    'description' => 'Add a new customer contact',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_contact_delete_contact' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyContactDeleteContact',
    'type' => 'write',
    'name' => 'Delete a contact',
    'description' => 'Delete a contact',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_contact_list_contacts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyContactListContacts',
    'type' => 'read',
    'name' => 'List contacts',
    'description' => 'List contacts',
    'icon' => 'ph:cloud',
  ),
  'fastly_content_content_check' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyContentContentCheck',
    'type' => 'read',
    'name' => 'Check status of content in each POP\'s cache',
    'description' => 'Check status of content in each POP\'s cache',
    'icon' => 'ph:cloud',
  ),
  'fastly_customer_addresses_create_customer_address' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCustomerAddressesCreateCustomerAddress',
    'type' => 'write',
    'name' => 'Creates an address associated with a customer account.',
    'description' => 'Creates an address associated with a customer account.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_customer_addresses_list_customer_addresses' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCustomerAddressesListCustomerAddresses',
    'type' => 'read',
    'name' => 'Return the list of addresses associated with a customer account.',
    'description' => 'Return the list of addresses associated with a customer account.',
    'icon' => 'ph:cloud',
  ),
  'fastly_customer_addresses_update_customer_address' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCustomerAddressesUpdateCustomerAddress',
    'type' => 'write',
    'name' => 'Updates an address associated with a customer account.',
    'description' => 'Updates an address associated with a customer account.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_customer_delete_customer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCustomerDeleteCustomer',
    'type' => 'write',
    'name' => 'Delete a customer',
    'description' => 'Delete a customer',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_customer_get_customer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCustomerGetCustomer',
    'type' => 'read',
    'name' => 'Get a customer',
    'description' => 'Get a customer',
    'icon' => 'ph:cloud',
  ),
  'fastly_customer_get_logged_in_customer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCustomerGetLoggedInCustomer',
    'type' => 'read',
    'name' => 'Get the logged in customer',
    'description' => 'Get the logged in customer',
    'icon' => 'ph:cloud',
  ),
  'fastly_customer_list_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCustomerListUsers',
    'type' => 'read',
    'name' => 'List users',
    'description' => 'List users',
    'icon' => 'ph:cloud',
  ),
  'fastly_customer_update_customer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyCustomerUpdateCustomer',
    'type' => 'write',
    'name' => 'Update a customer',
    'description' => 'Update a customer',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_ddos_protection_ddos_protection_event_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDdosProtectionDdosProtectionEventGet',
    'type' => 'read',
    'name' => 'Get event by ID',
    'description' => 'Get event by ID',
    'icon' => 'ph:cloud',
  ),
  'fastly_ddos_protection_ddos_protection_event_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDdosProtectionDdosProtectionEventList',
    'type' => 'read',
    'name' => 'Get events',
    'description' => 'Get events',
    'icon' => 'ph:cloud',
  ),
  'fastly_ddos_protection_ddos_protection_event_rule_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDdosProtectionDdosProtectionEventRuleList',
    'type' => 'read',
    'name' => 'Get all rules for an event',
    'description' => 'Get all rules for an event',
    'icon' => 'ph:cloud',
  ),
  'fastly_ddos_protection_ddos_protection_rule_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDdosProtectionDdosProtectionRuleGet',
    'type' => 'read',
    'name' => 'Get a rule by ID',
    'description' => 'Get a rule by ID',
    'icon' => 'ph:cloud',
  ),
  'fastly_ddos_protection_ddos_protection_rule_patch' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDdosProtectionDdosProtectionRulePatch',
    'type' => 'write',
    'name' => 'Update rule',
    'description' => 'Update rule',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_ddos_protection_ddos_protection_traffic_stats_rule_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDdosProtectionDdosProtectionTrafficStatsRuleGet',
    'type' => 'read',
    'name' => 'Get traffic stats for a rule',
    'description' => 'Get traffic stats for a rule',
    'icon' => 'ph:cloud',
  ),
  'fastly_dictionary_create_dictionary' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryCreateDictionary',
    'type' => 'write',
    'name' => 'Create a dictionary',
    'description' => 'Create a dictionary',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dictionary_delete_dictionary' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryDeleteDictionary',
    'type' => 'write',
    'name' => 'Delete a dictionary',
    'description' => 'Delete a dictionary',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dictionary_get_dictionary' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryGetDictionary',
    'type' => 'read',
    'name' => 'Get a dictionary',
    'description' => 'Get a dictionary',
    'icon' => 'ph:cloud',
  ),
  'fastly_dictionary_info_get_dictionary_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryInfoGetDictionaryInfo',
    'type' => 'read',
    'name' => 'Get dictionary metadata',
    'description' => 'Get dictionary metadata',
    'icon' => 'ph:cloud',
  ),
  'fastly_dictionary_item_bulk_update_dictionary_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryItemBulkUpdateDictionaryItem',
    'type' => 'write',
    'name' => 'Update multiple entries in a dictionary',
    'description' => 'Update multiple entries in a dictionary',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dictionary_item_create_dictionary_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryItemCreateDictionaryItem',
    'type' => 'write',
    'name' => 'Create an entry in a dictionary',
    'description' => 'Create an entry in a dictionary',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dictionary_item_delete_dictionary_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryItemDeleteDictionaryItem',
    'type' => 'write',
    'name' => 'Delete an item from a dictionary',
    'description' => 'Delete an item from a dictionary',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dictionary_item_get_dictionary_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryItemGetDictionaryItem',
    'type' => 'read',
    'name' => 'Get an item from a dictionary',
    'description' => 'Get an item from a dictionary',
    'icon' => 'ph:cloud',
  ),
  'fastly_dictionary_item_list_dictionary_items' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryItemListDictionaryItems',
    'type' => 'read',
    'name' => 'List items in a dictionary',
    'description' => 'List items in a dictionary',
    'icon' => 'ph:cloud',
  ),
  'fastly_dictionary_item_update_dictionary_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryItemUpdateDictionaryItem',
    'type' => 'write',
    'name' => 'Update an entry in a dictionary',
    'description' => 'Update an entry in a dictionary',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dictionary_item_upsert_dictionary_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryItemUpsertDictionaryItem',
    'type' => 'write',
    'name' => 'Insert or update an entry in a dictionary',
    'description' => 'Insert or update an entry in a dictionary',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dictionary_list_dictionaries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryListDictionaries',
    'type' => 'read',
    'name' => 'List dictionaries',
    'description' => 'List dictionaries',
    'icon' => 'ph:cloud',
  ),
  'fastly_dictionary_update_dictionary' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDictionaryUpdateDictionary',
    'type' => 'write',
    'name' => 'Update a dictionary',
    'description' => 'Update a dictionary',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_diff_diff_service_versions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDiffDiffServiceVersions',
    'type' => 'read',
    'name' => 'Diff two service versions',
    'description' => 'Diff two service versions',
    'icon' => 'ph:cloud',
  ),
  'fastly_director_backend_create_director_backend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDirectorBackendCreateDirectorBackend',
    'type' => 'write',
    'name' => 'Create a director-backend relationship',
    'description' => 'Create a director-backend relationship',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_director_backend_delete_director_backend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDirectorBackendDeleteDirectorBackend',
    'type' => 'write',
    'name' => 'Delete a director-backend relationship',
    'description' => 'Delete a director-backend relationship',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_director_backend_get_director_backend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDirectorBackendGetDirectorBackend',
    'type' => 'read',
    'name' => 'Get a director-backend relationship',
    'description' => 'Get a director-backend relationship',
    'icon' => 'ph:cloud',
  ),
  'fastly_director_create_director' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDirectorCreateDirector',
    'type' => 'write',
    'name' => 'Create a director',
    'description' => 'Create a director',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_director_delete_director' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDirectorDeleteDirector',
    'type' => 'write',
    'name' => 'Delete a director',
    'description' => 'Delete a director',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_director_get_director' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDirectorGetDirector',
    'type' => 'read',
    'name' => 'Get a director',
    'description' => 'Get a director',
    'icon' => 'ph:cloud',
  ),
  'fastly_director_list_directors' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDirectorListDirectors',
    'type' => 'read',
    'name' => 'List directors',
    'description' => 'List directors',
    'icon' => 'ph:cloud',
  ),
  'fastly_director_update_director' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDirectorUpdateDirector',
    'type' => 'write',
    'name' => 'Update a director',
    'description' => 'Update a director',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dm_domains_create_dm_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDmDomainsCreateDmDomain',
    'type' => 'write',
    'name' => 'Create a domain',
    'description' => 'Create a domain',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dm_domains_delete_dm_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDmDomainsDeleteDmDomain',
    'type' => 'write',
    'name' => 'Delete a domain',
    'description' => 'Delete a domain',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_dm_domains_get_dm_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDmDomainsGetDmDomain',
    'type' => 'read',
    'name' => 'Get a domain',
    'description' => 'Get a domain',
    'icon' => 'ph:cloud',
  ),
  'fastly_dm_domains_list_dm_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDmDomainsListDmDomains',
    'type' => 'read',
    'name' => 'List domains',
    'description' => 'List domains',
    'icon' => 'ph:cloud',
  ),
  'fastly_dm_domains_update_dm_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDmDomainsUpdateDmDomain',
    'type' => 'write',
    'name' => 'Update a domain',
    'description' => 'Update a domain',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_domain_check_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainCheckDomain',
    'type' => 'read',
    'name' => 'Validate DNS configuration for a single domain on a service',
    'description' => 'Validate DNS configuration for a single domain on a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_check_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainCheckDomains',
    'type' => 'read',
    'name' => 'Validate DNS configuration for all domains on a service',
    'description' => 'Validate DNS configuration for all domains on a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_create_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainCreateDomain',
    'type' => 'write',
    'name' => 'Add a domain name to a service',
    'description' => 'Add a domain name to a service',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_domain_delete_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainDeleteDomain',
    'type' => 'write',
    'name' => 'Remove a domain from a service',
    'description' => 'Remove a domain from a service',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_domain_get_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainGetDomain',
    'type' => 'read',
    'name' => 'Describe a domain',
    'description' => 'Describe a domain',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_inspector_historical_get_domain_inspector_historical' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainInspectorHistoricalGetDomainInspectorHistorical',
    'type' => 'read',
    'name' => 'Get historical domain data for a service',
    'description' => 'Get historical domain data for a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_inspector_realtime_get_domain_inspector_last120_seconds' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainInspectorRealtimeGetDomainInspectorLast120Seconds',
    'type' => 'read',
    'name' => 'Get real-time domain data for the last 120 seconds',
    'description' => 'Get real-time domain data for the last 120 seconds',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_inspector_realtime_get_domain_inspector_last_max_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainInspectorRealtimeGetDomainInspectorLastMaxEntries',
    'type' => 'read',
    'name' => 'Get a limited number of real-time domain data entries',
    'description' => 'Get a limited number of real-time domain data entries',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_inspector_realtime_get_domain_inspector_last_second' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainInspectorRealtimeGetDomainInspectorLastSecond',
    'type' => 'read',
    'name' => 'Get real-time domain data from a specified time',
    'description' => 'Get real-time domain data from a specified time',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_list_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainListDomains',
    'type' => 'read',
    'name' => 'List domains',
    'description' => 'List domains',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_ownerships_list_domain_ownerships' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainOwnershipsListDomainOwnerships',
    'type' => 'read',
    'name' => 'List domain-ownerships',
    'description' => 'List domain-ownerships',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_research_domain_status' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainResearchDomainStatus',
    'type' => 'read',
    'name' => 'Domain status',
    'description' => 'Domain status',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_research_suggest_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainResearchSuggestDomains',
    'type' => 'read',
    'name' => 'Suggest domains',
    'description' => 'Suggest domains',
    'icon' => 'ph:cloud',
  ),
  'fastly_domain_update_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyDomainUpdateDomain',
    'type' => 'write',
    'name' => 'Update a domain',
    'description' => 'Update a domain',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_events_get_event' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyEventsGetEvent',
    'type' => 'read',
    'name' => 'Get an event',
    'description' => 'Get an event',
    'icon' => 'ph:cloud',
  ),
  'fastly_events_list_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyEventsListEvents',
    'type' => 'read',
    'name' => 'List events',
    'description' => 'List events',
    'icon' => 'ph:cloud',
  ),
  'fastly_gzip_create_gzip_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyGzipCreateGzipConfig',
    'type' => 'write',
    'name' => 'Create a gzip configuration',
    'description' => 'Create a gzip configuration',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_gzip_delete_gzip_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyGzipDeleteGzipConfig',
    'type' => 'write',
    'name' => 'Delete a gzip configuration',
    'description' => 'Delete a gzip configuration',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_gzip_get_gzip_configs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyGzipGetGzipConfigs',
    'type' => 'read',
    'name' => 'Get a gzip configuration',
    'description' => 'Get a gzip configuration',
    'icon' => 'ph:cloud',
  ),
  'fastly_gzip_list_gzip_configs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyGzipListGzipConfigs',
    'type' => 'read',
    'name' => 'List gzip configurations',
    'description' => 'List gzip configurations',
    'icon' => 'ph:cloud',
  ),
  'fastly_gzip_update_gzip_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyGzipUpdateGzipConfig',
    'type' => 'write',
    'name' => 'Update a gzip configuration',
    'description' => 'Update a gzip configuration',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_header_create_header_object' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHeaderCreateHeaderObject',
    'type' => 'write',
    'name' => 'Create a Header object',
    'description' => 'Create a Header object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_header_delete_header_object' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHeaderDeleteHeaderObject',
    'type' => 'write',
    'name' => 'Delete a Header object',
    'description' => 'Delete a Header object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_header_get_header_object' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHeaderGetHeaderObject',
    'type' => 'read',
    'name' => 'Get a Header object',
    'description' => 'Get a Header object',
    'icon' => 'ph:cloud',
  ),
  'fastly_header_list_header_objects' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHeaderListHeaderObjects',
    'type' => 'read',
    'name' => 'List Header objects',
    'description' => 'List Header objects',
    'icon' => 'ph:cloud',
  ),
  'fastly_header_update_header_object' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHeaderUpdateHeaderObject',
    'type' => 'write',
    'name' => 'Update a Header object',
    'description' => 'Update a Header object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_healthcheck_create_healthcheck' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHealthcheckCreateHealthcheck',
    'type' => 'write',
    'name' => 'Create a health check',
    'description' => 'Create a health check',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_healthcheck_delete_healthcheck' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHealthcheckDeleteHealthcheck',
    'type' => 'write',
    'name' => 'Delete a health check',
    'description' => 'Delete a health check',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_healthcheck_get_healthcheck' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHealthcheckGetHealthcheck',
    'type' => 'read',
    'name' => 'Get a health check',
    'description' => 'Get a health check',
    'icon' => 'ph:cloud',
  ),
  'fastly_healthcheck_list_healthchecks' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHealthcheckListHealthchecks',
    'type' => 'read',
    'name' => 'List health checks',
    'description' => 'List health checks',
    'icon' => 'ph:cloud',
  ),
  'fastly_healthcheck_update_healthcheck' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHealthcheckUpdateHealthcheck',
    'type' => 'write',
    'name' => 'Update a health check',
    'description' => 'Update a health check',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_historical_get_hist_stats' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetHistStats',
    'type' => 'read',
    'name' => 'Get historical stats',
    'description' => 'Get historical stats',
    'icon' => 'ph:cloud',
  ),
  'fastly_historical_get_hist_stats_aggregated' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetHistStatsAggregated',
    'type' => 'read',
    'name' => 'Get aggregated historical stats',
    'description' => 'Get aggregated historical stats',
    'icon' => 'ph:cloud',
  ),
  'fastly_historical_get_hist_stats_field' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetHistStatsField',
    'type' => 'read',
    'name' => 'Get historical stats for a single field',
    'description' => 'Get historical stats for a single field',
    'icon' => 'ph:cloud',
  ),
  'fastly_historical_get_hist_stats_service' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetHistStatsService',
    'type' => 'read',
    'name' => 'Get historical stats for a single service',
    'description' => 'Get historical stats for a single service',
    'icon' => 'ph:cloud',
  ),
  'fastly_historical_get_hist_stats_service_field' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetHistStatsServiceField',
    'type' => 'read',
    'name' => 'Get historical stats for a single service/field combination',
    'description' => 'Get historical stats for a single service/field combination',
    'icon' => 'ph:cloud',
  ),
  'fastly_historical_get_regions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetRegions',
    'type' => 'read',
    'name' => 'Get region codes',
    'description' => 'Get region codes',
    'icon' => 'ph:cloud',
  ),
  'fastly_historical_get_usage' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetUsage',
    'type' => 'read',
    'name' => 'Get usage statistics',
    'description' => 'Get usage statistics',
    'icon' => 'ph:cloud',
  ),
  'fastly_historical_get_usage_month' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetUsageMonth',
    'type' => 'read',
    'name' => 'Get month-to-date usage statistics',
    'description' => 'Get month-to-date usage statistics',
    'icon' => 'ph:cloud',
  ),
  'fastly_historical_get_usage_service' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHistoricalGetUsageService',
    'type' => 'read',
    'name' => 'Get usage statistics per service',
    'description' => 'Get usage statistics per service',
    'icon' => 'ph:cloud',
  ),
  'fastly_http3_create_http3' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHttp3CreateHttp3',
    'type' => 'write',
    'name' => 'Enable support for HTTP/3',
    'description' => 'Enable support for HTTP/3',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_http3_delete_http3' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHttp3DeleteHttp3',
    'type' => 'write',
    'name' => 'Disable support for HTTP/3',
    'description' => 'Disable support for HTTP/3',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_http3_get_http3' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyHttp3GetHttp3',
    'type' => 'read',
    'name' => 'Get HTTP/3 status',
    'description' => 'Get HTTP/3 status',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_permissions_list_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamPermissionsListPermissions',
    'type' => 'read',
    'name' => 'List permissions',
    'description' => 'List permissions',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_roles_iam_v1_roles_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamRolesIamV1RolesGet',
    'type' => 'read',
    'name' => 'Get IAM role by ID',
    'description' => 'Get IAM role by ID',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_roles_iam_v1_roles_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamRolesIamV1RolesList',
    'type' => 'read',
    'name' => 'List IAM roles',
    'description' => 'List IAM roles',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_service_groups_add_service_group_services' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamServiceGroupsAddServiceGroupServices',
    'type' => 'write',
    'name' => 'Add services in a service group',
    'description' => 'Add services in a service group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_service_groups_create_aservice_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamServiceGroupsCreateAserviceGroup',
    'type' => 'write',
    'name' => 'Create a service group',
    'description' => 'Create a service group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_service_groups_delete_aservice_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamServiceGroupsDeleteAserviceGroup',
    'type' => 'write',
    'name' => 'Delete a service group',
    'description' => 'Delete a service group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_service_groups_get_aservice_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamServiceGroupsGetAserviceGroup',
    'type' => 'read',
    'name' => 'Get a service group',
    'description' => 'Get a service group',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_service_groups_list_service_group_services' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamServiceGroupsListServiceGroupServices',
    'type' => 'read',
    'name' => 'List services to a service group',
    'description' => 'List services to a service group',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_service_groups_list_service_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamServiceGroupsListServiceGroups',
    'type' => 'read',
    'name' => 'List service groups',
    'description' => 'List service groups',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_service_groups_remove_service_group_services' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamServiceGroupsRemoveServiceGroupServices',
    'type' => 'write',
    'name' => 'Remove services from a service group',
    'description' => 'Remove services from a service group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_service_groups_update_aservice_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamServiceGroupsUpdateAserviceGroup',
    'type' => 'write',
    'name' => 'Update a service group',
    'description' => 'Update a service group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_add_user_group_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsAddUserGroupMembers',
    'type' => 'write',
    'name' => 'Add members to a user group',
    'description' => 'Add members to a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_add_user_group_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsAddUserGroupRoles',
    'type' => 'write',
    'name' => 'Add roles to a user group',
    'description' => 'Add roles to a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_add_user_group_service_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsAddUserGroupServiceGroups',
    'type' => 'write',
    'name' => 'Add service groups to a user group',
    'description' => 'Add service groups to a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_create_auser_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsCreateAuserGroup',
    'type' => 'write',
    'name' => 'Create a user group',
    'description' => 'Create a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_delete_auser_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsDeleteAuserGroup',
    'type' => 'write',
    'name' => 'Delete a user group',
    'description' => 'Delete a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_get_auser_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsGetAuserGroup',
    'type' => 'read',
    'name' => 'Get a user group',
    'description' => 'Get a user group',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_user_groups_list_user_group_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsListUserGroupMembers',
    'type' => 'read',
    'name' => 'List members of a user group',
    'description' => 'List members of a user group',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_user_groups_list_user_group_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsListUserGroupRoles',
    'type' => 'read',
    'name' => 'List roles in a user group',
    'description' => 'List roles in a user group',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_user_groups_list_user_group_service_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsListUserGroupServiceGroups',
    'type' => 'read',
    'name' => 'List service groups in a user group',
    'description' => 'List service groups in a user group',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_user_groups_list_user_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsListUserGroups',
    'type' => 'read',
    'name' => 'List user groups',
    'description' => 'List user groups',
    'icon' => 'ph:cloud',
  ),
  'fastly_iam_user_groups_remove_user_group_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsRemoveUserGroupMembers',
    'type' => 'write',
    'name' => 'Remove members of a user group',
    'description' => 'Remove members of a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_remove_user_group_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsRemoveUserGroupRoles',
    'type' => 'write',
    'name' => 'Remove roles from a user group',
    'description' => 'Remove roles from a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_remove_user_group_service_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsRemoveUserGroupServiceGroups',
    'type' => 'write',
    'name' => 'Remove service groups from a user group',
    'description' => 'Remove service groups from a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_iam_user_groups_update_auser_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyIamUserGroupsUpdateAuserGroup',
    'type' => 'write',
    'name' => 'Update a user group',
    'description' => 'Update a user group',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_image_optimizer_default_settings_get_default_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyImageOptimizerDefaultSettingsGetDefaultSettings',
    'type' => 'read',
    'name' => 'Get current Image Optimizer Default Settings',
    'description' => 'Get current Image Optimizer Default Settings',
    'icon' => 'ph:cloud',
  ),
  'fastly_image_optimizer_default_settings_update_default_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyImageOptimizerDefaultSettingsUpdateDefaultSettings',
    'type' => 'write',
    'name' => 'Update Image Optimizer Default Settings',
    'description' => 'Update Image Optimizer Default Settings',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_insights_get_log_insights' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyInsightsGetLogInsights',
    'type' => 'read',
    'name' => 'Retrieve log insights',
    'description' => 'Retrieve log insights',
    'icon' => 'ph:cloud',
  ),
  'fastly_invitations_create_invitation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyInvitationsCreateInvitation',
    'type' => 'write',
    'name' => 'Create an invitation',
    'description' => 'Create an invitation',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_invitations_delete_invitation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyInvitationsDeleteInvitation',
    'type' => 'write',
    'name' => 'Delete an invitation',
    'description' => 'Delete an invitation',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_invitations_list_invitations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyInvitationsListInvitations',
    'type' => 'read',
    'name' => 'List invitations',
    'description' => 'List invitations',
    'icon' => 'ph:cloud',
  ),
  'fastly_kv_store_item_kv_store_delete_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreItemKvStoreDeleteItem',
    'type' => 'write',
    'name' => 'Delete an item.',
    'description' => 'Delete an item.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_kv_store_item_kv_store_get_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreItemKvStoreGetItem',
    'type' => 'read',
    'name' => 'Get an item.',
    'description' => 'Get an item.',
    'icon' => 'ph:cloud',
  ),
  'fastly_kv_store_item_kv_store_list_item_keys' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreItemKvStoreListItemKeys',
    'type' => 'read',
    'name' => 'List item keys.',
    'description' => 'List item keys.',
    'icon' => 'ph:cloud',
  ),
  'fastly_kv_store_item_kv_store_upsert_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreItemKvStoreUpsertItem',
    'type' => 'write',
    'name' => 'Insert or update an item.',
    'description' => 'Insert or update an item.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_kv_store_kv_store_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreKvStoreCreate',
    'type' => 'write',
    'name' => 'Create a KV store.',
    'description' => 'Create a KV store.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_kv_store_kv_store_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreKvStoreDelete',
    'type' => 'write',
    'name' => 'Delete a KV store.',
    'description' => 'Delete a KV store.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_kv_store_kv_store_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreKvStoreGet',
    'type' => 'read',
    'name' => 'Describe a KV store.',
    'description' => 'Describe a KV store.',
    'icon' => 'ph:cloud',
  ),
  'fastly_kv_store_kv_store_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreKvStoreList',
    'type' => 'read',
    'name' => 'List all KV stores.',
    'description' => 'List all KV stores.',
    'icon' => 'ph:cloud',
  ),
  'fastly_kv_store_kv_store_put' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyKvStoreKvStorePut',
    'type' => 'write',
    'name' => 'Update a KV store.',
    'description' => 'Update a KV store.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_log_explorer_get_log_records' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLogExplorerGetLogRecords',
    'type' => 'read',
    'name' => 'Retrieve log records',
    'description' => 'Retrieve log records',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_azureblob_create_log_azure' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingAzureblobCreateLogAzure',
    'type' => 'write',
    'name' => 'Create an Azure Blob Storage log endpoint',
    'description' => 'Create an Azure Blob Storage log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_azureblob_delete_log_azure' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingAzureblobDeleteLogAzure',
    'type' => 'write',
    'name' => 'Delete the Azure Blob Storage log endpoint',
    'description' => 'Delete the Azure Blob Storage log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_azureblob_get_log_azure' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingAzureblobGetLogAzure',
    'type' => 'read',
    'name' => 'Get an Azure Blob Storage log endpoint',
    'description' => 'Get an Azure Blob Storage log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_azureblob_list_log_azure' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingAzureblobListLogAzure',
    'type' => 'read',
    'name' => 'List Azure Blob Storage log endpoints',
    'description' => 'List Azure Blob Storage log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_azureblob_update_log_azure' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingAzureblobUpdateLogAzure',
    'type' => 'write',
    'name' => 'Update an Azure Blob Storage log endpoint',
    'description' => 'Update an Azure Blob Storage log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_bigquery_create_log_bigquery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingBigqueryCreateLogBigquery',
    'type' => 'write',
    'name' => 'Create a BigQuery log endpoint',
    'description' => 'Create a BigQuery log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_bigquery_delete_log_bigquery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingBigqueryDeleteLogBigquery',
    'type' => 'write',
    'name' => 'Delete a BigQuery log endpoint',
    'description' => 'Delete a BigQuery log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_bigquery_get_log_bigquery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingBigqueryGetLogBigquery',
    'type' => 'read',
    'name' => 'Get a BigQuery log endpoint',
    'description' => 'Get a BigQuery log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_bigquery_list_log_bigquery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingBigqueryListLogBigquery',
    'type' => 'read',
    'name' => 'List BigQuery log endpoints',
    'description' => 'List BigQuery log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_bigquery_update_log_bigquery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingBigqueryUpdateLogBigquery',
    'type' => 'write',
    'name' => 'Update a BigQuery log endpoint',
    'description' => 'Update a BigQuery log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_cloudfiles_create_log_cloudfiles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingCloudfilesCreateLogCloudfiles',
    'type' => 'write',
    'name' => 'Create a Cloud Files log endpoint',
    'description' => 'Create a Cloud Files log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_cloudfiles_delete_log_cloudfiles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingCloudfilesDeleteLogCloudfiles',
    'type' => 'write',
    'name' => 'Delete the Cloud Files log endpoint',
    'description' => 'Delete the Cloud Files log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_cloudfiles_get_log_cloudfiles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingCloudfilesGetLogCloudfiles',
    'type' => 'read',
    'name' => 'Get a Cloud Files log endpoint',
    'description' => 'Get a Cloud Files log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_cloudfiles_list_log_cloudfiles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingCloudfilesListLogCloudfiles',
    'type' => 'read',
    'name' => 'List Cloud Files log endpoints',
    'description' => 'List Cloud Files log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_cloudfiles_update_log_cloudfiles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingCloudfilesUpdateLogCloudfiles',
    'type' => 'write',
    'name' => 'Update the Cloud Files log endpoint',
    'description' => 'Update the Cloud Files log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_datadog_create_log_datadog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDatadogCreateLogDatadog',
    'type' => 'write',
    'name' => 'Create a Datadog log endpoint',
    'description' => 'Create a Datadog log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_datadog_delete_log_datadog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDatadogDeleteLogDatadog',
    'type' => 'write',
    'name' => 'Delete a Datadog log endpoint',
    'description' => 'Delete a Datadog log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_datadog_get_log_datadog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDatadogGetLogDatadog',
    'type' => 'read',
    'name' => 'Get a Datadog log endpoint',
    'description' => 'Get a Datadog log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_datadog_list_log_datadog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDatadogListLogDatadog',
    'type' => 'read',
    'name' => 'List Datadog log endpoints',
    'description' => 'List Datadog log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_datadog_update_log_datadog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDatadogUpdateLogDatadog',
    'type' => 'write',
    'name' => 'Update a Datadog log endpoint',
    'description' => 'Update a Datadog log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_digitalocean_create_log_digocean' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDigitaloceanCreateLogDigocean',
    'type' => 'write',
    'name' => 'Create a DigitalOcean Spaces log endpoint',
    'description' => 'Create a DigitalOcean Spaces log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_digitalocean_delete_log_digocean' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDigitaloceanDeleteLogDigocean',
    'type' => 'write',
    'name' => 'Delete a DigitalOcean Spaces log endpoint',
    'description' => 'Delete a DigitalOcean Spaces log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_digitalocean_get_log_digocean' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDigitaloceanGetLogDigocean',
    'type' => 'read',
    'name' => 'Get a DigitalOcean Spaces log endpoint',
    'description' => 'Get a DigitalOcean Spaces log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_digitalocean_list_log_digocean' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDigitaloceanListLogDigocean',
    'type' => 'read',
    'name' => 'List DigitalOcean Spaces log endpoints',
    'description' => 'List DigitalOcean Spaces log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_digitalocean_update_log_digocean' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingDigitaloceanUpdateLogDigocean',
    'type' => 'write',
    'name' => 'Update a DigitalOcean Spaces log endpoint',
    'description' => 'Update a DigitalOcean Spaces log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_elasticsearch_create_log_elasticsearch' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingElasticsearchCreateLogElasticsearch',
    'type' => 'write',
    'name' => 'Create an Elasticsearch log endpoint',
    'description' => 'Create an Elasticsearch log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_elasticsearch_delete_log_elasticsearch' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingElasticsearchDeleteLogElasticsearch',
    'type' => 'write',
    'name' => 'Delete an Elasticsearch log endpoint',
    'description' => 'Delete an Elasticsearch log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_elasticsearch_get_log_elasticsearch' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingElasticsearchGetLogElasticsearch',
    'type' => 'read',
    'name' => 'Get an Elasticsearch log endpoint',
    'description' => 'Get an Elasticsearch log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_elasticsearch_list_log_elasticsearch' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingElasticsearchListLogElasticsearch',
    'type' => 'read',
    'name' => 'List Elasticsearch log endpoints',
    'description' => 'List Elasticsearch log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_elasticsearch_update_log_elasticsearch' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingElasticsearchUpdateLogElasticsearch',
    'type' => 'write',
    'name' => 'Update an Elasticsearch log endpoint',
    'description' => 'Update an Elasticsearch log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_ftp_create_log_ftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingFtpCreateLogFtp',
    'type' => 'write',
    'name' => 'Create an FTP log endpoint',
    'description' => 'Create an FTP log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_ftp_delete_log_ftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingFtpDeleteLogFtp',
    'type' => 'write',
    'name' => 'Delete an FTP log endpoint',
    'description' => 'Delete an FTP log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_ftp_get_log_ftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingFtpGetLogFtp',
    'type' => 'read',
    'name' => 'Get an FTP log endpoint',
    'description' => 'Get an FTP log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_ftp_list_log_ftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingFtpListLogFtp',
    'type' => 'read',
    'name' => 'List FTP log endpoints',
    'description' => 'List FTP log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_ftp_update_log_ftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingFtpUpdateLogFtp',
    'type' => 'write',
    'name' => 'Update an FTP log endpoint',
    'description' => 'Update an FTP log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_gcs_create_log_gcs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGcsCreateLogGcs',
    'type' => 'write',
    'name' => 'Create a GCS log endpoint',
    'description' => 'Create a GCS log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_gcs_delete_log_gcs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGcsDeleteLogGcs',
    'type' => 'write',
    'name' => 'Delete a GCS log endpoint',
    'description' => 'Delete a GCS log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_gcs_get_log_gcs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGcsGetLogGcs',
    'type' => 'read',
    'name' => 'Get a GCS log endpoint',
    'description' => 'Get a GCS log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_gcs_list_log_gcs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGcsListLogGcs',
    'type' => 'read',
    'name' => 'List GCS log endpoints',
    'description' => 'List GCS log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_gcs_update_log_gcs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGcsUpdateLogGcs',
    'type' => 'write',
    'name' => 'Update a GCS log endpoint',
    'description' => 'Update a GCS log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_grafanacloudlogs_create_log_grafanacloudlogs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGrafanacloudlogsCreateLogGrafanacloudlogs',
    'type' => 'write',
    'name' => 'Create a Grafana Cloud Logs log endpoint',
    'description' => 'Create a Grafana Cloud Logs log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_grafanacloudlogs_delete_log_grafanacloudlogs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGrafanacloudlogsDeleteLogGrafanacloudlogs',
    'type' => 'write',
    'name' => 'Delete the Grafana Cloud Logs log endpoint',
    'description' => 'Delete the Grafana Cloud Logs log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_grafanacloudlogs_get_log_grafanacloudlogs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGrafanacloudlogsGetLogGrafanacloudlogs',
    'type' => 'read',
    'name' => 'Get a Grafana Cloud Logs log endpoint',
    'description' => 'Get a Grafana Cloud Logs log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_grafanacloudlogs_list_log_grafanacloudlogs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGrafanacloudlogsListLogGrafanacloudlogs',
    'type' => 'read',
    'name' => 'List Grafana Cloud Logs log endpoints',
    'description' => 'List Grafana Cloud Logs log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_grafanacloudlogs_update_log_grafanacloudlogs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingGrafanacloudlogsUpdateLogGrafanacloudlogs',
    'type' => 'write',
    'name' => 'Update a Grafana Cloud Logs log endpoint',
    'description' => 'Update a Grafana Cloud Logs log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_heroku_create_log_heroku' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHerokuCreateLogHeroku',
    'type' => 'write',
    'name' => 'Create a Heroku log endpoint',
    'description' => 'Create a Heroku log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_heroku_delete_log_heroku' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHerokuDeleteLogHeroku',
    'type' => 'write',
    'name' => 'Delete the Heroku log endpoint',
    'description' => 'Delete the Heroku log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_heroku_get_log_heroku' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHerokuGetLogHeroku',
    'type' => 'read',
    'name' => 'Get a Heroku log endpoint',
    'description' => 'Get a Heroku log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_heroku_list_log_heroku' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHerokuListLogHeroku',
    'type' => 'read',
    'name' => 'List Heroku log endpoints',
    'description' => 'List Heroku log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_heroku_update_log_heroku' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHerokuUpdateLogHeroku',
    'type' => 'write',
    'name' => 'Update the Heroku log endpoint',
    'description' => 'Update the Heroku log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_honeycomb_create_log_honeycomb' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHoneycombCreateLogHoneycomb',
    'type' => 'write',
    'name' => 'Create a Honeycomb log endpoint',
    'description' => 'Create a Honeycomb log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_honeycomb_delete_log_honeycomb' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHoneycombDeleteLogHoneycomb',
    'type' => 'write',
    'name' => 'Delete the Honeycomb log endpoint',
    'description' => 'Delete the Honeycomb log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_honeycomb_get_log_honeycomb' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHoneycombGetLogHoneycomb',
    'type' => 'read',
    'name' => 'Get a Honeycomb log endpoint',
    'description' => 'Get a Honeycomb log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_honeycomb_list_log_honeycomb' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHoneycombListLogHoneycomb',
    'type' => 'read',
    'name' => 'List Honeycomb log endpoints',
    'description' => 'List Honeycomb log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_honeycomb_update_log_honeycomb' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHoneycombUpdateLogHoneycomb',
    'type' => 'write',
    'name' => 'Update a Honeycomb log endpoint',
    'description' => 'Update a Honeycomb log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_https_create_log_https' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHttpsCreateLogHttps',
    'type' => 'write',
    'name' => 'Create an HTTPS log endpoint',
    'description' => 'Create an HTTPS log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_https_delete_log_https' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHttpsDeleteLogHttps',
    'type' => 'write',
    'name' => 'Delete an HTTPS log endpoint',
    'description' => 'Delete an HTTPS log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_https_get_log_https' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHttpsGetLogHttps',
    'type' => 'read',
    'name' => 'Get an HTTPS log endpoint',
    'description' => 'Get an HTTPS log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_https_list_log_https' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHttpsListLogHttps',
    'type' => 'read',
    'name' => 'List HTTPS log endpoints',
    'description' => 'List HTTPS log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_https_update_log_https' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingHttpsUpdateLogHttps',
    'type' => 'write',
    'name' => 'Update an HTTPS log endpoint',
    'description' => 'Update an HTTPS log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_kafka_create_log_kafka' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKafkaCreateLogKafka',
    'type' => 'write',
    'name' => 'Create a Kafka log endpoint',
    'description' => 'Create a Kafka log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_kafka_delete_log_kafka' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKafkaDeleteLogKafka',
    'type' => 'write',
    'name' => 'Delete the Kafka log endpoint',
    'description' => 'Delete the Kafka log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_kafka_get_log_kafka' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKafkaGetLogKafka',
    'type' => 'read',
    'name' => 'Get a Kafka log endpoint',
    'description' => 'Get a Kafka log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_kafka_list_log_kafka' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKafkaListLogKafka',
    'type' => 'read',
    'name' => 'List Kafka log endpoints',
    'description' => 'List Kafka log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_kafka_update_log_kafka' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKafkaUpdateLogKafka',
    'type' => 'write',
    'name' => 'Update the Kafka log endpoint',
    'description' => 'Update the Kafka log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_kinesis_create_log_kinesis' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKinesisCreateLogKinesis',
    'type' => 'write',
    'name' => 'Create an Amazon Kinesis log endpoint',
    'description' => 'Create an Amazon Kinesis log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_kinesis_delete_log_kinesis' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKinesisDeleteLogKinesis',
    'type' => 'write',
    'name' => 'Delete the Amazon Kinesis log endpoint',
    'description' => 'Delete the Amazon Kinesis log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_kinesis_get_log_kinesis' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKinesisGetLogKinesis',
    'type' => 'read',
    'name' => 'Get an Amazon Kinesis log endpoint',
    'description' => 'Get an Amazon Kinesis log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_kinesis_list_log_kinesis' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKinesisListLogKinesis',
    'type' => 'read',
    'name' => 'List Amazon Kinesis log endpoints',
    'description' => 'List Amazon Kinesis log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_kinesis_update_log_kinesis' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingKinesisUpdateLogKinesis',
    'type' => 'write',
    'name' => 'Update the Amazon Kinesis log endpoint',
    'description' => 'Update the Amazon Kinesis log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_logentries_create_log_logentries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogentriesCreateLogLogentries',
    'type' => 'write',
    'name' => 'Create a Logentries log endpoint',
    'description' => 'Create a Logentries log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_logentries_delete_log_logentries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogentriesDeleteLogLogentries',
    'type' => 'write',
    'name' => 'Delete a Logentries log endpoint',
    'description' => 'Delete a Logentries log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_logentries_get_log_logentries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogentriesGetLogLogentries',
    'type' => 'read',
    'name' => 'Get a Logentries log endpoint',
    'description' => 'Get a Logentries log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_logentries_list_log_logentries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogentriesListLogLogentries',
    'type' => 'read',
    'name' => 'List Logentries log endpoints',
    'description' => 'List Logentries log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_logentries_update_log_logentries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogentriesUpdateLogLogentries',
    'type' => 'write',
    'name' => 'Update a Logentries log endpoint',
    'description' => 'Update a Logentries log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_loggly_create_log_loggly' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogglyCreateLogLoggly',
    'type' => 'write',
    'name' => 'Create a Loggly log endpoint',
    'description' => 'Create a Loggly log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_loggly_delete_log_loggly' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogglyDeleteLogLoggly',
    'type' => 'write',
    'name' => 'Delete a Loggly log endpoint',
    'description' => 'Delete a Loggly log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_loggly_get_log_loggly' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogglyGetLogLoggly',
    'type' => 'read',
    'name' => 'Get a Loggly log endpoint',
    'description' => 'Get a Loggly log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_loggly_list_log_loggly' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogglyListLogLoggly',
    'type' => 'read',
    'name' => 'List Loggly log endpoints',
    'description' => 'List Loggly log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_loggly_update_log_loggly' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogglyUpdateLogLoggly',
    'type' => 'write',
    'name' => 'Update a Loggly log endpoint',
    'description' => 'Update a Loggly log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_logshuttle_create_log_logshuttle' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogshuttleCreateLogLogshuttle',
    'type' => 'write',
    'name' => 'Create a Log Shuttle log endpoint',
    'description' => 'Create a Log Shuttle log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_logshuttle_delete_log_logshuttle' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogshuttleDeleteLogLogshuttle',
    'type' => 'write',
    'name' => 'Delete a Log Shuttle log endpoint',
    'description' => 'Delete a Log Shuttle log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_logshuttle_get_log_logshuttle' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogshuttleGetLogLogshuttle',
    'type' => 'read',
    'name' => 'Get a Log Shuttle log endpoint',
    'description' => 'Get a Log Shuttle log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_logshuttle_list_log_logshuttle' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogshuttleListLogLogshuttle',
    'type' => 'read',
    'name' => 'List Log Shuttle log endpoints',
    'description' => 'List Log Shuttle log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_logshuttle_update_log_logshuttle' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingLogshuttleUpdateLogLogshuttle',
    'type' => 'write',
    'name' => 'Update a Log Shuttle log endpoint',
    'description' => 'Update a Log Shuttle log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_newrelic_create_log_newrelic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicCreateLogNewrelic',
    'type' => 'write',
    'name' => 'Create a New Relic log endpoint',
    'description' => 'Create a New Relic log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_newrelic_delete_log_newrelic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicDeleteLogNewrelic',
    'type' => 'write',
    'name' => 'Delete a New Relic log endpoint',
    'description' => 'Delete a New Relic log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_newrelic_get_log_newrelic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicGetLogNewrelic',
    'type' => 'read',
    'name' => 'Get a New Relic log endpoint',
    'description' => 'Get a New Relic log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_newrelic_list_log_newrelic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicListLogNewrelic',
    'type' => 'read',
    'name' => 'List New Relic log endpoints',
    'description' => 'List New Relic log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_newrelic_update_log_newrelic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicUpdateLogNewrelic',
    'type' => 'write',
    'name' => 'Update a New Relic log endpoint',
    'description' => 'Update a New Relic log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_newrelicotlp_create_log_newrelicotlp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicotlpCreateLogNewrelicotlp',
    'type' => 'write',
    'name' => 'Create a New Relic OTLP endpoint',
    'description' => 'Create a New Relic OTLP endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_newrelicotlp_delete_log_newrelicotlp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicotlpDeleteLogNewrelicotlp',
    'type' => 'write',
    'name' => 'Delete a New Relic OTLP endpoint',
    'description' => 'Delete a New Relic OTLP endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_newrelicotlp_get_log_newrelicotlp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicotlpGetLogNewrelicotlp',
    'type' => 'read',
    'name' => 'Get a New Relic OTLP endpoint',
    'description' => 'Get a New Relic OTLP endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_newrelicotlp_list_log_newrelicotlp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicotlpListLogNewrelicotlp',
    'type' => 'read',
    'name' => 'List New Relic OTLP endpoints',
    'description' => 'List New Relic OTLP endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_newrelicotlp_update_log_newrelicotlp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingNewrelicotlpUpdateLogNewrelicotlp',
    'type' => 'write',
    'name' => 'Update a New Relic log endpoint',
    'description' => 'Update a New Relic log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_openstack_create_log_openstack' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingOpenstackCreateLogOpenstack',
    'type' => 'write',
    'name' => 'Create an OpenStack log endpoint',
    'description' => 'Create an OpenStack log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_openstack_delete_log_openstack' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingOpenstackDeleteLogOpenstack',
    'type' => 'write',
    'name' => 'Delete an OpenStack log endpoint',
    'description' => 'Delete an OpenStack log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_openstack_get_log_openstack' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingOpenstackGetLogOpenstack',
    'type' => 'read',
    'name' => 'Get an OpenStack log endpoint',
    'description' => 'Get an OpenStack log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_openstack_list_log_openstack' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingOpenstackListLogOpenstack',
    'type' => 'read',
    'name' => 'List OpenStack log endpoints',
    'description' => 'List OpenStack log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_openstack_update_log_openstack' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingOpenstackUpdateLogOpenstack',
    'type' => 'write',
    'name' => 'Update an OpenStack log endpoint',
    'description' => 'Update an OpenStack log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_papertrail_create_log_papertrail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPapertrailCreateLogPapertrail',
    'type' => 'write',
    'name' => 'Create a Papertrail log endpoint',
    'description' => 'Create a Papertrail log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_papertrail_delete_log_papertrail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPapertrailDeleteLogPapertrail',
    'type' => 'write',
    'name' => 'Delete a Papertrail log endpoint',
    'description' => 'Delete a Papertrail log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_papertrail_get_log_papertrail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPapertrailGetLogPapertrail',
    'type' => 'read',
    'name' => 'Get a Papertrail log endpoint',
    'description' => 'Get a Papertrail log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_papertrail_list_log_papertrail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPapertrailListLogPapertrail',
    'type' => 'read',
    'name' => 'List Papertrail log endpoints',
    'description' => 'List Papertrail log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_papertrail_update_log_papertrail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPapertrailUpdateLogPapertrail',
    'type' => 'write',
    'name' => 'Update a Papertrail log endpoint',
    'description' => 'Update a Papertrail log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_pubsub_create_log_gcp_pubsub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPubsubCreateLogGcpPubsub',
    'type' => 'write',
    'name' => 'Create a GCP Cloud Pub/Sub log endpoint',
    'description' => 'Create a GCP Cloud Pub/Sub log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_pubsub_delete_log_gcp_pubsub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPubsubDeleteLogGcpPubsub',
    'type' => 'write',
    'name' => 'Delete a GCP Cloud Pub/Sub log endpoint',
    'description' => 'Delete a GCP Cloud Pub/Sub log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_pubsub_get_log_gcp_pubsub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPubsubGetLogGcpPubsub',
    'type' => 'read',
    'name' => 'Get a GCP Cloud Pub/Sub log endpoint',
    'description' => 'Get a GCP Cloud Pub/Sub log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_pubsub_list_log_gcp_pubsub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPubsubListLogGcpPubsub',
    'type' => 'read',
    'name' => 'List GCP Cloud Pub/Sub log endpoints',
    'description' => 'List GCP Cloud Pub/Sub log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_pubsub_update_log_gcp_pubsub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingPubsubUpdateLogGcpPubsub',
    'type' => 'write',
    'name' => 'Update a GCP Cloud Pub/Sub log endpoint',
    'description' => 'Update a GCP Cloud Pub/Sub log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_s3_create_log_aws_s3' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingS3CreateLogAwsS3',
    'type' => 'write',
    'name' => 'Create an AWS S3 log endpoint',
    'description' => 'Create an AWS S3 log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_s3_delete_log_aws_s3' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingS3DeleteLogAwsS3',
    'type' => 'write',
    'name' => 'Delete an AWS S3 log endpoint',
    'description' => 'Delete an AWS S3 log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_s3_get_log_aws_s3' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingS3GetLogAwsS3',
    'type' => 'read',
    'name' => 'Get an AWS S3 log endpoint',
    'description' => 'Get an AWS S3 log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_s3_list_log_aws_s3' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingS3ListLogAwsS3',
    'type' => 'read',
    'name' => 'List AWS S3 log endpoints',
    'description' => 'List AWS S3 log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_s3_update_log_aws_s3' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingS3UpdateLogAwsS3',
    'type' => 'write',
    'name' => 'Update an AWS S3 log endpoint',
    'description' => 'Update an AWS S3 log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_scalyr_create_log_scalyr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingScalyrCreateLogScalyr',
    'type' => 'write',
    'name' => 'Create a Scalyr log endpoint',
    'description' => 'Create a Scalyr log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_scalyr_delete_log_scalyr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingScalyrDeleteLogScalyr',
    'type' => 'write',
    'name' => 'Delete the Scalyr log endpoint',
    'description' => 'Delete the Scalyr log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_scalyr_get_log_scalyr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingScalyrGetLogScalyr',
    'type' => 'read',
    'name' => 'Get a Scalyr log endpoint',
    'description' => 'Get a Scalyr log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_scalyr_list_log_scalyr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingScalyrListLogScalyr',
    'type' => 'read',
    'name' => 'List Scalyr log endpoints',
    'description' => 'List Scalyr log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_scalyr_update_log_scalyr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingScalyrUpdateLogScalyr',
    'type' => 'write',
    'name' => 'Update the Scalyr log endpoint',
    'description' => 'Update the Scalyr log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_sftp_create_log_sftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSftpCreateLogSftp',
    'type' => 'write',
    'name' => 'Create an SFTP log endpoint',
    'description' => 'Create an SFTP log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_sftp_delete_log_sftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSftpDeleteLogSftp',
    'type' => 'write',
    'name' => 'Delete an SFTP log endpoint',
    'description' => 'Delete an SFTP log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_sftp_get_log_sftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSftpGetLogSftp',
    'type' => 'read',
    'name' => 'Get an SFTP log endpoint',
    'description' => 'Get an SFTP log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_sftp_list_log_sftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSftpListLogSftp',
    'type' => 'read',
    'name' => 'List SFTP log endpoints',
    'description' => 'List SFTP log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_sftp_update_log_sftp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSftpUpdateLogSftp',
    'type' => 'write',
    'name' => 'Update an SFTP log endpoint',
    'description' => 'Update an SFTP log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_splunk_create_log_splunk' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSplunkCreateLogSplunk',
    'type' => 'write',
    'name' => 'Create a Splunk log endpoint',
    'description' => 'Create a Splunk log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_splunk_delete_log_splunk' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSplunkDeleteLogSplunk',
    'type' => 'write',
    'name' => 'Delete a Splunk log endpoint',
    'description' => 'Delete a Splunk log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_splunk_get_log_splunk' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSplunkGetLogSplunk',
    'type' => 'read',
    'name' => 'Get a Splunk log endpoint',
    'description' => 'Get a Splunk log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_splunk_list_log_splunk' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSplunkListLogSplunk',
    'type' => 'read',
    'name' => 'List Splunk log endpoints',
    'description' => 'List Splunk log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_splunk_update_log_splunk' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSplunkUpdateLogSplunk',
    'type' => 'write',
    'name' => 'Update a Splunk log endpoint',
    'description' => 'Update a Splunk log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_sumologic_create_log_sumologic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSumologicCreateLogSumologic',
    'type' => 'write',
    'name' => 'Create a Sumologic log endpoint',
    'description' => 'Create a Sumologic log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_sumologic_delete_log_sumologic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSumologicDeleteLogSumologic',
    'type' => 'write',
    'name' => 'Delete a Sumologic log endpoint',
    'description' => 'Delete a Sumologic log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_sumologic_get_log_sumologic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSumologicGetLogSumologic',
    'type' => 'read',
    'name' => 'Get a Sumologic log endpoint',
    'description' => 'Get a Sumologic log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_sumologic_list_log_sumologic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSumologicListLogSumologic',
    'type' => 'read',
    'name' => 'List Sumologic log endpoints',
    'description' => 'List Sumologic log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_sumologic_update_log_sumologic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSumologicUpdateLogSumologic',
    'type' => 'write',
    'name' => 'Update a Sumologic log endpoint',
    'description' => 'Update a Sumologic log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_syslog_create_log_syslog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSyslogCreateLogSyslog',
    'type' => 'write',
    'name' => 'Create a syslog log endpoint',
    'description' => 'Create a syslog log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_syslog_delete_log_syslog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSyslogDeleteLogSyslog',
    'type' => 'write',
    'name' => 'Delete a syslog log endpoint',
    'description' => 'Delete a syslog log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_logging_syslog_get_log_syslog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSyslogGetLogSyslog',
    'type' => 'read',
    'name' => 'Get a syslog log endpoint',
    'description' => 'Get a syslog log endpoint',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_syslog_list_log_syslog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSyslogListLogSyslog',
    'type' => 'read',
    'name' => 'List Syslog log endpoints',
    'description' => 'List Syslog log endpoints',
    'icon' => 'ph:cloud',
  ),
  'fastly_logging_syslog_update_log_syslog' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyLoggingSyslogUpdateLogSyslog',
    'type' => 'write',
    'name' => 'Update a syslog log endpoint',
    'description' => 'Update a syslog log endpoint',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_metrics_platform_get_platform_metrics_service_historical' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyMetricsPlatformGetPlatformMetricsServiceHistorical',
    'type' => 'read',
    'name' => 'Get historical time series metrics for a single service',
    'description' => 'Get historical time series metrics for a single service',
    'icon' => 'ph:cloud',
  ),
  'fastly_mutual_authentication_create_mutual_tls_authentication' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyMutualAuthenticationCreateMutualTlsAuthentication',
    'type' => 'write',
    'name' => 'Create a Mutual Authentication',
    'description' => 'Create a Mutual Authentication',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_mutual_authentication_delete_mutual_tls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyMutualAuthenticationDeleteMutualTls',
    'type' => 'write',
    'name' => 'Delete a Mutual TLS',
    'description' => 'Delete a Mutual TLS',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_mutual_authentication_get_mutual_authentication' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyMutualAuthenticationGetMutualAuthentication',
    'type' => 'read',
    'name' => 'Get a Mutual Authentication',
    'description' => 'Get a Mutual Authentication',
    'icon' => 'ph:cloud',
  ),
  'fastly_mutual_authentication_list_mutual_authentications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyMutualAuthenticationListMutualAuthentications',
    'type' => 'read',
    'name' => 'List Mutual Authentications',
    'description' => 'List Mutual Authentications',
    'icon' => 'ph:cloud',
  ),
  'fastly_mutual_authentication_patch_mutual_authentication' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyMutualAuthenticationPatchMutualAuthentication',
    'type' => 'write',
    'name' => 'Update a Mutual Authentication',
    'description' => 'Update a Mutual Authentication',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_ngwaf_reports_get_attacks_report' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyNgwafReportsGetAttacksReport',
    'type' => 'read',
    'name' => 'Get attacks report',
    'description' => 'Get attacks report',
    'icon' => 'ph:cloud',
  ),
  'fastly_ngwaf_reports_get_signals_report' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyNgwafReportsGetSignalsReport',
    'type' => 'read',
    'name' => 'Get signals report',
    'description' => 'Get signals report',
    'icon' => 'ph:cloud',
  ),
  'fastly_object_storage_access_keys_create_access_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObjectStorageAccessKeysCreateAccessKey',
    'type' => 'write',
    'name' => 'Create an access key',
    'description' => 'Create an access key',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_object_storage_access_keys_delete_access_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObjectStorageAccessKeysDeleteAccessKey',
    'type' => 'write',
    'name' => 'Delete an access key',
    'description' => 'Delete an access key',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_object_storage_access_keys_get_access_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObjectStorageAccessKeysGetAccessKey',
    'type' => 'read',
    'name' => 'Get an access key',
    'description' => 'Get an access key',
    'icon' => 'ph:cloud',
  ),
  'fastly_object_storage_access_keys_list_access_keys' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObjectStorageAccessKeysListAccessKeys',
    'type' => 'read',
    'name' => 'List access keys',
    'description' => 'List access keys',
    'icon' => 'ph:cloud',
  ),
  'fastly_observability_aggregations_for_logs_log_aggregations_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObservabilityAggregationsForLogsLogAggregationsGet',
    'type' => 'read',
    'name' => 'Retrieve aggregated log results',
    'description' => 'Retrieve aggregated log results',
    'icon' => 'ph:cloud',
  ),
  'fastly_observability_custom_dashboards_create_dashboard' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObservabilityCustomDashboardsCreateDashboard',
    'type' => 'write',
    'name' => 'Create a new dashboard',
    'description' => 'Create a new dashboard',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_observability_custom_dashboards_delete_dashboard' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObservabilityCustomDashboardsDeleteDashboard',
    'type' => 'write',
    'name' => 'Delete an existing dashboard',
    'description' => 'Delete an existing dashboard',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_observability_custom_dashboards_get_dashboard' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObservabilityCustomDashboardsGetDashboard',
    'type' => 'read',
    'name' => 'Retrieve a dashboard by ID',
    'description' => 'Retrieve a dashboard by ID',
    'icon' => 'ph:cloud',
  ),
  'fastly_observability_custom_dashboards_list_dashboards' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObservabilityCustomDashboardsListDashboards',
    'type' => 'read',
    'name' => 'List all custom dashboards',
    'description' => 'List all custom dashboards',
    'icon' => 'ph:cloud',
  ),
  'fastly_observability_custom_dashboards_update_dashboard' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObservabilityCustomDashboardsUpdateDashboard',
    'type' => 'write',
    'name' => 'Update an existing dashboard',
    'description' => 'Update an existing dashboard',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_observability_timeseries_timeseries_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyObservabilityTimeseriesTimeseriesGet',
    'type' => 'read',
    'name' => 'Retrieve observability data as a time series',
    'description' => 'Retrieve observability data as a time series',
    'icon' => 'ph:cloud',
  ),
  'fastly_origin_inspector_historical_get_origin_inspector_historical' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyOriginInspectorHistoricalGetOriginInspectorHistorical',
    'type' => 'read',
    'name' => 'Get historical origin data for a service',
    'description' => 'Get historical origin data for a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_origin_inspector_realtime_get_origin_inspector_last120_seconds' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyOriginInspectorRealtimeGetOriginInspectorLast120Seconds',
    'type' => 'read',
    'name' => 'Get real-time origin data for the last 120 seconds',
    'description' => 'Get real-time origin data for the last 120 seconds',
    'icon' => 'ph:cloud',
  ),
  'fastly_origin_inspector_realtime_get_origin_inspector_last_max_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyOriginInspectorRealtimeGetOriginInspectorLastMaxEntries',
    'type' => 'read',
    'name' => 'Get a limited number of real-time origin data entries',
    'description' => 'Get a limited number of real-time origin data entries',
    'icon' => 'ph:cloud',
  ),
  'fastly_origin_inspector_realtime_get_origin_inspector_last_second' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyOriginInspectorRealtimeGetOriginInspectorLastSecond',
    'type' => 'read',
    'name' => 'Get real-time origin data from specific time.',
    'description' => 'Get real-time origin data from specific time.',
    'icon' => 'ph:cloud',
  ),
  'fastly_package_get_package' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPackageGetPackage',
    'type' => 'read',
    'name' => 'Get details of the service\'s Compute package.',
    'description' => 'Get details of the service\'s Compute package.',
    'icon' => 'ph:cloud',
  ),
  'fastly_package_put_package' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPackagePutPackage',
    'type' => 'write',
    'name' => 'Upload a Compute package.',
    'description' => 'Upload a Compute package.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_pool_create_server_pool' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPoolCreateServerPool',
    'type' => 'write',
    'name' => 'Create a server pool',
    'description' => 'Create a server pool',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_pool_delete_server_pool' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPoolDeleteServerPool',
    'type' => 'write',
    'name' => 'Delete a server pool',
    'description' => 'Delete a server pool',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_pool_get_server_pool' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPoolGetServerPool',
    'type' => 'read',
    'name' => 'Get a server pool',
    'description' => 'Get a server pool',
    'icon' => 'ph:cloud',
  ),
  'fastly_pool_list_server_pools' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPoolListServerPools',
    'type' => 'read',
    'name' => 'List server pools',
    'description' => 'List server pools',
    'icon' => 'ph:cloud',
  ),
  'fastly_pool_update_server_pool' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPoolUpdateServerPool',
    'type' => 'write',
    'name' => 'Update a server pool',
    'description' => 'Update a server pool',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_pop_list_pops' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPopListPops',
    'type' => 'read',
    'name' => 'List Fastly POPs',
    'description' => 'List Fastly POPs',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ai_accelerator_disable_product_ai_accelerator' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductAiAcceleratorDisableProductAiAccelerator',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_ai_accelerator_enable_ai_accelerator' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductAiAcceleratorEnableAiAccelerator',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_ai_accelerator_get_ai_accelerator' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductAiAcceleratorGetAiAccelerator',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_api_discovery_disable_product_api_discovery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductApiDiscoveryDisableProductApiDiscovery',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_api_discovery_enable_product_api_discovery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductApiDiscoveryEnableProductApiDiscovery',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_api_discovery_get_product_api_discovery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductApiDiscoveryGetProductApiDiscovery',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_api_discovery_get_services_product_api_discovery' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductApiDiscoveryGetServicesProductApiDiscovery',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_bot_management_disable_product_bot_management' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductBotManagementDisableProductBotManagement',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_bot_management_enable_product_bot_management' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductBotManagementEnableProductBotManagement',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_bot_management_get_product_bot_management' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductBotManagementGetProductBotManagement',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_bot_management_get_services_product_bot_management' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductBotManagementGetServicesProductBotManagement',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_brotli_compression_disable_product_brotli_compression' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductBrotliCompressionDisableProductBrotliCompression',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_brotli_compression_enable_product_brotli_compression' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductBrotliCompressionEnableProductBrotliCompression',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_brotli_compression_get_product_brotli_compression' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductBrotliCompressionGetProductBrotliCompression',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_brotli_compression_get_services_product_brotli_compression' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductBrotliCompressionGetServicesProductBrotliCompression',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ddos_protection_disable_product_ddos_protection' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDdosProtectionDisableProductDdosProtection',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_ddos_protection_enable_product_ddos_protection' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDdosProtectionEnableProductDdosProtection',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_ddos_protection_get_product_ddos_protection' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDdosProtectionGetProductDdosProtection',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ddos_protection_get_product_ddos_protection_configuration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDdosProtectionGetProductDdosProtectionConfiguration',
    'type' => 'read',
    'name' => 'Get configuration',
    'description' => 'Get configuration',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ddos_protection_get_services_product_ddos_protection' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDdosProtectionGetServicesProductDdosProtection',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ddos_protection_set_product_ddos_protection_configuration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDdosProtectionSetProductDdosProtectionConfiguration',
    'type' => 'write',
    'name' => 'Update configuration',
    'description' => 'Update configuration',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_domain_inspector_disable_product_domain_inspector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDomainInspectorDisableProductDomainInspector',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_domain_inspector_enable_product_domain_inspector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDomainInspectorEnableProductDomainInspector',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_domain_inspector_get_product_domain_inspector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDomainInspectorGetProductDomainInspector',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_domain_inspector_get_services_product_domain_inspector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDomainInspectorGetServicesProductDomainInspector',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_domain_research_disable_product_domain_research' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDomainResearchDisableProductDomainResearch',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_domain_research_enable_domain_research' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDomainResearchEnableDomainResearch',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_domain_research_get_domain_research' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductDomainResearchGetDomainResearch',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_fanout_disable_product_fanout' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductFanoutDisableProductFanout',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_fanout_enable_product_fanout' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductFanoutEnableProductFanout',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_fanout_get_product_fanout' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductFanoutGetProductFanout',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_fanout_get_services_product_fanout' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductFanoutGetServicesProductFanout',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_image_optimizer_disable_product_image_optimizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductImageOptimizerDisableProductImageOptimizer',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_image_optimizer_enable_product_image_optimizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductImageOptimizerEnableProductImageOptimizer',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_image_optimizer_get_product_image_optimizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductImageOptimizerGetProductImageOptimizer',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_image_optimizer_get_services_product_image_optimizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductImageOptimizerGetServicesProductImageOptimizer',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_log_explorer_insights_disable_product_log_explorer_insights' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductLogExplorerInsightsDisableProductLogExplorerInsights',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_log_explorer_insights_enable_product_log_explorer_insights' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductLogExplorerInsightsEnableProductLogExplorerInsights',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_log_explorer_insights_get_product_log_explorer_insights' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductLogExplorerInsightsGetProductLogExplorerInsights',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_log_explorer_insights_get_services_product_log_explorer_insights' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductLogExplorerInsightsGetServicesProductLogExplorerInsights',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ngwaf_disable_product_ngwaf' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductNgwafDisableProductNgwaf',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_ngwaf_enable_product_ngwaf' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductNgwafEnableProductNgwaf',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_ngwaf_get_product_ngwaf' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductNgwafGetProductNgwaf',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ngwaf_get_product_ngwaf_configuration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductNgwafGetProductNgwafConfiguration',
    'type' => 'read',
    'name' => 'Get configuration',
    'description' => 'Get configuration',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ngwaf_get_services_product_ngwaf' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductNgwafGetServicesProductNgwaf',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_ngwaf_set_product_ngwaf_configuration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductNgwafSetProductNgwafConfiguration',
    'type' => 'write',
    'name' => 'Update configuration',
    'description' => 'Update configuration',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_object_storage_disable_product_object_storage' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductObjectStorageDisableProductObjectStorage',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_object_storage_enable_object_storage' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductObjectStorageEnableObjectStorage',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_object_storage_get_object_storage' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductObjectStorageGetObjectStorage',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_origin_inspector_disable_product_origin_inspector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductOriginInspectorDisableProductOriginInspector',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_origin_inspector_enable_product_origin_inspector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductOriginInspectorEnableProductOriginInspector',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_origin_inspector_get_product_origin_inspector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductOriginInspectorGetProductOriginInspector',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_origin_inspector_get_services_product_origin_inspector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductOriginInspectorGetServicesProductOriginInspector',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_websockets_disable_product_websockets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductWebsocketsDisableProductWebsockets',
    'type' => 'write',
    'name' => 'Disable product',
    'description' => 'Disable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_websockets_enable_product_websockets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductWebsocketsEnableProductWebsockets',
    'type' => 'write',
    'name' => 'Enable product',
    'description' => 'Enable product',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_product_websockets_get_product_websockets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductWebsocketsGetProductWebsockets',
    'type' => 'read',
    'name' => 'Get product enablement status',
    'description' => 'Get product enablement status',
    'icon' => 'ph:cloud',
  ),
  'fastly_product_websockets_get_services_product_websockets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyProductWebsocketsGetServicesProductWebsockets',
    'type' => 'read',
    'name' => 'Get services with product enabled',
    'description' => 'Get services with product enabled',
    'icon' => 'ph:cloud',
  ),
  'fastly_public_ip_list_list_fastly_ips' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPublicIpListListFastlyIps',
    'type' => 'read',
    'name' => 'List Fastly\'s public IPs',
    'description' => 'List Fastly\'s public IPs',
    'icon' => 'ph:cloud',
  ),
  'fastly_publish_publish' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPublishPublish',
    'type' => 'write',
    'name' => 'Send messages to Fanout subscribers',
    'description' => 'Send messages to Fanout subscribers',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_purge_bulk_purge_tag' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPurgeBulkPurgeTag',
    'type' => 'write',
    'name' => 'Purge multiple surrogate key tags',
    'description' => 'Purge multiple surrogate key tags',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_purge_purge_all' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPurgePurgeAll',
    'type' => 'write',
    'name' => 'Purge everything from a service',
    'description' => 'Purge everything from a service',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_purge_purge_single_url' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPurgePurgeSingleUrl',
    'type' => 'write',
    'name' => 'Purge a URL',
    'description' => 'Purge a URL',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_purge_purge_tag' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyPurgePurgeTag',
    'type' => 'write',
    'name' => 'Purge by surrogate key tag',
    'description' => 'Purge by surrogate key tag',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_rate_limiter_create_rate_limiter' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRateLimiterCreateRateLimiter',
    'type' => 'write',
    'name' => 'Create a rate limiter',
    'description' => 'Create a rate limiter',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_rate_limiter_delete_rate_limiter' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRateLimiterDeleteRateLimiter',
    'type' => 'write',
    'name' => 'Delete a rate limiter',
    'description' => 'Delete a rate limiter',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_rate_limiter_get_rate_limiter' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRateLimiterGetRateLimiter',
    'type' => 'read',
    'name' => 'Get a rate limiter',
    'description' => 'Get a rate limiter',
    'icon' => 'ph:cloud',
  ),
  'fastly_rate_limiter_list_rate_limiters' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRateLimiterListRateLimiters',
    'type' => 'read',
    'name' => 'List rate limiters',
    'description' => 'List rate limiters',
    'icon' => 'ph:cloud',
  ),
  'fastly_rate_limiter_update_rate_limiter' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRateLimiterUpdateRateLimiter',
    'type' => 'write',
    'name' => 'Update a rate limiter',
    'description' => 'Update a rate limiter',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_realtime_get_stats_last120_seconds' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRealtimeGetStatsLast120Seconds',
    'type' => 'read',
    'name' => 'Get real-time data for the last 120 seconds',
    'description' => 'Get real-time data for the last 120 seconds',
    'icon' => 'ph:cloud',
  ),
  'fastly_realtime_get_stats_last120_seconds_limit_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRealtimeGetStatsLast120SecondsLimitEntries',
    'type' => 'read',
    'name' => 'Get a limited number of real-time data entries',
    'description' => 'Get a limited number of real-time data entries',
    'icon' => 'ph:cloud',
  ),
  'fastly_realtime_get_stats_last_second' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRealtimeGetStatsLastSecond',
    'type' => 'read',
    'name' => 'Get real-time data from specified time',
    'description' => 'Get real-time data from specified time',
    'icon' => 'ph:cloud',
  ),
  'fastly_request_settings_create_request_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRequestSettingsCreateRequestSettings',
    'type' => 'write',
    'name' => 'Create a Request Settings object',
    'description' => 'Create a Request Settings object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_request_settings_delete_request_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRequestSettingsDeleteRequestSettings',
    'type' => 'write',
    'name' => 'Delete a Request Settings object',
    'description' => 'Delete a Request Settings object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_request_settings_get_request_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRequestSettingsGetRequestSettings',
    'type' => 'read',
    'name' => 'Get a Request Settings object',
    'description' => 'Get a Request Settings object',
    'icon' => 'ph:cloud',
  ),
  'fastly_request_settings_list_request_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRequestSettingsListRequestSettings',
    'type' => 'read',
    'name' => 'List Request Settings objects',
    'description' => 'List Request Settings objects',
    'icon' => 'ph:cloud',
  ),
  'fastly_request_settings_update_request_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyRequestSettingsUpdateRequestSettings',
    'type' => 'write',
    'name' => 'Update a Request Settings object',
    'description' => 'Update a Request Settings object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_resource_create_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResourceCreateResource',
    'type' => 'write',
    'name' => 'Create a resource link',
    'description' => 'Create a resource link',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_resource_delete_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResourceDeleteResource',
    'type' => 'write',
    'name' => 'Delete a resource link',
    'description' => 'Delete a resource link',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_resource_get_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResourceGetResource',
    'type' => 'read',
    'name' => 'Display a resource link',
    'description' => 'Display a resource link',
    'icon' => 'ph:cloud',
  ),
  'fastly_resource_list_resources' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResourceListResources',
    'type' => 'read',
    'name' => 'List resource links',
    'description' => 'List resource links',
    'icon' => 'ph:cloud',
  ),
  'fastly_resource_update_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResourceUpdateResource',
    'type' => 'write',
    'name' => 'Update a resource link',
    'description' => 'Update a resource link',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_response_object_create_response_object' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResponseObjectCreateResponseObject',
    'type' => 'write',
    'name' => 'Create a Response object',
    'description' => 'Create a Response object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_response_object_delete_response_object' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResponseObjectDeleteResponseObject',
    'type' => 'write',
    'name' => 'Delete a Response Object',
    'description' => 'Delete a Response Object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_response_object_get_response_object' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResponseObjectGetResponseObject',
    'type' => 'read',
    'name' => 'Get a Response object',
    'description' => 'Get a Response object',
    'icon' => 'ph:cloud',
  ),
  'fastly_response_object_list_response_objects' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResponseObjectListResponseObjects',
    'type' => 'read',
    'name' => 'List Response objects',
    'description' => 'List Response objects',
    'icon' => 'ph:cloud',
  ),
  'fastly_response_object_update_response_object' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyResponseObjectUpdateResponseObject',
    'type' => 'write',
    'name' => 'Update a Response object',
    'description' => 'Update a Response object',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_secret_store_client_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreClientKey',
    'type' => 'write',
    'name' => 'Create new client key',
    'description' => 'Create new client key',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_secret_store_create_secret_store' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreCreateSecretStore',
    'type' => 'write',
    'name' => 'Create new secret store',
    'description' => 'Create new secret store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_secret_store_delete_secret_store' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreDeleteSecretStore',
    'type' => 'write',
    'name' => 'Delete secret store',
    'description' => 'Delete secret store',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_secret_store_get_secret_store' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreGetSecretStore',
    'type' => 'read',
    'name' => 'Get secret store by ID',
    'description' => 'Get secret store by ID',
    'icon' => 'ph:cloud',
  ),
  'fastly_secret_store_get_secret_stores' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreGetSecretStores',
    'type' => 'read',
    'name' => 'Get all secret stores',
    'description' => 'Get all secret stores',
    'icon' => 'ph:cloud',
  ),
  'fastly_secret_store_item_create_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreItemCreateSecret',
    'type' => 'write',
    'name' => 'Create a new secret in a store.',
    'description' => 'Create a new secret in a store.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_secret_store_item_delete_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreItemDeleteSecret',
    'type' => 'write',
    'name' => 'Delete a secret from a store.',
    'description' => 'Delete a secret from a store.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_secret_store_item_get_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreItemGetSecret',
    'type' => 'read',
    'name' => 'Get secret metadata.',
    'description' => 'Get secret metadata.',
    'icon' => 'ph:cloud',
  ),
  'fastly_secret_store_item_get_secrets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreItemGetSecrets',
    'type' => 'read',
    'name' => 'List secrets within a store.',
    'description' => 'List secrets within a store.',
    'icon' => 'ph:cloud',
  ),
  'fastly_secret_store_item_must_recreate_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreItemMustRecreateSecret',
    'type' => 'write',
    'name' => 'Recreate a secret in a store.',
    'description' => 'Recreate a secret in a store.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_secret_store_item_recreate_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreItemRecreateSecret',
    'type' => 'write',
    'name' => 'Create or recreate a secret in a store.',
    'description' => 'Create or recreate a secret in a store.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_secret_store_signing_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySecretStoreSigningKey',
    'type' => 'read',
    'name' => 'Get public key',
    'description' => 'Get public key',
    'icon' => 'ph:cloud',
  ),
  'fastly_server_create_pool_server' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServerCreatePoolServer',
    'type' => 'write',
    'name' => 'Add a server to a pool',
    'description' => 'Add a server to a pool',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_server_delete_pool_server' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServerDeletePoolServer',
    'type' => 'write',
    'name' => 'Delete a server from a pool',
    'description' => 'Delete a server from a pool',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_server_get_pool_server' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServerGetPoolServer',
    'type' => 'read',
    'name' => 'Get a pool server',
    'description' => 'Get a pool server',
    'icon' => 'ph:cloud',
  ),
  'fastly_server_list_pool_servers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServerListPoolServers',
    'type' => 'read',
    'name' => 'List servers in a pool',
    'description' => 'List servers in a pool',
    'icon' => 'ph:cloud',
  ),
  'fastly_server_update_pool_server' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServerUpdatePoolServer',
    'type' => 'write',
    'name' => 'Update a server',
    'description' => 'Update a server',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_service_authorizations_create_service_authorization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceAuthorizationsCreateServiceAuthorization',
    'type' => 'write',
    'name' => 'Create service authorization',
    'description' => 'Create service authorization',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_service_authorizations_delete_service_authorization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceAuthorizationsDeleteServiceAuthorization',
    'type' => 'write',
    'name' => 'Delete service authorization',
    'description' => 'Delete service authorization',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_service_authorizations_delete_service_authorization2' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceAuthorizationsDeleteServiceAuthorization2',
    'type' => 'write',
    'name' => 'Delete service authorizations',
    'description' => 'Delete service authorizations',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_service_authorizations_list_service_authorization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceAuthorizationsListServiceAuthorization',
    'type' => 'read',
    'name' => 'List service authorizations',
    'description' => 'List service authorizations',
    'icon' => 'ph:cloud',
  ),
  'fastly_service_authorizations_show_service_authorization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceAuthorizationsShowServiceAuthorization',
    'type' => 'read',
    'name' => 'Show service authorization',
    'description' => 'Show service authorization',
    'icon' => 'ph:cloud',
  ),
  'fastly_service_authorizations_update_service_authorization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceAuthorizationsUpdateServiceAuthorization',
    'type' => 'write',
    'name' => 'Update service authorization',
    'description' => 'Update service authorization',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_service_authorizations_update_service_authorization2' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceAuthorizationsUpdateServiceAuthorization2',
    'type' => 'write',
    'name' => 'Update service authorizations',
    'description' => 'Update service authorizations',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_service_create_service' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceCreateService',
    'type' => 'write',
    'name' => 'Create a service',
    'description' => 'Create a service',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_service_delete_service' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceDeleteService',
    'type' => 'write',
    'name' => 'Delete a service',
    'description' => 'Delete a service',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_service_get_service' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceGetService',
    'type' => 'read',
    'name' => 'Get a service',
    'description' => 'Get a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_service_get_service_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceGetServiceDetail',
    'type' => 'read',
    'name' => 'Get service details',
    'description' => 'Get service details',
    'icon' => 'ph:cloud',
  ),
  'fastly_service_list_service_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceListServiceDomains',
    'type' => 'read',
    'name' => 'List the domains within a service',
    'description' => 'List the domains within a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_service_list_services' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceListServices',
    'type' => 'read',
    'name' => 'List services',
    'description' => 'List services',
    'icon' => 'ph:cloud',
  ),
  'fastly_service_search_service' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceSearchService',
    'type' => 'read',
    'name' => 'Search for a service by name',
    'description' => 'Search for a service by name',
    'icon' => 'ph:cloud',
  ),
  'fastly_service_update_service' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyServiceUpdateService',
    'type' => 'write',
    'name' => 'Update a service',
    'description' => 'Update a service',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_settings_get_service_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySettingsGetServiceSettings',
    'type' => 'read',
    'name' => 'Get service settings',
    'description' => 'Get service settings',
    'icon' => 'ph:cloud',
  ),
  'fastly_settings_update_service_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySettingsUpdateServiceSettings',
    'type' => 'write',
    'name' => 'Update service settings',
    'description' => 'Update service settings',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_snippet_create_snippet' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySnippetCreateSnippet',
    'type' => 'write',
    'name' => 'Create a snippet',
    'description' => 'Create a snippet',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_snippet_delete_snippet' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySnippetDeleteSnippet',
    'type' => 'write',
    'name' => 'Delete a snippet',
    'description' => 'Delete a snippet',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_snippet_get_snippet' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySnippetGetSnippet',
    'type' => 'read',
    'name' => 'Get a versioned snippet',
    'description' => 'Get a versioned snippet',
    'icon' => 'ph:cloud',
  ),
  'fastly_snippet_get_snippet_dynamic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySnippetGetSnippetDynamic',
    'type' => 'read',
    'name' => 'Get a dynamic snippet',
    'description' => 'Get a dynamic snippet',
    'icon' => 'ph:cloud',
  ),
  'fastly_snippet_list_snippets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySnippetListSnippets',
    'type' => 'read',
    'name' => 'List snippets',
    'description' => 'List snippets',
    'icon' => 'ph:cloud',
  ),
  'fastly_snippet_update_snippet' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySnippetUpdateSnippet',
    'type' => 'write',
    'name' => 'Update a versioned snippet',
    'description' => 'Update a versioned snippet',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_snippet_update_snippet_dynamic' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySnippetUpdateSnippetDynamic',
    'type' => 'write',
    'name' => 'Update a dynamic snippet',
    'description' => 'Update a dynamic snippet',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_star_create_service_star' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyStarCreateServiceStar',
    'type' => 'write',
    'name' => 'Create a star',
    'description' => 'Create a star',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_star_delete_service_star' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyStarDeleteServiceStar',
    'type' => 'write',
    'name' => 'Delete a star',
    'description' => 'Delete a star',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_star_get_service_star' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyStarGetServiceStar',
    'type' => 'read',
    'name' => 'Get a star',
    'description' => 'Get a star',
    'icon' => 'ph:cloud',
  ),
  'fastly_star_list_service_stars' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyStarListServiceStars',
    'type' => 'read',
    'name' => 'List stars',
    'description' => 'List stars',
    'icon' => 'ph:cloud',
  ),
  'fastly_stats_get_service_stats' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyStatsGetServiceStats',
    'type' => 'read',
    'name' => 'Get stats for a service',
    'description' => 'Get stats for a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_sudo_request_sudo_access' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlySudoRequestSudoAccess',
    'type' => 'write',
    'name' => 'Request Sudo access',
    'description' => 'Request Sudo access',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_activations_create_tls_activation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsActivationsCreateTlsActivation',
    'type' => 'write',
    'name' => 'Enable TLS for a domain using a custom certificate',
    'description' => 'Enable TLS for a domain using a custom certificate',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_activations_delete_tls_activation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsActivationsDeleteTlsActivation',
    'type' => 'write',
    'name' => 'Disable TLS on a domain',
    'description' => 'Disable TLS on a domain',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_activations_get_tls_activation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsActivationsGetTlsActivation',
    'type' => 'read',
    'name' => 'Get a TLS activation',
    'description' => 'Get a TLS activation',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_activations_list_tls_activations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsActivationsListTlsActivations',
    'type' => 'read',
    'name' => 'List TLS activations',
    'description' => 'List TLS activations',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_activations_update_tls_activation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsActivationsUpdateTlsActivation',
    'type' => 'write',
    'name' => 'Update a certificate',
    'description' => 'Update a certificate',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_bulk_certificates_delete_bulk_tls_cert' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsBulkCertificatesDeleteBulkTlsCert',
    'type' => 'write',
    'name' => 'Delete a certificate',
    'description' => 'Delete a certificate',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_bulk_certificates_get_tls_bulk_cert' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsBulkCertificatesGetTlsBulkCert',
    'type' => 'read',
    'name' => 'Get a certificate',
    'description' => 'Get a certificate',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_bulk_certificates_list_tls_bulk_certs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsBulkCertificatesListTlsBulkCerts',
    'type' => 'read',
    'name' => 'List certificates',
    'description' => 'List certificates',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_bulk_certificates_update_bulk_tls_cert' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsBulkCertificatesUpdateBulkTlsCert',
    'type' => 'write',
    'name' => 'Update a certificate',
    'description' => 'Update a certificate',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_bulk_certificates_upload_tls_bulk_cert' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsBulkCertificatesUploadTlsBulkCert',
    'type' => 'write',
    'name' => 'Upload a certificate',
    'description' => 'Upload a certificate',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_certificates_create_tls_cert' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsCertificatesCreateTlsCert',
    'type' => 'write',
    'name' => 'Create a TLS certificate',
    'description' => 'Create a TLS certificate',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_certificates_delete_tls_cert' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsCertificatesDeleteTlsCert',
    'type' => 'write',
    'name' => 'Delete a TLS certificate',
    'description' => 'Delete a TLS certificate',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_certificates_get_tls_cert' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsCertificatesGetTlsCert',
    'type' => 'read',
    'name' => 'Get a TLS certificate',
    'description' => 'Get a TLS certificate',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_certificates_get_tls_cert_blob' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsCertificatesGetTlsCertBlob',
    'type' => 'read',
    'name' => 'Get a TLS certificate blob (Limited Availability)',
    'description' => 'Get a TLS certificate blob (Limited Availability)',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_certificates_list_tls_certs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsCertificatesListTlsCerts',
    'type' => 'read',
    'name' => 'List TLS certificates',
    'description' => 'List TLS certificates',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_certificates_update_tls_cert' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsCertificatesUpdateTlsCert',
    'type' => 'write',
    'name' => 'Update a TLS certificate',
    'description' => 'Update a TLS certificate',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_configurations_get_tls_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsConfigurationsGetTlsConfig',
    'type' => 'read',
    'name' => 'Get a TLS configuration',
    'description' => 'Get a TLS configuration',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_configurations_list_tls_configs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsConfigurationsListTlsConfigs',
    'type' => 'read',
    'name' => 'List TLS configurations',
    'description' => 'List TLS configurations',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_configurations_update_tls_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsConfigurationsUpdateTlsConfig',
    'type' => 'write',
    'name' => 'Update a TLS configuration',
    'description' => 'Update a TLS configuration',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_csrs_create_csr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsCsrsCreateCsr',
    'type' => 'write',
    'name' => 'Create CSR',
    'description' => 'Create CSR',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_domains_list_tls_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsDomainsListTlsDomains',
    'type' => 'read',
    'name' => 'List TLS domains',
    'description' => 'List TLS domains',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_private_keys_create_tls_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsPrivateKeysCreateTlsKey',
    'type' => 'write',
    'name' => 'Create a TLS private key',
    'description' => 'Create a TLS private key',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_private_keys_delete_tls_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsPrivateKeysDeleteTlsKey',
    'type' => 'write',
    'name' => 'Delete a TLS private key',
    'description' => 'Delete a TLS private key',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_private_keys_get_tls_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsPrivateKeysGetTlsKey',
    'type' => 'read',
    'name' => 'Get a TLS private key',
    'description' => 'Get a TLS private key',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_private_keys_list_tls_keys' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsPrivateKeysListTlsKeys',
    'type' => 'read',
    'name' => 'List TLS private keys',
    'description' => 'List TLS private keys',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_subscriptions_create_globalsign_email_challenge' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsSubscriptionsCreateGlobalsignEmailChallenge',
    'type' => 'write',
    'name' => 'Creates a GlobalSign email challenge.',
    'description' => 'Creates a GlobalSign email challenge.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_subscriptions_create_tls_sub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsSubscriptionsCreateTlsSub',
    'type' => 'write',
    'name' => 'Create a TLS subscription',
    'description' => 'Create a TLS subscription',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_subscriptions_delete_globalsign_email_challenge' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsSubscriptionsDeleteGlobalsignEmailChallenge',
    'type' => 'write',
    'name' => 'Delete a GlobalSign email challenge',
    'description' => 'Delete a GlobalSign email challenge',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_subscriptions_delete_tls_sub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsSubscriptionsDeleteTlsSub',
    'type' => 'write',
    'name' => 'Delete a TLS subscription',
    'description' => 'Delete a TLS subscription',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tls_subscriptions_get_tls_sub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsSubscriptionsGetTlsSub',
    'type' => 'read',
    'name' => 'Get a TLS subscription',
    'description' => 'Get a TLS subscription',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_subscriptions_list_tls_subs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsSubscriptionsListTlsSubs',
    'type' => 'read',
    'name' => 'List TLS subscriptions',
    'description' => 'List TLS subscriptions',
    'icon' => 'ph:cloud',
  ),
  'fastly_tls_subscriptions_patch_tls_sub' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTlsSubscriptionsPatchTlsSub',
    'type' => 'write',
    'name' => 'Update a TLS subscription',
    'description' => 'Update a TLS subscription',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tokens_bulk_revoke_tokens' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTokensBulkRevokeTokens',
    'type' => 'write',
    'name' => 'Revoke multiple tokens',
    'description' => 'Revoke multiple tokens',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tokens_create_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTokensCreateToken',
    'type' => 'write',
    'name' => 'Create a token',
    'description' => 'Create a token',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tokens_get_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTokensGetToken',
    'type' => 'read',
    'name' => 'Get a token',
    'description' => 'Get a token',
    'icon' => 'ph:cloud',
  ),
  'fastly_tokens_get_token_current' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTokensGetTokenCurrent',
    'type' => 'read',
    'name' => 'Get the current token',
    'description' => 'Get the current token',
    'icon' => 'ph:cloud',
  ),
  'fastly_tokens_list_tokens_customer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTokensListTokensCustomer',
    'type' => 'read',
    'name' => 'List tokens for a customer',
    'description' => 'List tokens for a customer',
    'icon' => 'ph:cloud',
  ),
  'fastly_tokens_list_tokens_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTokensListTokensUser',
    'type' => 'read',
    'name' => 'List tokens for the authenticated user',
    'description' => 'List tokens for the authenticated user',
    'icon' => 'ph:cloud',
  ),
  'fastly_tokens_revoke_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTokensRevokeToken',
    'type' => 'write',
    'name' => 'Revoke a token',
    'description' => 'Revoke a token',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_tokens_revoke_token_current' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyTokensRevokeTokenCurrent',
    'type' => 'write',
    'name' => 'Revoke the current token',
    'description' => 'Revoke the current token',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_user_create_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyUserCreateUser',
    'type' => 'write',
    'name' => 'Create a user',
    'description' => 'Create a user',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_user_delete_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyUserDeleteUser',
    'type' => 'write',
    'name' => 'Delete a user',
    'description' => 'Delete a user',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_user_get_current_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyUserGetCurrentUser',
    'type' => 'read',
    'name' => 'Get the current user',
    'description' => 'Get the current user',
    'icon' => 'ph:cloud',
  ),
  'fastly_user_get_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyUserGetUser',
    'type' => 'read',
    'name' => 'Get a user',
    'description' => 'Get a user',
    'icon' => 'ph:cloud',
  ),
  'fastly_user_request_password_reset' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyUserRequestPasswordReset',
    'type' => 'write',
    'name' => 'Request a password reset',
    'description' => 'Request a password reset',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_user_update_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyUserUpdateUser',
    'type' => 'write',
    'name' => 'Update a user',
    'description' => 'Update a user',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_user_update_user_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyUserUpdateUserPassword',
    'type' => 'write',
    'name' => 'Update the user\'s password',
    'description' => 'Update the user\'s password',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_vcl_create_custom_vcl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclCreateCustomVcl',
    'type' => 'write',
    'name' => 'Create a custom VCL file',
    'description' => 'Create a custom VCL file',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_vcl_delete_custom_vcl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclDeleteCustomVcl',
    'type' => 'write',
    'name' => 'Delete a custom VCL file',
    'description' => 'Delete a custom VCL file',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_vcl_diff_vcl_diff_service_versions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclDiffVclDiffServiceVersions',
    'type' => 'read',
    'name' => 'Get a comparison of the VCL changes between two service versions',
    'description' => 'Get a comparison of the VCL changes between two service versions',
    'icon' => 'ph:cloud',
  ),
  'fastly_vcl_get_custom_vcl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclGetCustomVcl',
    'type' => 'read',
    'name' => 'Get a custom VCL file',
    'description' => 'Get a custom VCL file',
    'icon' => 'ph:cloud',
  ),
  'fastly_vcl_get_custom_vcl_boilerplate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclGetCustomVclBoilerplate',
    'type' => 'read',
    'name' => 'Get boilerplate VCL',
    'description' => 'Get boilerplate VCL',
    'icon' => 'ph:cloud',
  ),
  'fastly_vcl_get_custom_vcl_generated' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclGetCustomVclGenerated',
    'type' => 'read',
    'name' => 'Get the generated VCL for a service',
    'description' => 'Get the generated VCL for a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_vcl_get_custom_vcl_generated_highlighted' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclGetCustomVclGeneratedHighlighted',
    'type' => 'read',
    'name' => 'Get the generated VCL with syntax highlighting',
    'description' => 'Get the generated VCL with syntax highlighting',
    'icon' => 'ph:cloud',
  ),
  'fastly_vcl_get_custom_vcl_highlighted' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclGetCustomVclHighlighted',
    'type' => 'read',
    'name' => 'Get a custom VCL file with syntax highlighting',
    'description' => 'Get a custom VCL file with syntax highlighting',
    'icon' => 'ph:cloud',
  ),
  'fastly_vcl_get_custom_vcl_raw' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclGetCustomVclRaw',
    'type' => 'read',
    'name' => 'Download a custom VCL file',
    'description' => 'Download a custom VCL file',
    'icon' => 'ph:cloud',
  ),
  'fastly_vcl_lint_vcl_default' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclLintVclDefault',
    'type' => 'write',
    'name' => 'Lint (validate) VCL using a default set of flags.',
    'description' => 'Lint (validate) VCL using a default set of flags.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_vcl_lint_vcl_for_service' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclLintVclForService',
    'type' => 'write',
    'name' => 'Lint (validate) VCL using flags set for the service.',
    'description' => 'Lint (validate) VCL using flags set for the service.',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_vcl_list_custom_vcl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclListCustomVcl',
    'type' => 'read',
    'name' => 'List custom VCL files',
    'description' => 'List custom VCL files',
    'icon' => 'ph:cloud',
  ),
  'fastly_vcl_set_custom_vcl_main' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclSetCustomVclMain',
    'type' => 'write',
    'name' => 'Set a custom VCL file as main',
    'description' => 'Set a custom VCL file as main',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_vcl_update_custom_vcl' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVclUpdateCustomVcl',
    'type' => 'write',
    'name' => 'Update a custom VCL file',
    'description' => 'Update a custom VCL file',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_activate_service_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionActivateServiceVersion',
    'type' => 'write',
    'name' => 'Activate a service version',
    'description' => 'Activate a service version',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_activate_service_version_environment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionActivateServiceVersionEnvironment',
    'type' => 'write',
    'name' => 'Activate a service version on the specified environment',
    'description' => 'Activate a service version on the specified environment',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_clone_service_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionCloneServiceVersion',
    'type' => 'write',
    'name' => 'Clone a service version',
    'description' => 'Clone a service version',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_create_service_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionCreateServiceVersion',
    'type' => 'write',
    'name' => 'Create a service version',
    'description' => 'Create a service version',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_deactivate_service_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionDeactivateServiceVersion',
    'type' => 'write',
    'name' => 'Deactivate a service version',
    'description' => 'Deactivate a service version',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_deactivate_service_version_environment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionDeactivateServiceVersionEnvironment',
    'type' => 'write',
    'name' => 'Deactivate a service version on an environment',
    'description' => 'Deactivate a service version on an environment',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_get_service_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionGetServiceVersion',
    'type' => 'read',
    'name' => 'Get a version of a service',
    'description' => 'Get a version of a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_version_list_service_versions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionListServiceVersions',
    'type' => 'read',
    'name' => 'List versions of a service',
    'description' => 'List versions of a service',
    'icon' => 'ph:cloud',
  ),
  'fastly_version_lock_service_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionLockServiceVersion',
    'type' => 'write',
    'name' => 'Lock a service version',
    'description' => 'Lock a service version',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_update_service_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionUpdateServiceVersion',
    'type' => 'write',
    'name' => 'Update a service version',
    'description' => 'Update a service version',
    'icon' => 'ph:pencil-simple',
  ),
  'fastly_version_validate_service_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyVersionValidateServiceVersion',
    'type' => 'read',
    'name' => 'Validate a service version',
    'description' => 'Validate a service version',
    'icon' => 'ph:cloud',
  ),
  'fastly_whole_platform_ddos_historical_get_platform_ddos_historical' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Fastly\\Tools\\FastlyWholePlatformDdosHistoricalGetPlatformDdosHistorical',
    'type' => 'read',
    'name' => 'Get historical DDoS metrics for the entire Fastly platform',
    'description' => 'Get historical DDoS metrics for the entire Fastly platform',
    'icon' => 'ph:cloud',
  ),
); } public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/fastly.md'; } public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Runtime context from the host. */ private function resolveService(array $context=[]): FastlyService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new FastlyService(apiToken:$creds->get('fastly','api_token','',$account), apiUrl:$creds->get('fastly','api_url','https://api.fastly.com',$account), rtUrl:$creds->get('fastly','rt_url','https://rt.fastly.com',$account));} return app(FastlyService::class); }
}
