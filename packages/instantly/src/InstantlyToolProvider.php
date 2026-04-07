<?php

namespace OpenCompany\Integrations\Instantly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Instantly\Tools\InstantlyActivateCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyAiEnrichmentProgress;
use OpenCompany\Integrations\Instantly\Tools\InstantlyAnalyticsCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyAnalyticsCampaignOverview;
use OpenCompany\Integrations\Instantly\Tools\InstantlyAnalyticsCampaignSteps;
use OpenCompany\Integrations\Instantly\Tools\InstantlyAnalyticsDailyAccount;
use OpenCompany\Integrations\Instantly\Tools\InstantlyAnalyticsDailyCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyAnalyticsWarmup;
use OpenCompany\Integrations\Instantly\Tools\InstantlyBillingPlanDetails;
use OpenCompany\Integrations\Instantly\Tools\InstantlyBillingSubscriptionDetails;
use OpenCompany\Integrations\Instantly\Tools\InstantlyBulkAddLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyBulkAssignLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyBulkDeleteLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCampaignSendingStatus;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCancelDfyAccounts;
use OpenCompany\Integrations\Instantly\Tools\InstantlyChangeWorkspaceOwner;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCheckDfyDomains;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCountLaunchedCampaigns;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateAccount;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateAiEnrichment;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateApiKey;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateBlocklistEntry;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateCustomPromptTemplate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateCustomTag;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateDfyOrder;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateEmailTemplate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateEnrichment;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateInboxPlacementTest;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateLead;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateLeadLabel;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateLeadList;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateSalesFlow;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateSubsequence;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateWebhook;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateWhitelabel;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateWorkspaceGroupMember;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateWorkspaceMember;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCtdStatus;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteAccount;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteApiKey;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteBlocklistEntry;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteCustomPromptTemplate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteCustomTag;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteEmail;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteEmailTemplate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteInboxPlacementTest;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteLead;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteLeadLabel;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteLeadList;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeletePhoneNumber;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteSalesFlow;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteSubsequence;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteWebhook;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteWhitelabel;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteWorkspaceGroupMember;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteWorkspaceMember;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeliverabilityInsights;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDuplicateCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDuplicateSubsequence;
use OpenCompany\Integrations\Instantly\Tools\InstantlyEmailUnreadCount;
use OpenCompany\Integrations\Instantly\Tools\InstantlyEmailVerificationStatus;
use OpenCompany\Integrations\Instantly\Tools\InstantlyEnrichmentCountLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyEnrichmentEnrichLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyEnrichmentHistory;
use OpenCompany\Integrations\Instantly\Tools\InstantlyEnrichmentPreviewLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyForwardEmail;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetAccount;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetAccountMappings;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetBackgroundJob;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetBlocklistEntry;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetCustomPromptTemplate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetCustomTag;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetEmail;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetEmailTemplate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetEnrichment;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetInboxPlacementAnalytics;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetInboxPlacementReport;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetInboxPlacementTest;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetLead;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetLeadLabel;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetLeadList;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetSalesFlow;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetWebhook;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetWebhookEvent;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetWhitelabel;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetWorkspace;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetWorkspaceGroupMember;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetWorkspaceGroupMembersAdmin;
use OpenCompany\Integrations\Instantly\Tools\InstantlyGetWorkspaceMember;
use OpenCompany\Integrations\Instantly\Tools\InstantlyInboxPlacementEspOptions;
use OpenCompany\Integrations\Instantly\Tools\InstantlyInboxPlacementStatsByDate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyInboxPlacementStatsByTest;
use OpenCompany\Integrations\Instantly\Tools\InstantlyLeadListVerificationStats;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListAccounts;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListApiKeys;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListAuditLogs;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListBackgroundJobs;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListBlocklist;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListCampaigns;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListCustomPromptTemplates;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListCustomTagMappings;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListCustomTags;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListDfyAccounts;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListDfyOrders;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListEmailTemplates;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListEmails;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListInboxPlacementAnalytics;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListInboxPlacementReports;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListInboxPlacementTests;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListLeadLabels;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListLeadLists;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListPhoneNumbers;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListSalesFlows;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListSubsequences;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListWebhookEvents;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListWebhooks;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListWorkspaceGroupMembers;
use OpenCompany\Integrations\Instantly\Tools\InstantlyListWorkspaceMembers;
use OpenCompany\Integrations\Instantly\Tools\InstantlyMarkAccountFixed;
use OpenCompany\Integrations\Instantly\Tools\InstantlyMarkEmailRead;
use OpenCompany\Integrations\Instantly\Tools\InstantlyMergeLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyMoveLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlyPauseAccount;
use OpenCompany\Integrations\Instantly\Tools\InstantlyPauseCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyPauseSubsequence;
use OpenCompany\Integrations\Instantly\Tools\InstantlyPreWarmedDomains;
use OpenCompany\Integrations\Instantly\Tools\InstantlyRemoveFromSubsequence;
use OpenCompany\Integrations\Instantly\Tools\InstantlyReplyToEmail;
use OpenCompany\Integrations\Instantly\Tools\InstantlyResumeAccount;
use OpenCompany\Integrations\Instantly\Tools\InstantlyResumeSubsequence;
use OpenCompany\Integrations\Instantly\Tools\InstantlyResumeWebhook;
use OpenCompany\Integrations\Instantly\Tools\InstantlyRunEnrichment;
use OpenCompany\Integrations\Instantly\Tools\InstantlySearchCampaignsByContact;
use OpenCompany\Integrations\Instantly\Tools\InstantlySimilarDomains;
use OpenCompany\Integrations\Instantly\Tools\InstantlySubsequenceMoveLeads;
use OpenCompany\Integrations\Instantly\Tools\InstantlySubsequenceSendingStatus;
use OpenCompany\Integrations\Instantly\Tools\InstantlyTestAiLabel;
use OpenCompany\Integrations\Instantly\Tools\InstantlyTestVitals;
use OpenCompany\Integrations\Instantly\Tools\InstantlyTestWebhook;
use OpenCompany\Integrations\Instantly\Tools\InstantlyToggleCustomTags;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateAccount;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateBlocklistEntry;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateCustomPromptTemplate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateCustomTag;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateEmail;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateEmailTemplate;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateEnrichmentSettings;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateInboxPlacementTest;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateLead;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateLeadLabel;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateLeadList;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateSalesFlow;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateSubsequence;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateWebhook;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateWorkspace;
use OpenCompany\Integrations\Instantly\Tools\InstantlyUpdateWorkspaceMember;
use OpenCompany\Integrations\Instantly\Tools\InstantlyVerifyEmail;
use OpenCompany\Integrations\Instantly\Tools\InstantlyWarmupDisable;
use OpenCompany\Integrations\Instantly\Tools\InstantlyWarmupEnable;
use OpenCompany\Integrations\Instantly\Tools\InstantlyWebhookEventTypes;
use OpenCompany\Integrations\Instantly\Tools\InstantlyWebhookEventsSummary;
use OpenCompany\Integrations\Instantly\Tools\InstantlyWebhookEventsSummaryByDate;

