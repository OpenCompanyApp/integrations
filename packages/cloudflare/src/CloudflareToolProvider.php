<?php

namespace OpenCompany\Integrations\Cloudflare;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareApiDelete;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareApiGet;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareApiPatch;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareApiPost;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareApiPut;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareCreateDnsRecord;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareCreateKvNamespace;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareCreatePageRule;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareCreateZone;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareCreateZoneRuleset;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareDeleteDnsRecord;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareDeleteKvNamespace;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareDeletePageRule;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareDeleteZone;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareDeleteZoneRuleset;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareEditZone;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareExportDnsRecords;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetAccount;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetAnalytics;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetCurrentUser;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetDnsRecord;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetDnsSettings;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetZone;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetZoneRuleset;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetZoneSetting;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareImportDnsRecords;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListAccountMembers;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListAccountRoles;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListAccountRulesets;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListAccounts;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListDnsRecords;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListKvKeys;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListKvNamespaces;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListPageRules;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListZoneRulesets;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListZones;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflarePatchDnsRecord;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflarePurgeCache;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareReviewDnsRecordScan;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareScanDnsRecords;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareUpdateDnsRecord;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareUpdateDnsSettings;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareUpdatePageRule;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareUpdateZoneRuleset;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareUpdateZoneSetting;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareVerifyToken;

/**
 * Tool catalog and setup metadata for the Cloudflare integration.
 *
 * Exposes first-class tools for common account, zone, DNS, cache, page rule,
 * ruleset, and Workers KV workflows, with raw API tools for the broader v4 API.
 */
class CloudflareToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Use a Cloudflare API token scoped to the resources the tools need.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'cloudflare';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Cloudflare',
            'description' => 'DNS, CDN, security, and edge platform management',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:cloudflare',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Cloudflare',
            'description' => 'Manage Cloudflare accounts, zones, DNS records, cache, rules, Workers KV, and long-tail API endpoints.',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:cloudflare',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.cloudflare.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Cloudflare API token',
                'hint' => 'Create an API token in the Cloudflare dashboard under My Profile > API Tokens.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cloudflare.com/client/v4',
                'hint' => 'Use the default Cloudflare API URL, or a custom endpoint if using a compatible API.',
                'default' => 'https://api.cloudflare.com/client/v4',
            ],
        ];
    }

    /**
     * Verify Cloudflare credentials with the token verification endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.cloudflare.com/client/v4'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/user/tokens/verify');

            $json = $response->json();
            if (!is_array($json)) {
                return ['success' => false, 'error' => "Could not reach Cloudflare API at {$baseUrl}."];
            }

            if (($json['success'] ?? false) === true) {
                $status = $json['result']['status'] ?? 'active';

                return ['success' => true, 'message' => "Connected to Cloudflare API; token status is {$status}."];
            }

            $errors = $json['errors'] ?? [];
            $messages = array_map(fn (array $error): string => $error['message'] ?? 'Unknown error', $errors);

            return ['success' => false, 'error' => implode('; ', $messages) ?: 'Authentication failed.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'cloudflare_api_get' => ['class' => CloudflareApiGet::class, 'type' => 'read', 'name' => 'API Get', 'description' => 'Execute a raw GET request against the Cloudflare API v4. Use relative paths such as `/zones/{zone_id}/settings`, and pass query parameters in `query`.', 'icon' => 'ph:cloud'],
            'cloudflare_api_post' => ['class' => CloudflareApiPost::class, 'type' => 'write', 'name' => 'API Post', 'description' => 'Execute a raw POST request against the Cloudflare API v4. Pass the JSON request body in `body`.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_api_patch' => ['class' => CloudflareApiPatch::class, 'type' => 'write', 'name' => 'API Patch', 'description' => 'Execute a raw PATCH request against the Cloudflare API v4. Pass the JSON request body in `body`.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_api_put' => ['class' => CloudflareApiPut::class, 'type' => 'write', 'name' => 'API Put', 'description' => 'Execute a raw PUT request against the Cloudflare API v4. Pass the JSON request body in `body`.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_api_delete' => ['class' => CloudflareApiDelete::class, 'type' => 'write', 'name' => 'API Delete', 'description' => 'Execute a raw DELETE request against the Cloudflare API v4. Pass an optional JSON request body in `body`.', 'icon' => 'ph:cloud-arrow-up'],

            'cloudflare_verify_token' => ['class' => CloudflareVerifyToken::class, 'type' => 'read', 'name' => 'Verify Token', 'description' => 'Verify the current Cloudflare API token and return token status metadata.', 'icon' => 'ph:cloud'],
            'cloudflare_get_current_user' => ['class' => CloudflareGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get details of the currently authenticated Cloudflare user. Returns user ID, email, username, and account info.', 'icon' => 'ph:cloud'],
            'cloudflare_list_accounts' => ['class' => CloudflareListAccounts::class, 'type' => 'read', 'name' => 'List Accounts', 'description' => 'List Cloudflare accounts visible to the authenticated API token.', 'icon' => 'ph:cloud'],
            'cloudflare_get_account' => ['class' => CloudflareGetAccount::class, 'type' => 'read', 'name' => 'Get Account', 'description' => 'Get a Cloudflare account by account_id.', 'icon' => 'ph:cloud'],
            'cloudflare_list_account_members' => ['class' => CloudflareListAccountMembers::class, 'type' => 'read', 'name' => 'List Account Members', 'description' => 'List members for a Cloudflare account.', 'icon' => 'ph:cloud'],
            'cloudflare_list_account_roles' => ['class' => CloudflareListAccountRoles::class, 'type' => 'read', 'name' => 'List Account Roles', 'description' => 'List roles available for a Cloudflare account.', 'icon' => 'ph:cloud'],

            'cloudflare_list_zones' => ['class' => CloudflareListZones::class, 'type' => 'read', 'name' => 'List Zones', 'description' => 'List all Cloudflare zones (domains). Returns zone IDs, names, status, and plan info. Use this to discover zone identifiers needed for DNS and analytics operations.', 'icon' => 'ph:cloud'],
            'cloudflare_create_zone' => ['class' => CloudflareCreateZone::class, 'type' => 'write', 'name' => 'Create Zone', 'description' => 'Create a Cloudflare zone. Requires name and account object or raw body matching Cloudflare zone create parameters.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_get_zone' => ['class' => CloudflareGetZone::class, 'type' => 'read', 'name' => 'Get Zone', 'description' => 'Get detailed information about a specific Cloudflare zone, including its ID, name, status, nameservers, and plan.', 'icon' => 'ph:cloud'],
            'cloudflare_edit_zone' => ['class' => CloudflareEditZone::class, 'type' => 'write', 'name' => 'Edit Zone', 'description' => 'Edit a Cloudflare zone with PATCH /zones/{zone_id}. Pass changed fields in body.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_delete_zone' => ['class' => CloudflareDeleteZone::class, 'type' => 'write', 'name' => 'Delete Zone', 'description' => 'Delete a Cloudflare zone by zone_id.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_get_zone_setting' => ['class' => CloudflareGetZoneSetting::class, 'type' => 'read', 'name' => 'Get Zone Setting', 'description' => 'Get one Cloudflare zone setting by setting_id, such as ssl, cache_level, or development_mode.', 'icon' => 'ph:cloud'],
            'cloudflare_update_zone_setting' => ['class' => CloudflareUpdateZoneSetting::class, 'type' => 'write', 'name' => 'Update Zone Setting', 'description' => 'Update one Cloudflare zone setting by setting_id. Provide value or raw body.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_purge_cache' => ['class' => CloudflarePurgeCache::class, 'type' => 'write', 'name' => 'Purge Cache', 'description' => 'Purge Cloudflare cache for a zone. Pass purge_everything=true or files/tags/hosts/prefixes in body.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_get_analytics' => ['class' => CloudflareGetAnalytics::class, 'type' => 'read', 'name' => 'Get Analytics', 'description' => 'Get analytics dashboard data for a Cloudflare zone. Returns HTTP requests, bandwidth, threats, and pageview metrics over a time range.', 'icon' => 'ph:cloud'],

            'cloudflare_list_dns_records' => ['class' => CloudflareListDnsRecords::class, 'type' => 'read', 'name' => 'List DNS Records', 'description' => 'List DNS records for a Cloudflare zone. Returns record IDs, types, names, content, TTL, and proxy status.', 'icon' => 'ph:cloud'],
            'cloudflare_create_dns_record' => ['class' => CloudflareCreateDnsRecord::class, 'type' => 'write', 'name' => 'Create DNS Record', 'description' => 'Create a new DNS record in a Cloudflare zone. Supports A, AAAA, CNAME, MX, TXT, NS, SRV, and other record types.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_get_dns_record' => ['class' => CloudflareGetDnsRecord::class, 'type' => 'read', 'name' => 'Get DNS Record', 'description' => 'Get one DNS record in a Cloudflare zone.', 'icon' => 'ph:cloud'],
            'cloudflare_update_dns_record' => ['class' => CloudflareUpdateDnsRecord::class, 'type' => 'write', 'name' => 'Update DNS Record', 'description' => 'Replace a DNS record using PUT. Provide type, name, content, and optional ttl/proxied or raw body.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_patch_dns_record' => ['class' => CloudflarePatchDnsRecord::class, 'type' => 'write', 'name' => 'Patch DNS Record', 'description' => 'Patch a DNS record using PATCH. Provide changed fields or raw body.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_delete_dns_record' => ['class' => CloudflareDeleteDnsRecord::class, 'type' => 'write', 'name' => 'Delete DNS Record', 'description' => 'Delete one DNS record from a Cloudflare zone.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_export_dns_records' => ['class' => CloudflareExportDnsRecords::class, 'type' => 'read', 'name' => 'Export DNS Records', 'description' => 'Export DNS records for a zone using Cloudflare DNS records export.', 'icon' => 'ph:cloud'],
            'cloudflare_import_dns_records' => ['class' => CloudflareImportDnsRecords::class, 'type' => 'write', 'name' => 'Import DNS Records', 'description' => 'Import DNS records for a zone. Pass the request body expected by Cloudflare.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_scan_dns_records' => ['class' => CloudflareScanDnsRecords::class, 'type' => 'write', 'name' => 'Scan DNS Records', 'description' => 'Start Cloudflare DNS record scan for a zone.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_review_dns_record_scan' => ['class' => CloudflareReviewDnsRecordScan::class, 'type' => 'write', 'name' => 'Review DNS Record Scan', 'description' => 'Review DNS records discovered by Cloudflare DNS scan.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_get_dns_settings' => ['class' => CloudflareGetDnsSettings::class, 'type' => 'read', 'name' => 'Get DNS Settings', 'description' => 'Get DNS settings for a Cloudflare zone.', 'icon' => 'ph:cloud'],
            'cloudflare_update_dns_settings' => ['class' => CloudflareUpdateDnsSettings::class, 'type' => 'write', 'name' => 'Update DNS Settings', 'description' => 'Update DNS settings for a Cloudflare zone. Pass changed DNS setting fields in body.', 'icon' => 'ph:cloud-arrow-up'],

            'cloudflare_list_page_rules' => ['class' => CloudflareListPageRules::class, 'type' => 'read', 'name' => 'List Page Rules', 'description' => 'List page rules for a Cloudflare zone. Returns rule IDs, targets, actions, and priority.', 'icon' => 'ph:cloud'],
            'cloudflare_create_page_rule' => ['class' => CloudflareCreatePageRule::class, 'type' => 'write', 'name' => 'Create Page Rule', 'description' => 'Create a Cloudflare page rule for a zone. Pass targets/actions/priority/status in body or first-class fields.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_update_page_rule' => ['class' => CloudflareUpdatePageRule::class, 'type' => 'write', 'name' => 'Update Page Rule', 'description' => 'Update a Cloudflare page rule. Pass changed fields in body or first-class fields.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_delete_page_rule' => ['class' => CloudflareDeletePageRule::class, 'type' => 'write', 'name' => 'Delete Page Rule', 'description' => 'Delete a Cloudflare page rule.', 'icon' => 'ph:cloud-arrow-up'],

            'cloudflare_list_zone_rulesets' => ['class' => CloudflareListZoneRulesets::class, 'type' => 'read', 'name' => 'List Zone Rulesets', 'description' => 'List Ruleset Engine rulesets for a Cloudflare zone.', 'icon' => 'ph:cloud'],
            'cloudflare_get_zone_ruleset' => ['class' => CloudflareGetZoneRuleset::class, 'type' => 'read', 'name' => 'Get Zone Ruleset', 'description' => 'Get one Cloudflare zone ruleset.', 'icon' => 'ph:cloud'],
            'cloudflare_create_zone_ruleset' => ['class' => CloudflareCreateZoneRuleset::class, 'type' => 'write', 'name' => 'Create Zone Ruleset', 'description' => 'Create a Cloudflare zone ruleset. Pass name, kind, phase, rules, and optional description or raw body.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_update_zone_ruleset' => ['class' => CloudflareUpdateZoneRuleset::class, 'type' => 'write', 'name' => 'Update Zone Ruleset', 'description' => 'Update a Cloudflare zone ruleset by ruleset_id.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_delete_zone_ruleset' => ['class' => CloudflareDeleteZoneRuleset::class, 'type' => 'write', 'name' => 'Delete Zone Ruleset', 'description' => 'Delete a Cloudflare zone ruleset.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_list_account_rulesets' => ['class' => CloudflareListAccountRulesets::class, 'type' => 'read', 'name' => 'List Account Rulesets', 'description' => 'List Ruleset Engine rulesets for a Cloudflare account.', 'icon' => 'ph:cloud'],

            'cloudflare_list_kv_namespaces' => ['class' => CloudflareListKvNamespaces::class, 'type' => 'read', 'name' => 'List KV Namespaces', 'description' => 'List Workers KV namespaces for a Cloudflare account.', 'icon' => 'ph:cloud'],
            'cloudflare_create_kv_namespace' => ['class' => CloudflareCreateKvNamespace::class, 'type' => 'write', 'name' => 'Create KV Namespace', 'description' => 'Create a Workers KV namespace for a Cloudflare account.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_delete_kv_namespace' => ['class' => CloudflareDeleteKvNamespace::class, 'type' => 'write', 'name' => 'Delete KV Namespace', 'description' => 'Delete a Workers KV namespace.', 'icon' => 'ph:cloud-arrow-up'],
            'cloudflare_list_kv_keys' => ['class' => CloudflareListKvKeys::class, 'type' => 'read', 'name' => 'List KV Keys', 'description' => 'List keys in a Workers KV namespace.', 'icon' => 'ph:cloud'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/cloudflare.md';
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Cloudflare tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional multi-account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): CloudflareService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CloudflareService(
                accessToken: $creds->get('cloudflare', 'access_token', '', $account),
                baseUrl: $creds->get('cloudflare', 'url', 'https://api.cloudflare.com/client/v4', $account),
            );
        }

        return app(CloudflareService::class);
    }
}
