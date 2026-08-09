<?php

namespace OpenCompany\Integrations\ModernTreasury;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Modern Treasury.
 *
 * Exposes the official OpenAPI operation set as endpoint-specific agent tools
 * and resolves account-specific credentials in multi-account hosts.
 */
class ModernTreasuryToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'basic','legacy_auth_type'=>'api_key','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['organization_id','api_key'],'notes'=>['Uses Basic auth with organization_id as username and api_key as password.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'modern-treasury'; } public function appMeta(): array { return ['label'=>'Modern Treasury','description'=>'Payment operations, ledgers, counterparties, accounts, and money movement','icon'=>'ph:bank','logo'=>'ph:bank']; }
    public function integrationMeta(): array { return ['name'=>'Modern Treasury','description'=>'Manage Modern Treasury ledgers, ledger accounts, transactions, payments, counterparties, accounts, returns, reconciliations, and events.','icon'=>'ph:bank','logo'=>'ph:bank','category'=>'data','badge'=>'verified','docs_url'=>'https://docs.moderntreasury.com/platform/docs/openapi-specification']; }
    public function configSchema(): array { return [['key'=>'organization_id','type'=>'text','label'=>'Organization ID','placeholder'=>'Modern Treasury organization ID','required'=>true],['key'=>'api_key','type'=>'secret','label'=>'API Key','placeholder'=>'Modern Treasury API key','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://app.moderntreasury.com','default'=>'https://app.moderntreasury.com']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $org=(string)($config['organization_id']??''); $key=(string)($config['api_key']??''); $baseUrl=rtrim((string)($config['url']??'https://app.moderntreasury.com'),'/'); if($org===''||$key==='')return ['success'=>false,'error'=>'Modern Treasury organization ID and API key are required.']; try{$response=Http::withHeaders(['Authorization'=>'Basic '.base64_encode($org.':'.$key),'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/api/api_keys/current'); if(!$response->successful())return ['success'=>false,'error'=>'Modern Treasury API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Modern Treasury at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['organization_id'=>'required|string','api_key'=>'required|string','url'=>'nullable|url']; } public function credentialFields(): array { return [['key'=>'organization_id','type'=>'text','label'=>'Organization ID','required'=>true],['key'=>'api_key','type'=>'secret','label'=>'API Key','required'=>true]]; }
    public function tools(): array { return [
  'modern_treasury_list_ledger_account_balance_monitors' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgerAccountBalanceMonitors',
    'type' => 'read',
    'name' => 'list ledger_account_balance_monitors',
    'description' => 'Get a list of ledger account balance monitors.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_ledger_account_balance_monitor' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedgerAccountBalanceMonitor',
    'type' => 'write',
    'name' => 'create ledger_account_balance_monitor',
    'description' => 'Create a ledger account balance monitor.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_ledger_account_balance_monitor' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLedgerAccountBalanceMonitor',
    'type' => 'read',
    'name' => 'get ledger_account_balance_monitor',
    'description' => 'Get details on a single ledger account balance monitor.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_ledger_account_balance_monitor' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLedgerAccountBalanceMonitor',
    'type' => 'write',
    'name' => 'update ledger_account_balance_monitor',
    'description' => 'Update a ledger account balance monitor.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_ledger_account_balance_monitor' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteLedgerAccountBalanceMonitor',
    'type' => 'write',
    'name' => 'delete ledger_account_balance_monitor',
    'description' => 'Delete a ledger account balance monitor.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_ledger_account_categories' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgerAccountCategories',
    'type' => 'read',
    'name' => 'list ledger_account_categories',
    'description' => 'Get a list of ledger account categories.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_ledger_account_category' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedgerAccountCategory',
    'type' => 'write',
    'name' => 'create ledger_account_category',
    'description' => 'Create a ledger account category.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_ledger_account_category' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLedgerAccountCategory',
    'type' => 'read',
    'name' => 'get ledger_account_category',
    'description' => 'Get the details on a single ledger account category.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_ledger_account_category' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLedgerAccountCategory',
    'type' => 'write',
    'name' => 'update ledger_account_category',
    'description' => 'Update the details of a ledger account category.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_ledger_account_category' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteLedgerAccountCategory',
    'type' => 'write',
    'name' => 'delete ledger_account_category',
    'description' => 'Delete a ledger account category.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_add_ledger_account_to_ledger_account_category' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryAddLedgerAccountToLedgerAccountCategory',
    'type' => 'write',
    'name' => 'add ledger_account to ledger_account_category',
    'description' => 'Add a ledger account to a ledger account category.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_remove_ledger_account_from_ledger_account_category' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryRemoveLedgerAccountFromLedgerAccountCategory',
    'type' => 'write',
    'name' => 'remove ledger_account from ledger_account_category',
    'description' => 'Remove a ledger account from a ledger account category.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_add_ledger_account_category_to_ledger_account_category' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryAddLedgerAccountCategoryToLedgerAccountCategory',
    'type' => 'write',
    'name' => 'add ledger_account_category to ledger_account_category',
    'description' => 'Add a ledger account category to a ledger account category.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_ledger_account_category_from_ledger_account_category' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteLedgerAccountCategoryFromLedgerAccountCategory',
    'type' => 'write',
    'name' => 'delete ledger_account_category from ledger_account_category',
    'description' => 'Delete a ledger account category from a ledger account category.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_patch_ledger_account_settlement_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryPatchLedgerAccountSettlementEntries',
    'type' => 'write',
    'name' => 'patch ledger_account_settlement_entries',
    'description' => 'Add ledger entries to a draft ledger account settlement.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_ledger_account_settlement_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteLedgerAccountSettlementEntries',
    'type' => 'write',
    'name' => 'delete ledger_account_settlement_entries',
    'description' => 'Remove ledger entries from a draft ledger account settlement.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_create_ledger_account_settlement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedgerAccountSettlement',
    'type' => 'write',
    'name' => 'create ledger_account_settlement',
    'description' => 'Create a ledger account settlement.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_ledger_account_settlements' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgerAccountSettlements',
    'type' => 'read',
    'name' => 'list ledger_account_settlements',
    'description' => 'Get a list of ledger account settlements.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_ledger_account_settlement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLedgerAccountSettlement',
    'type' => 'read',
    'name' => 'get ledger_account_settlement',
    'description' => 'Get details on a single ledger account settlement.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_ledger_account_settlement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLedgerAccountSettlement',
    'type' => 'write',
    'name' => 'update ledger_account_settlement',
    'description' => 'Update the details of a ledger account settlement.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_create_ledger_account_statement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedgerAccountStatement',
    'type' => 'write',
    'name' => 'create ledger_account_statement',
    'description' => 'Create a ledger account statement.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_ledger_account_statement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLedgerAccountStatement',
    'type' => 'read',
    'name' => 'get ledger_account_statement',
    'description' => 'Get details on a single ledger account statement.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_ledger_accounts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgerAccounts',
    'type' => 'read',
    'name' => 'list ledger_accounts',
    'description' => 'Get a list of ledger accounts.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_ledger_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedgerAccount',
    'type' => 'write',
    'name' => 'create ledger_account',
    'description' => 'Create a ledger account.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_ledger_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLedgerAccount',
    'type' => 'read',
    'name' => 'get ledger_account',
    'description' => 'Get details on a single ledger account.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_ledger_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLedgerAccount',
    'type' => 'write',
    'name' => 'update ledger_account',
    'description' => 'Update the details of a ledger account.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_ledger_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteLedgerAccount',
    'type' => 'write',
    'name' => 'delete ledger_account',
    'description' => 'Delete a ledger account.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_ledger_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgerEntries',
    'type' => 'read',
    'name' => 'list ledger_entries',
    'description' => 'Get a list of all ledger entries.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_ledger_entry' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLedgerEntry',
    'type' => 'write',
    'name' => 'update ledger_entry',
    'description' => 'Update the details of a ledger entry.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_ledger_entry' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLedgerEntry',
    'type' => 'read',
    'name' => 'get ledger_entry',
    'description' => 'Get details on a single ledger entry.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_ledger_transaction_partial_post' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedgerTransactionPartialPost',
    'type' => 'write',
    'name' => 'create ledger_transaction partial post',
    'description' => 'Create a ledger transaction that partially posts another ledger transaction.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_create_ledger_transaction_reversal' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedgerTransactionReversal',
    'type' => 'write',
    'name' => 'create ledger_transaction reversal',
    'description' => 'Create a ledger transaction reversal.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_ledger_transaction_versions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgerTransactionVersions',
    'type' => 'read',
    'name' => 'list ledger_transaction_versions',
    'description' => 'Get a list of ledger transaction versions.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_ledger_transactions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgerTransactions',
    'type' => 'read',
    'name' => 'list ledger_transactions',
    'description' => 'Get a list of ledger transactions.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_ledger_transaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedgerTransaction',
    'type' => 'write',
    'name' => 'create ledger_transaction',
    'description' => 'Create a ledger transaction.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_ledger_transaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLedgerTransaction',
    'type' => 'read',
    'name' => 'get ledger_transaction',
    'description' => 'Get details on a single ledger transaction.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_ledger_transaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLedgerTransaction',
    'type' => 'write',
    'name' => 'update ledger_transaction',
    'description' => 'Update the details of a ledger transaction.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_ledger_transaction_versions_nested' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgerTransactionVersionsNested',
    'type' => 'read',
    'name' => 'list ledger_transaction versions',
    'description' => 'Get a list of ledger transaction versions.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_ledgers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLedgers',
    'type' => 'read',
    'name' => 'list ledgers',
    'description' => 'Get a list of ledgers.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_ledger' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLedger',
    'type' => 'write',
    'name' => 'create ledger',
    'description' => 'Create a ledger.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_ledger' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLedger',
    'type' => 'read',
    'name' => 'get ledger',
    'description' => 'Get details on a single ledger.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_ledger' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLedger',
    'type' => 'write',
    'name' => 'update ledger',
    'description' => 'Update the details of a ledger.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_ledger' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteLedger',
    'type' => 'write',
    'name' => 'delete ledger',
    'description' => 'Delete a ledger.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_connection_legal_entities' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListConnectionLegalEntities',
    'type' => 'read',
    'name' => 'list connection_legal_entities',
    'description' => 'Get a list of all connection legal entities.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_connection_legal_entity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateConnectionLegalEntity',
    'type' => 'write',
    'name' => 'create connection_legal_entity',
    'description' => 'Create a connection legal entity.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_connection_legal_entity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetConnectionLegalEntity',
    'type' => 'read',
    'name' => 'get connection_legal_entity',
    'description' => 'Get details on a single connection legal entity.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_connection_legal_entity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateConnectionLegalEntity',
    'type' => 'write',
    'name' => 'update connection_legal_entity',
    'description' => 'Update a connection legal entity.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_connections' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListConnections',
    'type' => 'read',
    'name' => 'list connections',
    'description' => 'Get a list of all connections.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_legal_entities' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLegalEntities',
    'type' => 'read',
    'name' => 'list legal_entities',
    'description' => 'Get a list of all legal entities.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_legal_entity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateLegalEntity',
    'type' => 'write',
    'name' => 'create legal_entity',
    'description' => 'create legal_entity',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_legal_entity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLegalEntity',
    'type' => 'read',
    'name' => 'get legal_entity',
    'description' => 'Get details on a single legal entity.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_legal_entity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLegalEntity',
    'type' => 'write',
    'name' => 'update legal entity',
    'description' => 'Update a legal entity.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_journal_entries' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListJournalEntries',
    'type' => 'read',
    'name' => 'list journal_entries',
    'description' => 'Retrieve a list of journal entries',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_journal_entry' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetJournalEntry',
    'type' => 'read',
    'name' => 'show journal_entry',
    'description' => 'Retrieve a specific journal entry',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_journal_reports' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListJournalReports',
    'type' => 'read',
    'name' => 'list journal_reports',
    'description' => 'Retrieve a list of journal reports',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_journal_report' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetJournalReport',
    'type' => 'read',
    'name' => 'show journal_report',
    'description' => 'Retrieve a specific journal report',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_journal_report' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateJournalReport',
    'type' => 'write',
    'name' => 'update journal_report',
    'description' => 'Update a journal report',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_journal_sources' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListJournalSources',
    'type' => 'read',
    'name' => 'list journal_sources',
    'description' => 'Retrieve a list of journal sources',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_journal_source' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetJournalSource',
    'type' => 'read',
    'name' => 'show journal_source',
    'description' => 'Retrieve a specific journal source',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_account_capability' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateAccountCapability',
    'type' => 'write',
    'name' => 'update account_capability',
    'description' => 'update account_capability',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_account_details' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListAccountDetails',
    'type' => 'read',
    'name' => 'list account_details',
    'description' => 'Get a list of account details for a single internal or external account.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_account_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateAccountDetail',
    'type' => 'write',
    'name' => 'create account_detail',
    'description' => 'Create an account detail for an external account.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_account_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetAccountDetail',
    'type' => 'read',
    'name' => 'get account_detail',
    'description' => 'Get a single account detail for a single internal or external account.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_delete_account_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteAccountDetail',
    'type' => 'write',
    'name' => 'delete account_detail',
    'description' => 'Delete a single account detail for an external account.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_balance_reports' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListBalanceReports',
    'type' => 'read',
    'name' => 'list balance_reports',
    'description' => 'Get all balance reports for a given internal account.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_balance_report' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateBalanceReport',
    'type' => 'write',
    'name' => 'create balance reports',
    'description' => 'create balance reports',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_balance_report' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetBalanceReport',
    'type' => 'read',
    'name' => 'get balance_report',
    'description' => 'Get a single balance report for a given internal account.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_delete_balance_report' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteBalanceReport',
    'type' => 'write',
    'name' => 'delete balance_report',
    'description' => 'Deletes a given balance report.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_bulk_requests' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListBulkRequests',
    'type' => 'write',
    'name' => 'list bulk_requests',
    'description' => 'list bulk_requests',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_create_bulk_request' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateBulkRequest',
    'type' => 'write',
    'name' => 'create bulk_request',
    'description' => 'create bulk_request',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_bulk_request' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetBulkRequest',
    'type' => 'write',
    'name' => 'get bulk_request',
    'description' => 'get bulk_request',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_bulk_results' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListBulkResults',
    'type' => 'write',
    'name' => 'list bulk_results',
    'description' => 'list bulk_results',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_bulk_result' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetBulkResult',
    'type' => 'write',
    'name' => 'get bulk_result',
    'description' => 'get bulk_result',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_collect_account_details' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCollectAccountDetails',
    'type' => 'write',
    'name' => 'collect account details',
    'description' => 'Send an email requesting account details.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_counterparties' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListCounterparties',
    'type' => 'read',
    'name' => 'list counterparties',
    'description' => 'Get a paginated list of all counterparties.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_counterparty' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateCounterparty',
    'type' => 'write',
    'name' => 'create counterparty',
    'description' => 'Create a new counterparty.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_counterparty' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetCounterparty',
    'type' => 'read',
    'name' => 'show counterparty',
    'description' => 'Get details on a single counterparty.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_counterparty' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateCounterparty',
    'type' => 'write',
    'name' => 'update counterparty',
    'description' => 'Updates a given counterparty with new information.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_counterparty' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteCounterparty',
    'type' => 'write',
    'name' => 'delete counterparty',
    'description' => 'Deletes a given counterparty.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_documents' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListDocuments',
    'type' => 'read',
    'name' => 'list documents',
    'description' => 'Get a list of documents.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateDocument',
    'type' => 'write',
    'name' => 'create document',
    'description' => 'Create a document.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_documents_nested' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListDocumentsNested',
    'type' => 'read',
    'name' => 'list documents - nested path (legacy)',
    'description' => 'Get a list of documents.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_document_nested' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateDocumentNested',
    'type' => 'write',
    'name' => 'create document - nested path (legacy)',
    'description' => 'Create a document.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_document_nested' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetDocumentNested',
    'type' => 'read',
    'name' => 'get document - nested path (legacy)',
    'description' => 'Get an existing document.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetDocument',
    'type' => 'read',
    'name' => 'get document',
    'description' => 'Get an existing document.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_download_document_nested' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDownloadDocumentNested',
    'type' => 'write',
    'name' => 'download document - nested path (legacy)',
    'description' => 'Download an existing document.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_download_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDownloadDocument',
    'type' => 'write',
    'name' => 'download document',
    'description' => 'Download an existing document.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListEvents',
    'type' => 'read',
    'name' => 'list events',
    'description' => 'list events',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_event' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetEvent',
    'type' => 'read',
    'name' => 'get event',
    'description' => 'get event',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_expected_payments' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListExpectedPayments',
    'type' => 'read',
    'name' => 'list expected_payments',
    'description' => 'list expected_payments',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_expected_payment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateExpectedPayment',
    'type' => 'write',
    'name' => 'create expected payment',
    'description' => 'create expected payment',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_expected_payment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetExpectedPayment',
    'type' => 'read',
    'name' => 'get expected payment',
    'description' => 'get expected payment',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_expected_payment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateExpectedPayment',
    'type' => 'write',
    'name' => 'update expected payment',
    'description' => 'update expected payment',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_expected_payment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteExpectedPayment',
    'type' => 'write',
    'name' => 'delete expected payment',
    'description' => 'delete expected payment',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_verify_external_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryVerifyExternalAccount',
    'type' => 'write',
    'name' => 'verify external account',
    'description' => 'verify external account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_complete_verification_external_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCompleteVerificationExternalAccount',
    'type' => 'write',
    'name' => 'complete verification of external account',
    'description' => 'complete verification of external account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_external_accounts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListExternalAccounts',
    'type' => 'read',
    'name' => 'list external accounts',
    'description' => 'list external accounts',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_external_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateExternalAccount',
    'type' => 'write',
    'name' => 'create external account',
    'description' => 'create external account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_external_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetExternalAccount',
    'type' => 'read',
    'name' => 'show external account',
    'description' => 'show external account',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_external_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateExternalAccount',
    'type' => 'write',
    'name' => 'update external account',
    'description' => 'update external account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_external_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteExternalAccount',
    'type' => 'write',
    'name' => 'delete external account',
    'description' => 'delete external account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_quotes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListQuotes',
    'type' => 'read',
    'name' => 'list foreign_exchange_quotes',
    'description' => 'list foreign_exchange_quotes',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_quote' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateQuote',
    'type' => 'write',
    'name' => 'create foreign_exchange_quote',
    'description' => 'create foreign_exchange_quote',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_quote' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetQuote',
    'type' => 'read',
    'name' => 'get foreign_exchange_quote',
    'description' => 'get foreign_exchange_quote',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_holds' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListHolds',
    'type' => 'read',
    'name' => 'list holds',
    'description' => 'Get a list of holds.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_hold' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateHold',
    'type' => 'write',
    'name' => 'create hold',
    'description' => 'Create a new hold',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_show_hold' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryShowHold',
    'type' => 'read',
    'name' => 'show hold',
    'description' => 'Get a specific hold',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_hold' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateHold',
    'type' => 'write',
    'name' => 'update hold',
    'description' => 'Update a hold',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_incoming_payment_details' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListIncomingPaymentDetails',
    'type' => 'read',
    'name' => 'list incoming payment_details',
    'description' => 'Get a list of Incoming Payment Details.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_incoming_payment_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetIncomingPaymentDetail',
    'type' => 'read',
    'name' => 'get incoming payment detail',
    'description' => 'Get an existing Incoming Payment Detail.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_incoming_payment_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateIncomingPaymentDetail',
    'type' => 'write',
    'name' => 'update incoming payment detail',
    'description' => 'Update an existing Incoming Payment Detail.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_internal_accounts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListInternalAccounts',
    'type' => 'read',
    'name' => 'list internal accounts',
    'description' => 'list internal accounts',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_internal_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateInternalAccount',
    'type' => 'write',
    'name' => 'create internal account',
    'description' => 'create internal account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_internal_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetInternalAccount',
    'type' => 'read',
    'name' => 'get internal account',
    'description' => 'get internal account',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_internal_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateInternalAccount',
    'type' => 'write',
    'name' => 'update internal account',
    'description' => 'update internal account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_request_internal_account_closure' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryRequestInternalAccountClosure',
    'type' => 'write',
    'name' => 'request closure of internal account',
    'description' => 'request closure of internal account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_invoice_line_items' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListInvoiceLineItems',
    'type' => 'read',
    'name' => 'list invoice_line_items',
    'description' => 'list invoice_line_items',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_invoice_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateInvoiceLineItem',
    'type' => 'write',
    'name' => 'create invoice_line_item',
    'description' => 'create invoice_line_item',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_invoice_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetInvoiceLineItem',
    'type' => 'read',
    'name' => 'get invoice_line_item',
    'description' => 'get invoice_line_item',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_invoice_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateInvoiceLineItem',
    'type' => 'write',
    'name' => 'update invoice_line_item',
    'description' => 'update invoice_line_item',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_invoice_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteInvoiceLineItem',
    'type' => 'write',
    'name' => 'delete invoice_line_item',
    'description' => 'delete invoice_line_item',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_invoices' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListInvoices',
    'type' => 'read',
    'name' => 'list invoices',
    'description' => 'list invoices',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_invoice' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateInvoice',
    'type' => 'write',
    'name' => 'create invoice',
    'description' => 'create invoice',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_add_payment_order_to_invoice' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryAddPaymentOrderToInvoice',
    'type' => 'write',
    'name' => 'add payment_order_id to invoice',
    'description' => 'Add a payment order to an invoice.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_invoice' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetInvoice',
    'type' => 'read',
    'name' => 'get invoice',
    'description' => 'get invoice',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_invoice' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateInvoice',
    'type' => 'write',
    'name' => 'update invoice',
    'description' => 'update invoice',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_line_items' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListLineItems',
    'type' => 'read',
    'name' => 'list line items',
    'description' => 'Get a list of line items',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetLineItem',
    'type' => 'read',
    'name' => 'get line item',
    'description' => 'Get a single line item',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLineItem',
    'type' => 'write',
    'name' => 'update line item',
    'description' => 'update line item',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_payment_actions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListPaymentActions',
    'type' => 'read',
    'name' => 'list payment_actions',
    'description' => 'Get a list of all payment actions.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_payment_action' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreatePaymentAction',
    'type' => 'write',
    'name' => 'create payment_action',
    'description' => 'Create a payment action.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_payment_action' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetPaymentAction',
    'type' => 'read',
    'name' => 'get payment_action',
    'description' => 'Get details on a single payment action.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_payment_action' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdatePaymentAction',
    'type' => 'write',
    'name' => 'update payment_action',
    'description' => 'Update a single payment action.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_create_async_payment_order' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateAsyncPaymentOrder',
    'type' => 'write',
    'name' => 'create async payment order',
    'description' => 'Create a new payment order asynchronously',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_payment_orders' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListPaymentOrders',
    'type' => 'read',
    'name' => 'list payment orders',
    'description' => 'Get a list of all payment orders',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_payment_order' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreatePaymentOrder',
    'type' => 'write',
    'name' => 'create payment order',
    'description' => 'Create a new Payment Order',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_payment_order' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetPaymentOrder',
    'type' => 'read',
    'name' => 'get payment order',
    'description' => 'Get details on a single payment order',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_payment_order' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdatePaymentOrder',
    'type' => 'write',
    'name' => 'update payment order',
    'description' => 'Update a payment order',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_payment_references' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListPaymentReferences',
    'type' => 'read',
    'name' => 'list payment_references',
    'description' => 'list payment_references',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_get_payment_reference' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetPaymentReference',
    'type' => 'read',
    'name' => 'get payment_reference',
    'description' => 'get payment_reference',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_ping_api' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryPingAPI',
    'type' => 'read',
    'name' => 'ping api',
    'description' => 'A test endpoint often used to confirm credentials and headers are being passed in correctly.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_returns' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListReturns',
    'type' => 'read',
    'name' => 'list returns',
    'description' => 'Get a list of returns.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_return' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateReturn',
    'type' => 'write',
    'name' => 'create return',
    'description' => 'Create a return.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_return' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetReturn',
    'type' => 'read',
    'name' => 'show return',
    'description' => 'Get a single return.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_reversals' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListReversals',
    'type' => 'read',
    'name' => 'list reversals',
    'description' => 'Get a list of all reversals of a payment order.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_reversal' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateReversal',
    'type' => 'write',
    'name' => 'create reversal',
    'description' => 'Create a reversal for a payment order.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_reversal' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetReversal',
    'type' => 'read',
    'name' => 'show reversal',
    'description' => 'Get details on a single reversal of a payment order.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_routing_details' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListRoutingDetails',
    'type' => 'read',
    'name' => 'list routing_details',
    'description' => 'Get a list of routing details for a single internal or external account.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_routing_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateRoutingDetail',
    'type' => 'write',
    'name' => 'create routing_detail',
    'description' => 'Create a routing detail for a single external account.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_routing_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetRoutingDetail',
    'type' => 'read',
    'name' => 'get routing_detail',
    'description' => 'Get a single routing detail for a single internal or external account.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_delete_routing_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteRoutingDetail',
    'type' => 'write',
    'name' => 'delete routing_detail',
    'description' => 'Delete a routing detail for a single external account.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_create_async_incoming_payment_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateAsyncIncomingPaymentDetail',
    'type' => 'write',
    'name' => 'create async incoming payment detail',
    'description' => 'Simulate Incoming Payment Detail',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_update_legal_entity_status' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateLegalEntityStatus',
    'type' => 'write',
    'name' => 'update legal entity status',
    'description' => 'Update Legal Entity Status (sandbox only)',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_transaction_line_items_nested' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListTransactionLineItemsNested',
    'type' => 'read',
    'name' => 'list transaction_line_items',
    'description' => 'This endpoint has been deprecated in favor of /api/transaction_line_items',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_list_transaction_line_items' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListTransactionLineItems',
    'type' => 'read',
    'name' => 'list transaction_line_items',
    'description' => 'list transaction_line_items',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_transaction_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateTransactionLineItem',
    'type' => 'write',
    'name' => 'create transaction line items',
    'description' => 'create transaction line items',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_transaction_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListTransactionLineItem',
    'type' => 'read',
    'name' => 'get transaction line item',
    'description' => 'get transaction line item',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_delete_transaction_line_item' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteTransactionLineItem',
    'type' => 'write',
    'name' => 'delete transaction line item',
    'description' => 'delete transaction line item',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_transactions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListTransactions',
    'type' => 'read',
    'name' => 'list transactions',
    'description' => 'Get a list of all transactions.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_transaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateTransaction',
    'type' => 'write',
    'name' => 'create transaction',
    'description' => 'create transaction',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_transaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetTransaction',
    'type' => 'read',
    'name' => 'get transaction',
    'description' => 'Get details on a single transaction.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_transaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateTransaction',
    'type' => 'write',
    'name' => 'update transaction',
    'description' => 'Update a single transaction.',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_transaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteTransaction',
    'type' => 'write',
    'name' => 'delete transaction',
    'description' => 'delete transaction',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_validate_routing_number' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryValidateRoutingNumber',
    'type' => 'write',
    'name' => 'validate routing numbers',
    'description' => 'Validates the routing number information supplied without creating a routing detail',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_virtual_accounts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListVirtualAccounts',
    'type' => 'read',
    'name' => 'list virtual_accounts',
    'description' => 'Get a list of virtual accounts.',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_virtual_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateVirtualAccount',
    'type' => 'write',
    'name' => 'create virtual_account',
    'description' => 'create virtual_account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_virtual_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetVirtualAccount',
    'type' => 'read',
    'name' => 'get virtual_account',
    'description' => 'get virtual_account',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_virtual_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateVirtualAccount',
    'type' => 'write',
    'name' => 'update virtual_account',
    'description' => 'update virtual_account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_delete_virtual_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryDeleteVirtualAccount',
    'type' => 'write',
    'name' => 'delete virtual_account',
    'description' => 'delete virtual_account',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_account_collection_flows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListAccountCollectionFlows',
    'type' => 'read',
    'name' => 'list account_collection_flows',
    'description' => 'list account_collection_flows',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_account_collection_flow' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreateAccountCollectionFlow',
    'type' => 'write',
    'name' => 'create account_collection_flow',
    'description' => 'create account_collection_flow',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_account_collection_flow' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetAccountCollectionFlow',
    'type' => 'read',
    'name' => 'get account_collection_flow',
    'description' => 'get account_collection_flow',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_account_collection_flow' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdateAccountCollectionFlow',
    'type' => 'write',
    'name' => 'update account_collection_flow',
    'description' => 'update account_collection_flow',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_list_payment_flows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryListPaymentFlows',
    'type' => 'read',
    'name' => 'list payment_flows',
    'description' => 'list payment_flows',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_create_payment_flow' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryCreatePaymentFlow',
    'type' => 'write',
    'name' => 'create payment_flow',
    'description' => 'create payment_flow',
    'icon' => 'ph:pencil-simple',
  ),
  'modern_treasury_get_payment_flow' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryGetPaymentFlow',
    'type' => 'read',
    'name' => 'get payment_flow',
    'description' => 'get payment_flow',
    'icon' => 'ph:bank',
  ),
  'modern_treasury_update_payment_flow' =>
  array (
    'class' => 'OpenCompany\\Integrations\\ModernTreasury\\Tools\\ModernTreasuryUpdatePaymentFlow',
    'type' => 'write',
    'name' => 'update payment_flow',
    'description' => 'update payment_flow',
    'icon' => 'ph:pencil-simple',
  ),
]; }
    public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); } public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/modern-treasury.md'; }
    /** @param  array<string, mixed>  $context  Optional account context from the host. */ private function resolveService(array $context = []): ModernTreasuryService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new ModernTreasuryService(organizationId:$creds->get('modern-treasury','organization_id','',$account) ?: $creds->get('modern_treasury','organization_id','',$account), apiKey:$creds->get('modern-treasury','api_key','',$account) ?: $creds->get('modern_treasury','api_key','',$account), baseUrl:$creds->get('modern-treasury','url','',$account) ?: $creds->get('modern_treasury','url','https://app.moderntreasury.com',$account));} return app(ModernTreasuryService::class); }
}