/**
 * Tool provider for the Instantly.ai cold email outreach integration.
 *
 * Registers all Instantly tools covering accounts, campaigns, leads, analytics,
 * emails, enrichment, blocklist, subsequences, webhooks, workspace management,
 * inbox placement, custom tags, DFY orders, and sales flows.
 */
class InstantlyToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return "instantly";
    }

    public function appMeta(): array
    {
        return [
            "label" => "campaigns, leads, emails, analytics",
            "description" => "Cold email outreach and deliverability platform",
            "icon" => "ph:envelope",
            "logo" => "simple-icons:instantly",
        ];
    }

    public function integrationMeta(): array
    {
        return [
            "name" => "Instantly",
            "description" => "Cold email outreach platform with campaigns, leads, analytics, and deliverability tools",
            "icon" => "ph:envelope",
            "logo" => "simple-icons:instantly",
            "category" => "productivity",
            "badge" => "verified",
            "docs_url" => "https://developer.instantly.ai/",
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                "key" => "api_key",
                "type" => "secret",
                "label" => "API Key",
                "placeholder" => "Enter your Instantly API key",
                "hint" => "Generate an API key in your Instantly workspace settings",
                "required" => true,
            ],
        ];
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config["api_key"] ?? "";

        if (empty($apiKey)) {
            return ["success" => false, "error" => "No API key provided"];
        }

        try {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $apiKey,
                "Content-Type" => "application/json",
            ])->timeout(10)->get("https://api.instantly.ai/api/v2/workspaces/current");

            if ($response->successful()) {
                $data = $response->json();
                return [
                    "success" => true,
                    "message" => "Connected to Instantly workspace: " . ($data["name"] ?? "Unknown"),
                ];
            }

            return [
                "success" => false,
                "error" => "API returned status " . $response->status(),
            ];
        } catch (\Exception $e) {
            return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            "api_key" => "nullable|string",
        ];
    }

    public function tools(): array
    {
        return [
            "InstantlyActivateCampaign" => InstantlyActivateCampaign::class,
            "InstantlyAiEnrichmentProgress" => InstantlyAiEnrichmentProgress::class,
            "InstantlyAnalyticsCampaign" => InstantlyAnalyticsCampaign::class,
            "InstantlyAnalyticsCampaignOverview" => InstantlyAnalyticsCampaignOverview::class,
            "InstantlyAnalyticsCampaignSteps" => InstantlyAnalyticsCampaignSteps::class,
            "InstantlyAnalyticsDailyAccount" => InstantlyAnalyticsDailyAccount::class,
            "InstantlyAnalyticsDailyCampaign" => InstantlyAnalyticsDailyCampaign::class,
            "InstantlyAnalyticsWarmup" => InstantlyAnalyticsWarmup::class,
            "InstantlyBillingPlanDetails" => InstantlyBillingPlanDetails::class,
            "InstantlyBillingSubscriptionDetails" => InstantlyBillingSubscriptionDetails::class,
            "InstantlyBulkAddLeads" => InstantlyBulkAddLeads::class,
            "InstantlyBulkAssignLeads" => InstantlyBulkAssignLeads::class,
            "InstantlyBulkDeleteLeads" => InstantlyBulkDeleteLeads::class,
            "InstantlyCampaignSendingStatus" => InstantlyCampaignSendingStatus::class,
            "InstantlyCancelDfyAccounts" => InstantlyCancelDfyAccounts::class,
            "InstantlyChangeWorkspaceOwner" => InstantlyChangeWorkspaceOwner::class,
            "InstantlyCheckDfyDomains" => InstantlyCheckDfyDomains::class,
            "InstantlyCountLaunchedCampaigns" => InstantlyCountLaunchedCampaigns::class,
            "InstantlyCreateAccount" => InstantlyCreateAccount::class,
            "InstantlyCreateAiEnrichment" => InstantlyCreateAiEnrichment::class,
            "InstantlyCreateApiKey" => InstantlyCreateApiKey::class,
            "InstantlyCreateBlocklistEntry" => InstantlyCreateBlocklistEntry::class,
            "InstantlyCreateCampaign" => InstantlyCreateCampaign::class,
            "InstantlyCreateCustomPromptTemplate" => InstantlyCreateCustomPromptTemplate::class,
            "InstantlyCreateCustomTag" => InstantlyCreateCustomTag::class,
            "InstantlyCreateDfyOrder" => InstantlyCreateDfyOrder::class,
            "InstantlyCreateEmailTemplate" => InstantlyCreateEmailTemplate::class,
            "InstantlyCreateEnrichment" => InstantlyCreateEnrichment::class,
            "InstantlyCreateInboxPlacementTest" => InstantlyCreateInboxPlacementTest::class,
            "InstantlyCreateLead" => InstantlyCreateLead::class,
            "InstantlyCreateLeadLabel" => InstantlyCreateLeadLabel::class,
            "InstantlyCreateLeadList" => InstantlyCreateLeadList::class,
            "InstantlyCreateSalesFlow" => InstantlyCreateSalesFlow::class,
            "InstantlyCreateSubsequence" => InstantlyCreateSubsequence::class,
            "InstantlyCreateWebhook" => InstantlyCreateWebhook::class,
            "InstantlyCreateWhitelabel" => InstantlyCreateWhitelabel::class,
            "InstantlyCreateWorkspaceGroupMember" => InstantlyCreateWorkspaceGroupMember::class,
            "InstantlyCreateWorkspaceMember" => InstantlyCreateWorkspaceMember::class,
            "InstantlyCtdStatus" => InstantlyCtdStatus::class,
            "InstantlyDeleteAccount" => InstantlyDeleteAccount::class,
            "InstantlyDeleteApiKey" => InstantlyDeleteApiKey::class,
            "InstantlyDeleteBlocklistEntry" => InstantlyDeleteBlocklistEntry::class,
            "InstantlyDeleteCampaign" => InstantlyDeleteCampaign::class,
            "InstantlyDeleteCustomPromptTemplate" => InstantlyDeleteCustomPromptTemplate::class,
            "InstantlyDeleteCustomTag" => InstantlyDeleteCustomTag::class,
            "InstantlyDeleteEmail" => InstantlyDeleteEmail::class,
            "InstantlyDeleteEmailTemplate" => InstantlyDeleteEmailTemplate::class,
            "InstantlyDeleteInboxPlacementTest" => InstantlyDeleteInboxPlacementTest::class,
            "InstantlyDeleteLead" => InstantlyDeleteLead::class,
            "InstantlyDeleteLeadLabel" => InstantlyDeleteLeadLabel::class,
            "InstantlyDeleteLeadList" => InstantlyDeleteLeadList::class,
            "InstantlyDeletePhoneNumber" => InstantlyDeletePhoneNumber::class,
            "InstantlyDeleteSalesFlow" => InstantlyDeleteSalesFlow::class,
            "InstantlyDeleteSubsequence" => InstantlyDeleteSubsequence::class,
            "InstantlyDeleteWebhook" => InstantlyDeleteWebhook::class,
            "InstantlyDeleteWhitelabel" => InstantlyDeleteWhitelabel::class,
            "InstantlyDeleteWorkspaceGroupMember" => InstantlyDeleteWorkspaceGroupMember::class,
            "InstantlyDeleteWorkspaceMember" => InstantlyDeleteWorkspaceMember::class,
            "InstantlyDeliverabilityInsights" => InstantlyDeliverabilityInsights::class,
            "InstantlyDuplicateCampaign" => InstantlyDuplicateCampaign::class,
            "InstantlyDuplicateSubsequence" => InstantlyDuplicateSubsequence::class,
            "InstantlyEmailUnreadCount" => InstantlyEmailUnreadCount::class,
            "InstantlyEmailVerificationStatus" => InstantlyEmailVerificationStatus::class,
            "InstantlyEnrichmentCountLeads" => InstantlyEnrichmentCountLeads::class,
            "InstantlyEnrichmentEnrichLeads" => InstantlyEnrichmentEnrichLeads::class,
            "InstantlyEnrichmentHistory" => InstantlyEnrichmentHistory::class,
            "InstantlyEnrichmentPreviewLeads" => InstantlyEnrichmentPreviewLeads::class,
            "InstantlyForwardEmail" => InstantlyForwardEmail::class,
            "InstantlyGetAccount" => InstantlyGetAccount::class,
            "InstantlyGetAccountMappings" => InstantlyGetAccountMappings::class,
            "InstantlyGetBackgroundJob" => InstantlyGetBackgroundJob::class,
            "InstantlyGetBlocklistEntry" => InstantlyGetBlocklistEntry::class,
            "InstantlyGetCampaign" => InstantlyGetCampaign::class,
            "InstantlyGetCustomPromptTemplate" => InstantlyGetCustomPromptTemplate::class,
            "InstantlyGetCustomTag" => InstantlyGetCustomTag::class,
            "InstantlyGetEmail" => InstantlyGetEmail::class,
            "InstantlyGetEmailTemplate" => InstantlyGetEmailTemplate::class,
            "InstantlyGetEnrichment" => InstantlyGetEnrichment::class,
            "InstantlyGetInboxPlacementAnalytics" => InstantlyGetInboxPlacementAnalytics::class,
            "InstantlyGetInboxPlacementReport" => InstantlyGetInboxPlacementReport::class,
            "InstantlyGetInboxPlacementTest" => InstantlyGetInboxPlacementTest::class,
            "InstantlyGetLead" => InstantlyGetLead::class,
            "InstantlyGetLeadLabel" => InstantlyGetLeadLabel::class,
            "InstantlyGetLeadList" => InstantlyGetLeadList::class,
            "InstantlyGetSalesFlow" => InstantlyGetSalesFlow::class,
            "InstantlyGetWebhook" => InstantlyGetWebhook::class,
            "InstantlyGetWebhookEvent" => InstantlyGetWebhookEvent::class,
            "InstantlyGetWhitelabel" => InstantlyGetWhitelabel::class,
            "InstantlyGetWorkspace" => InstantlyGetWorkspace::class,
            "InstantlyGetWorkspaceGroupMember" => InstantlyGetWorkspaceGroupMember::class,
            "InstantlyGetWorkspaceGroupMembersAdmin" => InstantlyGetWorkspaceGroupMembersAdmin::class,
            "InstantlyGetWorkspaceMember" => InstantlyGetWorkspaceMember::class,
            "InstantlyInboxPlacementEspOptions" => InstantlyInboxPlacementEspOptions::class,
            "InstantlyInboxPlacementStatsByDate" => InstantlyInboxPlacementStatsByDate::class,
            "InstantlyInboxPlacementStatsByTest" => InstantlyInboxPlacementStatsByTest::class,
            "InstantlyLeadListVerificationStats" => InstantlyLeadListVerificationStats::class,
            "InstantlyListAccounts" => InstantlyListAccounts::class,
            "InstantlyListApiKeys" => InstantlyListApiKeys::class,
            "InstantlyListAuditLogs" => InstantlyListAuditLogs::class,
            "InstantlyListBackgroundJobs" => InstantlyListBackgroundJobs::class,
            "InstantlyListBlocklist" => InstantlyListBlocklist::class,
            "InstantlyListCampaigns" => InstantlyListCampaigns::class,
            "InstantlyListCustomPromptTemplates" => InstantlyListCustomPromptTemplates::class,
            "InstantlyListCustomTagMappings" => InstantlyListCustomTagMappings::class,
            "InstantlyListCustomTags" => InstantlyListCustomTags::class,
            "InstantlyListDfyAccounts" => InstantlyListDfyAccounts::class,
            "InstantlyListDfyOrders" => InstantlyListDfyOrders::class,
            "InstantlyListEmailTemplates" => InstantlyListEmailTemplates::class,
            "InstantlyListEmails" => InstantlyListEmails::class,
            "InstantlyListInboxPlacementAnalytics" => InstantlyListInboxPlacementAnalytics::class,
            "InstantlyListInboxPlacementReports" => InstantlyListInboxPlacementReports::class,
            "InstantlyListInboxPlacementTests" => InstantlyListInboxPlacementTests::class,
            "InstantlyListLeadLabels" => InstantlyListLeadLabels::class,
            "InstantlyListLeadLists" => InstantlyListLeadLists::class,
            "InstantlyListLeads" => InstantlyListLeads::class,
            "InstantlyListPhoneNumbers" => InstantlyListPhoneNumbers::class,
            "InstantlyListSalesFlows" => InstantlyListSalesFlows::class,
            "InstantlyListSubsequences" => InstantlyListSubsequences::class,
            "InstantlyListWebhookEvents" => InstantlyListWebhookEvents::class,
            "InstantlyListWebhooks" => InstantlyListWebhooks::class,
            "InstantlyListWorkspaceGroupMembers" => InstantlyListWorkspaceGroupMembers::class,
            "InstantlyListWorkspaceMembers" => InstantlyListWorkspaceMembers::class,
            "InstantlyMarkAccountFixed" => InstantlyMarkAccountFixed::class,
            "InstantlyMarkEmailRead" => InstantlyMarkEmailRead::class,
            "InstantlyMergeLeads" => InstantlyMergeLeads::class,
            "InstantlyMoveLeads" => InstantlyMoveLeads::class,
            "InstantlyPauseAccount" => InstantlyPauseAccount::class,
            "InstantlyPauseCampaign" => InstantlyPauseCampaign::class,
            "InstantlyPauseSubsequence" => InstantlyPauseSubsequence::class,
            "InstantlyPreWarmedDomains" => InstantlyPreWarmedDomains::class,
            "InstantlyRemoveFromSubsequence" => InstantlyRemoveFromSubsequence::class,
            "InstantlyReplyToEmail" => InstantlyReplyToEmail::class,
            "InstantlyResumeAccount" => InstantlyResumeAccount::class,
            "InstantlyResumeSubsequence" => InstantlyResumeSubsequence::class,
            "InstantlyResumeWebhook" => InstantlyResumeWebhook::class,
            "InstantlyRunEnrichment" => InstantlyRunEnrichment::class,
            "InstantlySearchCampaignsByContact" => InstantlySearchCampaignsByContact::class,
            "InstantlySimilarDomains" => InstantlySimilarDomains::class,
            "InstantlySubsequenceMoveLeads" => InstantlySubsequenceMoveLeads::class,
            "InstantlySubsequenceSendingStatus" => InstantlySubsequenceSendingStatus::class,
            "InstantlyTestAiLabel" => InstantlyTestAiLabel::class,
            "InstantlyTestVitals" => InstantlyTestVitals::class,
            "InstantlyTestWebhook" => InstantlyTestWebhook::class,
            "InstantlyToggleCustomTags" => InstantlyToggleCustomTags::class,
            "InstantlyUpdateAccount" => InstantlyUpdateAccount::class,
            "InstantlyUpdateBlocklistEntry" => InstantlyUpdateBlocklistEntry::class,
            "InstantlyUpdateCampaign" => InstantlyUpdateCampaign::class,
            "InstantlyUpdateCustomPromptTemplate" => InstantlyUpdateCustomPromptTemplate::class,
            "InstantlyUpdateCustomTag" => InstantlyUpdateCustomTag::class,
            "InstantlyUpdateEmail" => InstantlyUpdateEmail::class,
            "InstantlyUpdateEmailTemplate" => InstantlyUpdateEmailTemplate::class,
            "InstantlyUpdateEnrichmentSettings" => InstantlyUpdateEnrichmentSettings::class,
            "InstantlyUpdateInboxPlacementTest" => InstantlyUpdateInboxPlacementTest::class,
            "InstantlyUpdateLead" => InstantlyUpdateLead::class,
            "InstantlyUpdateLeadLabel" => InstantlyUpdateLeadLabel::class,
            "InstantlyUpdateLeadList" => InstantlyUpdateLeadList::class,
            "InstantlyUpdateSalesFlow" => InstantlyUpdateSalesFlow::class,
            "InstantlyUpdateSubsequence" => InstantlyUpdateSubsequence::class,
            "InstantlyUpdateWebhook" => InstantlyUpdateWebhook::class,
            "InstantlyUpdateWorkspace" => InstantlyUpdateWorkspace::class,
            "InstantlyUpdateWorkspaceMember" => InstantlyUpdateWorkspaceMember::class,
            "InstantlyVerifyEmail" => InstantlyVerifyEmail::class,
            "InstantlyWarmupDisable" => InstantlyWarmupDisable::class,
            "InstantlyWarmupEnable" => InstantlyWarmupEnable::class,
            "InstantlyWebhookEventTypes" => InstantlyWebhookEventTypes::class,
            "InstantlyWebhookEventsSummary" => InstantlyWebhookEventsSummary::class,
            "InstantlyWebhookEventsSummaryByDate" => InstantlyWebhookEventsSummaryByDate::class,

        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . "/../lua-docs/instantly.md";
    }

    public function credentialFields(): array
    {
        return [
            ["key" => "api_key", "type" => "secret", "label" => "API Key", "required" => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context["account"] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new InstantlyService(
                apiKey: $creds->get("instantly", "api_key", "", $account),
            );

            return new $class($service);
        }

        return new $class(app(InstantlyService::class));
    }
}