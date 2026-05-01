<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleAds\GoogleAdsService;
use OpenCompany\Integrations\GoogleAds\Support\GoogleAdsIdentifierHasher;

/**
 * Shared implementation for Google Ads tools.
 *
 * Centralizes common parameter definitions, confirmation guards, GAQL builders,
 * and mutation helpers so the concrete tool classes stay small and consistent.
 */
abstract class GoogleAdsTool implements Tool
{
    protected const ACTION = '';
    protected const NAME = '';
    protected const DESCRIPTION = '';

    /**
     * @param  GoogleAdsService  $service  The Google Ads API client
     */
    public function __construct(
        protected GoogleAdsService $service,
    ) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return match (static::ACTION) {
            'diagnostics', 'list_accessible_customers' => [],
            'list_customer_clients' => $this->withCustomer([
                'level' => ['type' => 'integer', 'description' => 'Maximum customer_client.level to return.'],
                'status' => ['type' => 'string', 'enum' => ['ENABLED', 'CANCELED', 'SUSPENDED', 'CLOSED'], 'description' => 'Optional client status filter.'],
                'limit' => ['type' => 'integer', 'description' => 'GAQL LIMIT value.', 'default' => 100],
            ]),
            'search' => $this->withCustomer([
                'query' => ['type' => 'string', 'required' => true, 'description' => 'Google Ads Query Language query.'],
                'page_token' => ['type' => 'string', 'description' => 'Next page token.'],
                'page_size' => ['type' => 'integer', 'description' => 'Page size.'],
                'validate_only' => ['type' => 'boolean', 'description' => 'Validate the query without executing it.'],
                'return_summary_row' => ['type' => 'boolean', 'description' => 'Return a summary row when supported.'],
                'return_total_results_count' => ['type' => 'boolean', 'description' => 'Return total result count when supported.'],
            ]),
            'search_stream' => $this->withCustomer([
                'query' => ['type' => 'string', 'required' => true, 'description' => 'Google Ads Query Language query.'],
            ]),
            'campaign_report', 'ad_group_report', 'ad_report', 'keyword_report', 'search_term_report', 'asset_report', 'performance_max_report' => $this->reportParameters(),
            'list_campaigns' => $this->withCustomer([
                'status' => ['type' => 'string', 'description' => 'Optional campaign.status filter.'],
                'channel_type' => ['type' => 'string', 'description' => 'Optional advertising_channel_type filter.'],
                'limit' => ['type' => 'integer', 'description' => 'GAQL LIMIT value.', 'default' => 100],
            ]),
            'create_campaign_budget' => $this->writeParameters([
                'name' => ['type' => 'string', 'required' => true, 'description' => 'Budget name.'],
                'amount' => ['type' => 'number', 'description' => 'Daily budget in normal currency units.'],
                'amount_micros' => ['type' => 'integer', 'description' => 'Daily budget in micros.'],
                'delivery_method' => ['type' => 'string', 'default' => 'STANDARD', 'description' => 'Budget delivery method.'],
                'explicitly_shared' => ['type' => 'boolean', 'default' => false, 'description' => 'Whether the budget is shared.'],
            ]),
            'manage_campaign', 'manage_ad_group', 'manage_keyword', 'manage_ad', 'manage_campaign_criteria' => $this->writeParameters([
                'action' => ['type' => 'string', 'required' => true, 'enum' => ['create', 'update', 'pause', 'enable', 'remove'], 'description' => 'Operation to perform.'],
                'resource_id' => ['type' => 'string', 'description' => 'Existing resource ID for update/pause/enable/remove.'],
                'resource_name' => ['type' => 'string', 'description' => 'Full existing resource name.'],
                'fields' => ['type' => 'object', 'description' => 'Create or update fields in Google Ads REST JSON shape.'],
                'update_mask' => ['type' => 'string', 'description' => 'Comma-separated update mask for update operations.'],
            ]),
            'upload_image_asset' => $this->writeParameters([
                'name' => ['type' => 'string', 'required' => true, 'description' => 'Asset name.'],
                'image_data' => ['type' => 'string', 'required' => true, 'description' => 'Base64-encoded image bytes.'],
                'mime_type' => ['type' => 'string', 'description' => 'Optional image MIME type kept in output metadata.'],
            ]),
            'link_asset' => $this->writeParameters([
                'level' => ['type' => 'string', 'required' => true, 'enum' => ['customer', 'campaign', 'ad_group', 'asset_group'], 'description' => 'Where to link the asset.'],
                'asset' => ['type' => 'string', 'required' => true, 'description' => 'Asset resource name.'],
                'parent' => ['type' => 'string', 'description' => 'Parent resource name for campaign/ad_group/asset_group links.'],
                'field_type' => ['type' => 'string', 'required' => true, 'description' => 'Asset field type such as SITELINK, MARKETING_IMAGE, HEADLINE.'],
            ]),
            'create_search_campaign' => $this->writeParameters([
                'spec' => ['type' => 'object', 'required' => true, 'description' => 'Complete search campaign spec: name, daily_budget, keywords, locations, language_ids, responsive_search_ad.'],
            ]),
            'create_performance_max_campaign' => $this->writeParameters([
                'spec' => ['type' => 'object', 'required' => true, 'description' => 'Complete Performance Max spec: name, daily_budget, final_urls, text_assets, existing_assets, locations, language_ids.'],
            ]),
            'generate_keyword_ideas' => $this->withCustomer([
                'body' => ['type' => 'object', 'description' => 'Raw GenerateKeywordIdeasRequest body.'],
                'language' => ['type' => 'string', 'description' => 'Language constant resource name.'],
                'geo_target_constants' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Geo target constant resource names.'],
                'keyword_seed' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Keyword seed terms.'],
                'url_seed' => ['type' => 'string', 'description' => 'URL seed.'],
                'include_adult_keywords' => ['type' => 'boolean', 'description' => 'Include adult keywords.'],
            ]),
            'list_recommendations' => $this->withCustomer([
                'type' => ['type' => 'string', 'description' => 'Optional recommendation.type filter.'],
                'limit' => ['type' => 'integer', 'description' => 'GAQL LIMIT value.', 'default' => 50],
            ]),
            'apply_recommendations' => $this->writeParameters([
                'operations' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'ApplyRecommendationOperation objects.'],
            ]),
            'upload_click_conversions', 'upload_call_conversions' => $this->writeParameters([
                'conversions' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Conversion objects in Google Ads REST JSON shape.'],
                'partial_failure' => ['type' => 'boolean', 'default' => true, 'description' => 'Enable partial failure.'],
                'debug_enabled' => ['type' => 'boolean', 'description' => 'Click conversions only: enable enhanced debugging.'],
                'job_id' => ['type' => 'integer', 'description' => 'Optional click conversion upload job ID.'],
            ]),
            'create_customer_match_list' => $this->writeParameters([
                'name' => ['type' => 'string', 'required' => true, 'description' => 'User list name.'],
                'description' => ['type' => 'string', 'description' => 'User list description.'],
                'membership_life_span' => ['type' => 'integer', 'description' => 'Membership life span in days.', 'default' => 540],
            ]),
            'run_customer_match_job' => $this->writeParameters([
                'user_list' => ['type' => 'string', 'required' => true, 'description' => 'User list resource name.'],
                'members' => ['type' => 'array', 'items' => ['type' => 'object'], 'description' => 'Members with email, phone, first_name, last_name, country_code, postal_code, or prebuilt user_identifiers.'],
                'operations' => ['type' => 'array', 'items' => ['type' => 'object'], 'description' => 'Prebuilt OfflineUserDataJobOperation objects.'],
            ]),
            'get_change_status' => $this->withCustomer([
                'resource_type' => ['type' => 'string', 'description' => 'Optional changed resource type filter.'],
                'since' => ['type' => 'string', 'description' => 'RFC3339 lower bound for change_status.last_change_date_time.'],
                'limit' => ['type' => 'integer', 'default' => 100, 'description' => 'GAQL LIMIT value.'],
            ]),
            'get_change_events' => $this->withCustomer([
                'since' => ['type' => 'string', 'description' => 'RFC3339 lower bound for change_event.change_date_time.'],
                'limit' => ['type' => 'integer', 'default' => 100, 'description' => 'GAQL LIMIT value.'],
            ]),
            'create_batch_job' => $this->writeParameters([
                'operations' => ['type' => 'array', 'items' => ['type' => 'object'], 'description' => 'Batch job mutate operations to append.'],
                'sequence_token' => ['type' => 'string', 'description' => 'Only set for subsequent addOperations calls; omit for the first addOperations request.'],
                'run' => ['type' => 'boolean', 'default' => false, 'description' => 'Run the job after appending operations.'],
            ]),
            'mutate' => $this->writeParameters([
                'resource' => ['type' => 'string', 'description' => 'Resource collection for resource-specific mutate, e.g. campaigns. Omit for mixed googleAds:mutate.'],
                'operations' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Mutate operations.'],
            ]),
            'raw_request' => $this->withCustomer([
                'method' => ['type' => 'string', 'required' => true, 'enum' => ['GET', 'POST', 'PATCH', 'DELETE'], 'description' => 'HTTP method.'],
                'path' => ['type' => 'string', 'required' => true, 'description' => 'Versioned or unversioned Google Ads API path.'],
                'body' => ['type' => 'object', 'description' => 'JSON request body.'],
                'query' => ['type' => 'object', 'description' => 'Query parameters.'],
                'confirm_execute' => ['type' => 'boolean', 'description' => 'Required for non-GET raw requests.'],
            ]),
            'list_billing_setups' => $this->withCustomer([
                'limit' => ['type' => 'integer', 'default' => 100, 'description' => 'GAQL LIMIT value.'],
            ]),
            'account_budget_proposal' => $this->writeParameters([
                'fields' => ['type' => 'object', 'required' => true, 'description' => 'AccountBudgetProposal create fields in Google Ads REST JSON shape.'],
            ]),
            'invite_user' => $this->writeParameters([
                'email_address' => ['type' => 'string', 'required' => true, 'description' => 'Invitee email address.'],
                'access_role' => ['type' => 'string', 'required' => true, 'description' => 'Access role such as STANDARD, READ_ONLY, ADMIN.'],
            ]),
            default => $this->withCustomer([]),
        };
    }

    /**
     * Execute the Google Ads tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (static::ACTION === 'diagnostics') {
                return ToolResult::success($this->service->diagnostics());
            }

            if (! $this->service->isConfigured()) {
                return ToolResult::error('Google Ads integration is not configured.');
            }

            return match (static::ACTION) {
                'list_accessible_customers' => ToolResult::success($this->service->listAccessibleCustomers()),
                'list_customer_clients' => ToolResult::success($this->service->search($this->customerClientQuery($args), $this->customerId($args))),
                'search' => ToolResult::success($this->service->search($this->requiredString($args, 'query'), $this->customerId($args), $this->queryOptions($args))),
                'search_stream' => ToolResult::success($this->service->searchStream($this->requiredString($args, 'query'), $this->customerId($args))),
                'campaign_report', 'ad_group_report', 'ad_report', 'keyword_report', 'search_term_report', 'asset_report', 'performance_max_report'
                    => ToolResult::success($this->service->search($this->reportQuery(static::ACTION, $args), $this->customerId($args), $this->queryOptions($args))),
                'list_campaigns' => ToolResult::success($this->service->search($this->campaignListQuery($args), $this->customerId($args))),
                'create_campaign_budget' => $this->createCampaignBudget($args),
                'manage_campaign' => $this->manageSimpleResource('campaigns', 'campaignOperation', 'campaigns', $args),
                'manage_ad_group' => $this->manageSimpleResource('adGroups', 'adGroupOperation', 'adGroups', $args),
                'manage_keyword' => $this->manageSimpleResource('adGroupCriteria', 'adGroupCriterionOperation', 'adGroupCriteria', $args),
                'manage_ad' => $this->manageSimpleResource('adGroupAds', 'adGroupAdOperation', 'adGroupAds', $args),
                'manage_campaign_criteria' => $this->manageSimpleResource('campaignCriteria', 'campaignCriterionOperation', 'campaignCriteria', $args),
                'upload_image_asset' => $this->uploadImageAsset($args),
                'link_asset' => $this->linkAsset($args),
                'create_search_campaign' => $this->createSearchCampaign($args),
                'create_performance_max_campaign' => $this->createPerformanceMaxCampaign($args),
                'generate_keyword_ideas' => ToolResult::success($this->service->generateKeywordIdeas($this->keywordIdeaBody($args), $this->customerId($args))),
                'list_recommendations' => ToolResult::success($this->service->search($this->recommendationsQuery($args), $this->customerId($args))),
                'apply_recommendations' => $this->confirmed($args, fn () => $this->service->raw('POST', '/customers/' . $this->normalizedCustomerId($args) . '/recommendations:apply', ['operations' => $this->requiredArray($args, 'operations')], [], $this->customerId($args))),
                'upload_click_conversions' => $this->confirmed($args, fn () => $this->service->uploadClickConversions($this->requiredArray($args, 'conversions'), $this->customerId($args), $args)),
                'upload_call_conversions' => $this->confirmed($args, fn () => $this->service->uploadCallConversions($this->requiredArray($args, 'conversions'), $this->customerId($args), $args)),
                'create_customer_match_list' => $this->createCustomerMatchList($args),
                'run_customer_match_job' => $this->runCustomerMatchJob($args),
                'get_change_status' => ToolResult::success($this->service->search($this->changeStatusQuery($args), $this->customerId($args))),
                'get_change_events' => ToolResult::success($this->service->search($this->changeEventsQuery($args), $this->customerId($args))),
                'create_batch_job' => $this->createBatchJob($args),
                'mutate' => $this->mutate($args),
                'raw_request' => $this->rawRequest($args),
                'list_billing_setups' => ToolResult::success($this->service->search($this->billingQuery($args), $this->customerId($args))),
                'account_budget_proposal' => $this->confirmed($args, fn () => $this->service->mutateResource('accountBudgetProposals', [['accountBudgetProposalOperation' => ['create' => $this->requiredArray($args, 'fields')]]], $this->customerId($args), $this->writeOptions($args))),
                'invite_user' => $this->inviteUser($args),
                default => ToolResult::error('Unsupported Google Ads tool action: ' . static::ACTION),
            };
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, array<string, mixed>>
     */
    protected function withCustomer(array $params): array
    {
        return ['customer_id' => ['type' => 'string', 'description' => 'Google Ads customer ID. Defaults to configured default_customer_id.']] + $params;
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, array<string, mixed>>
     */
    protected function writeParameters(array $params): array
    {
        return $this->withCustomer($params + [
            'validate_only' => ['type' => 'boolean', 'description' => 'Validate the request without applying changes.'],
            'partial_failure' => ['type' => 'boolean', 'description' => 'Enable partial failure when supported.'],
            'confirm_execute' => ['type' => 'boolean', 'description' => 'Required for live writes unless validate_only is true.'],
        ]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    protected function reportParameters(): array
    {
        return $this->withCustomer([
            'date_range' => ['type' => 'string', 'description' => 'GAQL date range constant such as LAST_30_DAYS.'],
            'date_from' => ['type' => 'string', 'description' => 'Start date YYYY-MM-DD.'],
            'date_to' => ['type' => 'string', 'description' => 'End date YYYY-MM-DD.'],
            'campaign_id' => ['type' => 'string', 'description' => 'Optional campaign ID filter.'],
            'ad_group_id' => ['type' => 'string', 'description' => 'Optional ad group ID filter.'],
            'limit' => ['type' => 'integer', 'description' => 'GAQL LIMIT value.', 'default' => 100],
        ]);
    }

    private function createCampaignBudget(array $args): ToolResult
    {
        return $this->confirmed($args, function () use ($args): array {
            $amount = $args['amount_micros'] ?? $args['amount'] ?? null;
            if ($amount === null) {
                throw new \InvalidArgumentException('amount or amount_micros is required.');
            }

            return $this->service->mutateResource('campaignBudgets', [[
                'campaignBudgetOperation' => ['create' => [
                    'name' => $this->requiredString($args, 'name'),
                    'amountMicros' => (string) $this->service->moneyToMicros($amount),
                    'deliveryMethod' => (string) ($args['delivery_method'] ?? 'STANDARD'),
                    'explicitlyShared' => (bool) ($args['explicitly_shared'] ?? false),
                ]],
            ]], $this->customerId($args), $this->writeOptions($args));
        });
    }

    private function manageSimpleResource(string $resource, string $operationKey, string $resourcePath, array $args): ToolResult
    {
        return $this->confirmed($args, function () use ($resource, $operationKey, $resourcePath, $args): array {
            $action = strtolower($this->requiredString($args, 'action'));
            $operation = match ($action) {
                'create' => ['create' => $this->requiredArray($args, 'fields')],
                'update' => [
                    'update' => $this->updateFields($resourcePath, $args),
                    'updateMask' => (string) ($args['update_mask'] ?? implode(',', array_keys($this->requiredArray($args, 'fields')))),
                ],
                'pause', 'enable' => [
                    'update' => ['resourceName' => $this->existingResourceName($resourcePath, $args), 'status' => $action === 'pause' ? 'PAUSED' : 'ENABLED'],
                    'updateMask' => 'status',
                ],
                'remove' => ['remove' => $this->existingResourceName($resourcePath, $args)],
                default => throw new \InvalidArgumentException('Unsupported action: ' . $action),
            };

            return $this->service->mutateResource($resource, [[$operationKey => $operation]], $this->customerId($args), $this->writeOptions($args));
        });
    }

    private function uploadImageAsset(array $args): ToolResult
    {
        return $this->confirmed($args, fn () => $this->service->mutateResource('assets', [[
            'assetOperation' => ['create' => [
                'name' => $this->requiredString($args, 'name'),
                'imageAsset' => ['data' => $this->requiredString($args, 'image_data')],
            ]],
        ]], $this->customerId($args), $this->writeOptions($args)));
    }

    private function linkAsset(array $args): ToolResult
    {
        return $this->confirmed($args, function () use ($args): array {
            $level = strtolower($this->requiredString($args, 'level'));
            $fieldType = $this->requiredString($args, 'field_type');
            $asset = $this->requiredString($args, 'asset');
            $parent = (string) ($args['parent'] ?? '');

            [$resource, $operationKey, $create] = match ($level) {
                'customer' => ['customerAssets', 'customerAssetOperation', ['asset' => $asset, 'fieldType' => $fieldType]],
                'campaign' => ['campaignAssets', 'campaignAssetOperation', ['campaign' => $parent, 'asset' => $asset, 'fieldType' => $fieldType]],
                'ad_group' => ['adGroupAssets', 'adGroupAssetOperation', ['adGroup' => $parent, 'asset' => $asset, 'fieldType' => $fieldType]],
                'asset_group' => ['assetGroupAssets', 'assetGroupAssetOperation', ['assetGroup' => $parent, 'asset' => $asset, 'fieldType' => $fieldType]],
                default => throw new \InvalidArgumentException('level must be customer, campaign, ad_group, or asset_group.'),
            };

            if ($level !== 'customer' && $parent === '') {
                throw new \InvalidArgumentException('parent is required for campaign, ad_group, and asset_group links.');
            }

            return $this->service->mutateResource($resource, [[$operationKey => ['create' => $create]]], $this->customerId($args), $this->writeOptions($args));
        });
    }

    private function createSearchCampaign(array $args): ToolResult
    {
        return $this->confirmed($args, fn () => $this->service->createSearchCampaign($this->requiredArray($args, 'spec'), $this->customerId($args), (bool) ($args['validate_only'] ?? false)));
    }

    private function createPerformanceMaxCampaign(array $args): ToolResult
    {
        return $this->confirmed($args, fn () => $this->service->createPerformanceMaxCampaign($this->requiredArray($args, 'spec'), $this->customerId($args), (bool) ($args['validate_only'] ?? false)));
    }

    private function createCustomerMatchList(array $args): ToolResult
    {
        return $this->confirmed($args, fn () => $this->service->mutateResource('userLists', [[
            'userListOperation' => ['create' => [
                'name' => $this->requiredString($args, 'name'),
                'description' => (string) ($args['description'] ?? ''),
                'membershipLifeSpan' => (string) ($args['membership_life_span'] ?? 540),
                'crmBasedUserList' => ['uploadKeyType' => 'CONTACT_INFO'],
            ]],
        ]], $this->customerId($args), $this->writeOptions($args)));
    }

    private function runCustomerMatchJob(array $args): ToolResult
    {
        return $this->confirmed($args, function () use ($args): array {
            $customerId = $this->normalizedCustomerId($args);
            $create = $this->service->raw('POST', "/customers/{$customerId}/offlineUserDataJobs:create", [
                'job' => [
                    'type' => 'CUSTOMER_MATCH_USER_LIST',
                    'customerMatchUserListMetadata' => ['userList' => $this->requiredString($args, 'user_list')],
                ],
            ], [], $this->customerId($args));

            $resourceName = (string) ($create['resourceName'] ?? '');
            if ($resourceName === '') {
                throw new \RuntimeException('Google Ads did not return an offline user data job resource name.');
            }

            $operations = $args['operations'] ?? $this->customerMatchOperations((array) ($args['members'] ?? []));
            $add = $this->service->raw('POST', "/{$resourceName}:addOperations", [
                'enablePartialFailure' => (bool) ($args['partial_failure'] ?? true),
                'operations' => $operations,
            ], [], $this->customerId($args));
            $run = $this->service->raw('POST', "/{$resourceName}:run", [], [], $this->customerId($args));

            return ['job' => $create, 'addOperations' => $add, 'run' => $run];
        });
    }

    private function createBatchJob(array $args): ToolResult
    {
        return $this->confirmed($args, function () use ($args): array {
            $customerId = $this->normalizedCustomerId($args);
            $create = $this->service->raw('POST', "/customers/{$customerId}/batchJobs:mutate", [
                'operations' => [['create' => new \stdClass()]],
            ], [], $this->customerId($args));
            $resourceName = (string) ($create['results'][0]['resourceName'] ?? $create['result']['resourceName'] ?? $create['resourceName'] ?? '');
            $result = ['create' => $create];

            if (! empty($args['operations']) && $resourceName !== '') {
                $operations = $this->requiredArray($args, 'operations');
                if (count($operations) > 5000) {
                    throw new \InvalidArgumentException('Google Ads batchJobs:addOperations accepts at most 5,000 mutateOperations per request.');
                }

                $body = [
                    'mutateOperations' => $operations,
                ];
                if (! empty($args['sequence_token'])) {
                    $body['sequenceToken'] = (string) $args['sequence_token'];
                }

                $result['addOperations'] = $this->service->raw('POST', "/{$resourceName}:addOperations", $body, [], $this->customerId($args));
            }
            if (($args['run'] ?? false) && $resourceName !== '') {
                $result['run'] = $this->service->raw('POST', "/{$resourceName}:run", [], [], $this->customerId($args));
            }

            return $result;
        });
    }

    private function mutate(array $args): ToolResult
    {
        return $this->confirmed($args, function () use ($args): array {
            $operations = $this->requiredArray($args, 'operations');
            if (! empty($args['resource'])) {
                return $this->service->mutateResource((string) $args['resource'], $operations, $this->customerId($args), $this->writeOptions($args));
            }

            return $this->service->mutate($operations, $this->customerId($args), $this->writeOptions($args));
        });
    }

    private function rawRequest(array $args): ToolResult
    {
        $method = strtoupper($this->requiredString($args, 'method'));
        if ($method !== 'GET' && empty($args['confirm_execute'])) {
            return ToolResult::error('confirm_execute=true is required for non-GET raw requests.');
        }

        return ToolResult::success($this->service->raw($method, $this->requiredString($args, 'path'), (array) ($args['body'] ?? []), (array) ($args['query'] ?? []), $this->customerId($args)));
    }

    private function inviteUser(array $args): ToolResult
    {
        return $this->confirmed($args, fn () => $this->service->mutateResource('customerUserAccessInvitations', [[
            'customerUserAccessInvitationOperation' => ['create' => [
                'emailAddress' => $this->requiredString($args, 'email_address'),
                'accessRole' => $this->requiredString($args, 'access_role'),
            ]],
        ]], $this->customerId($args), $this->writeOptions($args)));
    }

    private function confirmed(array $args, callable $callback): ToolResult
    {
        if (($args['validate_only'] ?? false) === true) {
            return ToolResult::success($callback());
        }
        if (empty($args['confirm_execute'])) {
            return ToolResult::error('confirm_execute=true is required for live Google Ads writes. Set validate_only=true to validate without applying changes.');
        }

        return ToolResult::success($callback());
    }

    /**
     * @return array<string, mixed>
     */
    private function writeOptions(array $args): array
    {
        return [
            'validate_only' => (bool) ($args['validate_only'] ?? false),
            'partial_failure' => (bool) ($args['partial_failure'] ?? true),
            'response_content_type' => $args['response_content_type'] ?? 'MUTABLE_RESOURCE',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function queryOptions(array $args): array
    {
        return array_intersect_key($args, array_flip(['page_token', 'page_size', 'validate_only', 'return_summary_row', 'return_total_results_count', 'omit_results']));
    }

    private function customerId(array $args): ?string
    {
        return isset($args['customer_id']) && $args['customer_id'] !== '' ? (string) $args['customer_id'] : null;
    }

    private function normalizedCustomerId(array $args): string
    {
        return $this->service->resolveCustomerId($this->customerId($args));
    }

    private function requiredString(array $args, string $key): string
    {
        $value = trim((string) ($args[$key] ?? ''));
        if ($value === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return $value;
    }

    /**
     * @return array<int|string, mixed>
     */
    private function requiredArray(array $args, string $key): array
    {
        $value = $args[$key] ?? null;
        if (! is_array($value) || $value === []) {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return $value;
    }

    private function limit(array $args, int $default = 100): int
    {
        return max(1, min(10000, (int) ($args['limit'] ?? $default)));
    }

    private function customerClientQuery(array $args): string
    {
        $where = [];
        if (! empty($args['level'])) {
            $where[] = 'customer_client.level <= ' . (int) $args['level'];
        }
        if (! empty($args['status'])) {
            $where[] = "customer_client.status = '" . addslashes((string) $args['status']) . "'";
        }

        return 'SELECT customer_client.client_customer, customer_client.descriptive_name, customer_client.currency_code, customer_client.time_zone, customer_client.manager, customer_client.level, customer_client.status, customer_client.id FROM customer_client'
            . ($where === [] ? '' : ' WHERE ' . implode(' AND ', $where))
            . ' LIMIT ' . $this->limit($args);
    }

    private function campaignListQuery(array $args): string
    {
        $where = [];
        if (! empty($args['status'])) {
            $where[] = "campaign.status = '" . addslashes((string) $args['status']) . "'";
        }
        if (! empty($args['channel_type'])) {
            $where[] = "campaign.advertising_channel_type = '" . addslashes((string) $args['channel_type']) . "'";
        }

        return 'SELECT campaign.id, campaign.name, campaign.status, campaign.advertising_channel_type, campaign.serving_status, campaign.start_date, campaign.end_date, campaign_budget.amount_micros, campaign.optimization_score FROM campaign'
            . ($where === [] ? '' : ' WHERE ' . implode(' AND ', $where))
            . ' ORDER BY campaign.id DESC LIMIT ' . $this->limit($args);
    }

    private function reportQuery(string $action, array $args): string
    {
        [$from, $fields, $extraWhere] = match ($action) {
            'campaign_report' => ['campaign', 'segments.date, campaign.id, campaign.name, campaign.status, campaign.advertising_channel_type, metrics.impressions, metrics.clicks, metrics.cost_micros, metrics.conversions, metrics.conversions_value, metrics.ctr, metrics.average_cpc', []],
            'ad_group_report' => ['ad_group', 'segments.date, campaign.id, campaign.name, ad_group.id, ad_group.name, ad_group.status, metrics.impressions, metrics.clicks, metrics.cost_micros, metrics.conversions, metrics.ctr, metrics.average_cpc', []],
            'ad_report' => ['ad_group_ad', 'segments.date, campaign.id, campaign.name, ad_group.id, ad_group.name, ad_group_ad.ad.id, ad_group_ad.status, ad_group_ad.ad.type, metrics.impressions, metrics.clicks, metrics.cost_micros, metrics.conversions, metrics.ctr', []],
            'keyword_report' => ['keyword_view', 'segments.date, campaign.id, campaign.name, ad_group.id, ad_group.name, ad_group_criterion.criterion_id, ad_group_criterion.keyword.text, ad_group_criterion.keyword.match_type, metrics.impressions, metrics.clicks, metrics.cost_micros, metrics.conversions, metrics.ctr', []],
            'search_term_report' => ['search_term_view', 'segments.date, campaign.id, campaign.name, ad_group.id, ad_group.name, search_term_view.search_term, search_term_view.status, metrics.impressions, metrics.clicks, metrics.cost_micros, metrics.conversions, metrics.ctr', []],
            'asset_report' => ['asset', 'asset.id, asset.name, asset.type, asset.resource_name, asset.policy_summary.approval_status, asset.policy_summary.review_status', []],
            'performance_max_report' => ['campaign', 'segments.date, campaign.id, campaign.name, campaign.status, campaign.optimization_score, metrics.impressions, metrics.clicks, metrics.cost_micros, metrics.conversions, metrics.conversions_value', ["campaign.advertising_channel_type = 'PERFORMANCE_MAX'"]],
            default => throw new \InvalidArgumentException('Unsupported report action.'),
        };

        $where = array_merge($extraWhere, $this->reportWhere($args, $from !== 'asset'));

        return "SELECT {$fields} FROM {$from}"
            . ($where === [] ? '' : ' WHERE ' . implode(' AND ', $where))
            . ($from === 'asset' ? '' : ' ORDER BY segments.date DESC')
            . ' LIMIT ' . $this->limit($args);
    }

    /**
     * @return array<int, string>
     */
    private function reportWhere(array $args, bool $includeDate): array
    {
        $where = [];
        if ($includeDate) {
            if (! empty($args['date_from']) && ! empty($args['date_to'])) {
                $where[] = "segments.date BETWEEN '" . addslashes((string) $args['date_from']) . "' AND '" . addslashes((string) $args['date_to']) . "'";
            } else {
                $where[] = 'segments.date DURING ' . preg_replace('/[^A-Z0-9_]/', '', (string) ($args['date_range'] ?? 'LAST_30_DAYS'));
            }
        }
        if (! empty($args['campaign_id'])) {
            $where[] = 'campaign.id = ' . (int) $args['campaign_id'];
        }
        if (! empty($args['ad_group_id'])) {
            $where[] = 'ad_group.id = ' . (int) $args['ad_group_id'];
        }

        return $where;
    }

    private function recommendationsQuery(array $args): string
    {
        $where = [];
        if (! empty($args['type'])) {
            $where[] = "recommendation.type = '" . addslashes((string) $args['type']) . "'";
        }

        return 'SELECT recommendation.resource_name, recommendation.type, recommendation.campaign, recommendation.ad_group, recommendation.impact.base_metrics.cost_micros, recommendation.impact.potential_metrics.cost_micros FROM recommendation'
            . ($where === [] ? '' : ' WHERE ' . implode(' AND ', $where))
            . ' LIMIT ' . $this->limit($args, 50);
    }

    private function billingQuery(array $args): string
    {
        return 'SELECT billing_setup.id, billing_setup.status, billing_setup.payments_account, billing_setup.payments_account_info.payments_account_id, billing_setup.payments_account_info.payments_profile_id FROM billing_setup LIMIT ' . $this->limit($args);
    }

    private function changeStatusQuery(array $args): string
    {
        $where = [];
        if (! empty($args['since'])) {
            $where[] = "change_status.last_change_date_time >= '" . addslashes((string) $args['since']) . "'";
        }
        if (! empty($args['resource_type'])) {
            $where[] = "change_status.resource_type = '" . addslashes((string) $args['resource_type']) . "'";
        }

        return 'SELECT change_status.resource_name, change_status.last_change_date_time, change_status.resource_type, change_status.resource_status, change_status.campaign, change_status.ad_group, change_status.ad_group_ad, change_status.ad_group_criterion FROM change_status'
            . ($where === [] ? '' : ' WHERE ' . implode(' AND ', $where))
            . ' ORDER BY change_status.last_change_date_time DESC LIMIT ' . $this->limit($args);
    }

    private function changeEventsQuery(array $args): string
    {
        $where = [];
        if (! empty($args['since'])) {
            $where[] = "change_event.change_date_time >= '" . addslashes((string) $args['since']) . "'";
        }

        return 'SELECT change_event.resource_name, change_event.change_date_time, change_event.change_resource_type, change_event.client_type, change_event.user_email, change_event.old_resource, change_event.new_resource, change_event.changed_fields FROM change_event'
            . ($where === [] ? '' : ' WHERE ' . implode(' AND ', $where))
            . ' ORDER BY change_event.change_date_time DESC LIMIT ' . $this->limit($args);
    }

    /**
     * @return array<string, mixed>
     */
    private function keywordIdeaBody(array $args): array
    {
        if (! empty($args['body']) && is_array($args['body'])) {
            return $args['body'];
        }

        $body = [
            'includeAdultKeywords' => (bool) ($args['include_adult_keywords'] ?? false),
            'keywordPlanNetwork' => $args['keyword_plan_network'] ?? 'GOOGLE_SEARCH_AND_PARTNERS',
        ];
        if (! empty($args['language'])) {
            $body['language'] = (string) $args['language'];
        }
        if (! empty($args['geo_target_constants'])) {
            $body['geoTargetConstants'] = (array) $args['geo_target_constants'];
        }
        if (! empty($args['keyword_seed'])) {
            $body['keywordSeed'] = ['keywords' => array_values((array) $args['keyword_seed'])];
        } elseif (! empty($args['url_seed'])) {
            $body['urlSeed'] = ['url' => (string) $args['url_seed']];
        }

        return $body;
    }

    /**
     * @return array<string, mixed>
     */
    private function updateFields(string $resourcePath, array $args): array
    {
        $fields = $this->requiredArray($args, 'fields');
        $fields['resourceName'] = $args['resource_name'] ?? $this->existingResourceName($resourcePath, $args);

        return $fields;
    }

    private function existingResourceName(string $resourcePath, array $args): string
    {
        if (! empty($args['resource_name'])) {
            return (string) $args['resource_name'];
        }

        return $this->service->resourceName($resourcePath, $this->requiredString($args, 'resource_id'), $this->customerId($args));
    }

    /**
     * @param  array<int, array<string, mixed>>  $members
     * @return array<int, array<string, mixed>>
     */
    private function customerMatchOperations(array $members): array
    {
        $operations = [];
        foreach ($members as $member) {
            $identifiers = $member['user_identifiers'] ?? [];
            if (! empty($member['email'])) {
                $identifiers[] = ['hashedEmail' => GoogleAdsIdentifierHasher::hashEmail((string) $member['email'])];
            }
            if (! empty($member['phone'])) {
                $identifiers[] = ['hashedPhoneNumber' => GoogleAdsIdentifierHasher::hashPhone((string) $member['phone'])];
            }
            if (! empty($member['first_name']) || ! empty($member['last_name'])) {
                $identifiers[] = ['addressInfo' => [
                    'hashedFirstName' => GoogleAdsIdentifierHasher::hashText((string) ($member['first_name'] ?? '')),
                    'hashedLastName' => GoogleAdsIdentifierHasher::hashText((string) ($member['last_name'] ?? '')),
                    'countryCode' => $member['country_code'] ?? null,
                    'postalCode' => $member['postal_code'] ?? null,
                ]];
            }
            if ($identifiers === []) {
                continue;
            }
            $operations[] = ['create' => ['userIdentifiers' => $identifiers]];
        }

        return $operations;
    }
}
