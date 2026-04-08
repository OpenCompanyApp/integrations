<?php

namespace OpenCompany\Integrations\Instantly;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Instantly.ai REST API v2.
 *
 * Handles authentication via Bearer token, error logging, and response parsing.
 * All tool classes delegate to this service — they never make HTTP calls directly.
 */
class InstantlyService
{
    private string $baseUrl = 'https://api.instantly.ai/api/v2';

    /**
     * @param  string  $apiKey  Instantly API key
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    // ─── Accounts ──────────────────────────────────────────────

    /**
     * List email accounts.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, starting_after, search, status)
     * @return array<string, mixed>
     */
    public function listAccounts(array $params = []): array
    {
        return $this->request('GET', '/accounts', [], $params);
    }

    /**
     * Get an email account by ID.
     *
     * @return array<string, mixed>
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', '/accounts/' . urlencode($id));
    }

    /**
     * Create a new email account.
     *
     * @param  array<string, mixed>  $data  Account data (email, smtp_*, imap_*, etc.)
     * @return array<string, mixed>
     */
    public function createAccount(array $data): array
    {
        return $this->request('POST', '/accounts', $data);
    }

    /**
     * Update an email account.
     *
     * @param  array<string, mixed>  $data  Fields to update
     * @return array<string, mixed>
     */
    public function updateAccount(string $email, array $data): array
    {
        return $this->request('PATCH', '/accounts/' . urlencode($email), $data);
    }

    /**
     * Delete an email account.
     */
    public function deleteAccount(string $id): array
    {
        return $this->request('DELETE', '/accounts/' . urlencode($id));
    }

    /**
     * Pause an email account.
     */
    public function pauseAccount(string $email): array
    {
        return $this->request('POST', '/accounts/' . urlencode($email) . '/pause');
    }

    /**
     * Resume a paused email account.
     */
    public function resumeAccount(string $email): array
    {
        return $this->request('POST', '/accounts/' . urlencode($email) . '/resume');
    }

    /**
     * Mark an email account as fixed.
     */
    public function markAccountFixed(string $email): array
    {
        return $this->request('POST', '/accounts/' . urlencode($email) . '/mark-fixed');
    }

    /**
     * Enable warmup for email accounts.
     *
     * @param  array<string>  $accountIds
     */
    public function enableWarmup(array $accountIds): array
    {
        return $this->request('POST', '/accounts/warmup/enable', ['account_ids' => $accountIds]);
    }

    /**
     * Disable warmup for email accounts.
     *
     * @param  array<string>  $accountIds
     */
    public function disableWarmup(array $accountIds): array
    {
        return $this->request('POST', '/accounts/warmup/disable', ['account_ids' => $accountIds]);
    }

    /**
     * Test account vitals (DNS, SMTP, IMAP).
     */
    public function testVitals(string $email): array
    {
        return $this->request('POST', '/accounts/test/vitals', ['email' => $email]);
    }

    /**
     * Get custom tracking domain status.
     */
    public function getCtdStatus(string $host): array
    {
        return $this->request('GET', '/accounts/ctd/status', [], ['host' => $host]);
    }

    // ─── Account Campaign Mappings ─────────────────────────────

    /**
     * Get campaigns associated with an email account.
     *
     * @return array<string, mixed>
     */
    public function getAccountMappings(string $email, array $params = []): array
    {
        return $this->request('GET', '/account-campaign-mappings/' . urlencode($email), [], $params);
    }

    // ─── Campaigns ─────────────────────────────────────────────

    /**
     * List campaigns.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->request('GET', '/campaigns', [], $params);
    }

    /**
     * Get a campaign by ID.
     */
    public function getCampaign(string $id): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($id));
    }

    /**
     * Create a new campaign.
     *
     * @param  array<string, mixed>  $data
     */
    public function createCampaign(array $data): array
    {
        return $this->request('POST', '/campaigns', $data);
    }

    /**
     * Update a campaign.
     *
     * @param  array<string, mixed>  $data
     */
    public function updateCampaign(string $id, array $data): array
    {
        return $this->request('PATCH', '/campaigns/' . urlencode($id), $data);
    }

    /**
     * Delete a campaign.
     */
    public function deleteCampaign(string $id): array
    {
        return $this->request('DELETE', '/campaigns/' . urlencode($id));
    }

    /**
     * Activate a campaign.
     */
    public function activateCampaign(string $id): array
    {
        return $this->request('POST', '/campaigns/' . urlencode($id) . '/activate');
    }

    /**
     * Pause a campaign.
     */
    public function pauseCampaign(string $id): array
    {
        return $this->request('POST', '/campaigns/' . urlencode($id) . '/pause');
    }

    /**
     * Duplicate a campaign.
     */
    public function duplicateCampaign(string $id, array $data = []): array
    {
        return $this->request('POST', '/campaigns/' . urlencode($id) . '/duplicate', $data);
    }

    /**
     * Get count of launched campaigns.
     */
    public function countLaunchedCampaigns(): array
    {
        return $this->request('GET', '/campaigns/count-launched');
    }

    /**
     * Search campaigns by contact email.
     */
    public function searchCampaignsByContact(array $params): array
    {
        return $this->request('GET', '/campaigns/search-by-contact', [], $params);
    }

    /**
     * Get campaign sending status.
     */
    public function getCampaignSendingStatus(string $id, array $params = []): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($id) . '/sending-status', [], $params);
    }

    // ─── Leads ─────────────────────────────────────────────────

    /**
     * List leads (POST endpoint).
     *
     * @param  array<string, mixed>  $data
     */
    public function listLeads(array $data): array
    {
        return $this->request('POST', '/leads/list', $data);
    }

    /**
     * Get a lead by ID.
     */
    public function getLead(string $id): array
    {
        return $this->request('GET', '/leads/' . urlencode($id));
    }

    /**
     * Create a single lead.
     *
     * @param  array<string, mixed>  $data
     */
    public function createLead(array $data): array
    {
        return $this->request('POST', '/leads', $data);
    }

    /**
     * Update a lead.
     *
     * @param  array<string, mixed>  $data
     */
    public function updateLead(string $id, array $data): array
    {
        return $this->request('PATCH', '/leads/' . urlencode($id), $data);
    }

    /**
     * Delete a single lead.
     */
    public function deleteLead(string $id): array
    {
        return $this->request('DELETE', '/leads/' . urlencode($id));
    }

    /**
     * Bulk add leads.
     *
     * @param  array<string, mixed>  $data
     */
    public function bulkAddLeads(array $data): array
    {
        return $this->request('POST', '/leads/add', $data);
    }

    /**
     * Bulk delete leads.
     *
     * @param  array<string, mixed>  $data
     */
    public function bulkDeleteLeads(array $data): array
    {
        return $this->request('DELETE', '/leads', $data);
    }

    /**
     * Bulk assign leads to users.
     *
     * @param  array<string, mixed>  $data
     */
    public function bulkAssignLeads(array $data): array
    {
        return $this->request('POST', '/leads/bulk-assign', $data);
    }

    /**
     * Move leads between campaigns.
     *
     * @param  array<string, mixed>  $data
     */
    public function moveLeads(array $data): array
    {
        return $this->request('POST', '/leads/move', $data);
    }

    /**
     * Merge two leads.
     */
    public function mergeLeads(string $leadId, string $destinationLeadId): array
    {
        return $this->request('POST', '/leads/merge', [
            'lead_id' => $leadId,
            'destination_lead_id' => $destinationLeadId,
        ]);
    }

    /**
     * Remove a lead from a subsequence.
     */
    public function removeFromSubsequence(string $id): array
    {
        return $this->request('POST', '/leads/subsequence/remove', ['id' => $id]);
    }

    /**
     * Move leads to a subsequence.
     *
     * @param  array<string, mixed>  $data
     */
    public function subsequenceMoveLeads(array $data): array
    {
        return $this->request('POST', '/leads/subsequence/move', $data);
    }

    // ─── Lead Lists ────────────────────────────────────────────

    /**
     * List lead lists.
     */
    public function listLeadLists(array $params = []): array
    {
        return $this->request('GET', '/lead-lists', [], $params);
    }

    /**
     * Get a lead list.
     */
    public function getLeadList(string $id): array
    {
        return $this->request('GET', '/lead-lists/' . urlencode($id));
    }

    /**
     * Create a lead list.
     */
    public function createLeadList(string $name): array
    {
        return $this->request('POST', '/lead-lists', ['name' => $name]);
    }

    /**
     * Update a lead list.
     */
    public function updateLeadList(string $id, array $data): array
    {
        return $this->request('PATCH', '/lead-lists/' . urlencode($id), $data);
    }

    /**
     * Delete a lead list.
     */
    public function deleteLeadList(string $id): array
    {
        return $this->request('DELETE', '/lead-lists/' . urlencode($id));
    }

    /**
     * Get verification stats for a lead list.
     */
    public function getLeadListVerificationStats(string $id): array
    {
        return $this->request('GET', '/lead-lists/' . urlencode($id) . '/verification-stats');
    }

    // ─── Lead Labels ───────────────────────────────────────────

    /**
     * List lead labels.
     */
    public function listLeadLabels(array $params = []): array
    {
        return $this->request('GET', '/lead-labels', [], $params);
    }

    /**
     * Get a lead label.
     */
    public function getLeadLabel(string $id): array
    {
        return $this->request('GET', '/lead-labels/' . urlencode($id));
    }

    /**
     * Create a lead label.
     */
    public function createLeadLabel(array $data): array
    {
        return $this->request('POST', '/lead-labels', $data);
    }

    /**
     * Update a lead label.
     */
    public function updateLeadLabel(string $id, array $data): array
    {
        return $this->request('PATCH', '/lead-labels/' . urlencode($id), $data);
    }

    /**
     * Delete a lead label.
     */
    public function deleteLeadLabel(string $id, array $data = []): array
    {
        return $this->request('DELETE', '/lead-labels/' . urlencode($id), $data);
    }

    /**
     * Test AI reply label prediction.
     */
    public function testAiLabel(string $replyText): array
    {
        return $this->request('POST', '/lead-labels/ai-reply-label', ['reply_text' => $replyText]);
    }

    // ─── Analytics ─────────────────────────────────────────────

    /**
     * Get campaign analytics.
     */
    public function getAnalyticsCampaign(array $params = []): array
    {
        return $this->request('GET', '/campaigns/analytics', [], $params);
    }

    /**
     * Get campaign overview analytics.
     */
    public function getAnalyticsCampaignOverview(array $params = []): array
    {
        return $this->request('GET', '/campaigns/analytics/overview', [], $params);
    }

    /**
     * Get daily campaign analytics.
     */
    public function getAnalyticsDailyCampaign(array $params = []): array
    {
        return $this->request('GET', '/campaigns/analytics/daily', [], $params);
    }

    /**
     * Get campaign step analytics.
     */
    public function getAnalyticsCampaignSteps(array $params = []): array
    {
        return $this->request('GET', '/campaigns/analytics/steps', [], $params);
    }

    /**
     * Get daily account analytics.
     */
    public function getAnalyticsDailyAccount(array $params = []): array
    {
        return $this->request('GET', '/accounts/analytics/daily', [], $params);
    }

    /**
     * Get warmup analytics.
     *
     * @param  array<string>  $emails
     */
    public function getAnalyticsWarmup(array $emails): array
    {
        return $this->request('POST', '/accounts/warmup-analytics', ['emails' => $emails]);
    }

    // ─── Email ─────────────────────────────────────────────────

    /**
     * List emails from Unibox.
     */
    public function listEmails(array $params = []): array
    {
        return $this->request('GET', '/emails', [], $params);
    }

    /**
     * Get an email by ID.
     */
    public function getEmail(string $id): array
    {
        return $this->request('GET', '/emails/' . urlencode($id));
    }

    /**
     * Reply to an email.
     *
     * @param  array<string, mixed>  $data
     */
    public function replyToEmail(array $data): array
    {
        return $this->request('POST', '/emails/reply', $data);
    }

    /**
     * Forward an email.
     *
     * @param  array<string, mixed>  $data
     */
    public function forwardEmail(array $data): array
    {
        return $this->request('POST', '/emails/forward', $data);
    }

    /**
     * Delete an email.
     */
    public function deleteEmail(string $id): array
    {
        return $this->request('DELETE', '/emails/' . urlencode($id));
    }

    /**
     * Mark an email thread as read.
     */
    public function markEmailRead(string $threadId): array
    {
        return $this->request('POST', '/emails/threads/' . urlencode($threadId) . '/mark-as-read');
    }

    /**
     * Get unread email count.
     */
    public function getUnreadCount(): array
    {
        return $this->request('GET', '/emails/unread/count');
    }

    /**
     * Update an email.
     *
     * @param  array<string, mixed>  $data
     */
    public function updateEmail(string $id, array $data): array
    {
        return $this->request('PATCH', '/emails/' . urlencode($id), $data);
    }

    // ─── Email Verification ────────────────────────────────────

    /**
     * Verify an email address.
     */
    public function verifyEmail(string $email, ?string $webhookUrl = null): array
    {
        $data = ['email' => $email];
        if ($webhookUrl !== null) {
            $data['webhook_url'] = $webhookUrl;
        }
        return $this->request('POST', '/email-verification', $data);
    }

    /**
     * Get email verification status.
     */
    public function getEmailVerificationStatus(string $email): array
    {
        return $this->request('GET', '/email-verification/' . urlencode($email));
    }

    // ─── Email Templates ───────────────────────────────────────

    /**
     * List email templates.
     */
    public function listEmailTemplates(array $params = []): array
    {
        return $this->request('GET', '/email-templates', [], $params);
    }

    /**
     * Get an email template.
     */
    public function getEmailTemplate(string $id): array
    {
        return $this->request('GET', '/email-templates/' . urlencode($id));
    }

    /**
     * Create an email template.
     */
    public function createEmailTemplate(array $data): array
    {
        return $this->request('POST', '/email-templates', $data);
    }

    /**
     * Update an email template.
     */
    public function updateEmailTemplate(string $id, array $data): array
    {
        return $this->request('PATCH', '/email-templates/' . urlencode($id), $data);
    }

    /**
     * Delete an email template.
     */
    public function deleteEmailTemplate(string $id): array
    {
        return $this->request('DELETE', '/email-templates/' . urlencode($id));
    }

    // ─── Enrichment ────────────────────────────────────────────

    /**
     * Get enrichment settings for a resource.
     */
    public function getEnrichment(string $resourceId): array
    {
        return $this->request('GET', '/supersearch-enrichment/' . urlencode($resourceId));
    }

    /**
     * Create an enrichment.
     */
    public function createEnrichment(array $data): array
    {
        return $this->request('POST', '/supersearch-enrichment', $data);
    }

    /**
     * Run enrichment.
     */
    public function runEnrichment(array $data): array
    {
        return $this->request('POST', '/supersearch-enrichment/run', $data);
    }

    /**
     * Enrich leads from SuperSearch.
     */
    public function enrichLeads(array $data): array
    {
        return $this->request('POST', '/supersearch-enrichment/enrich-leads-from-supersearch', $data);
    }

    /**
     * Count leads from SuperSearch.
     */
    public function countLeads(array $data): array
    {
        return $this->request('POST', '/supersearch-enrichment/count-leads-from-supersearch', $data);
    }

    /**
     * Preview leads from SuperSearch.
     */
    public function previewLeads(array $data): array
    {
        return $this->request('POST', '/supersearch-enrichment/preview-leads-from-supersearch', $data);
    }

    /**
     * Create AI enrichment.
     */
    public function createAiEnrichment(array $data): array
    {
        return $this->request('POST', '/supersearch-enrichment/ai', $data);
    }

    /**
     * Get AI enrichment progress.
     */
    public function getAiEnrichmentProgress(string $resourceId): array
    {
        return $this->request('GET', '/supersearch-enrichment/ai/' . urlencode($resourceId) . '/in-progress');
    }

    /**
     * Get enrichment history.
     */
    public function getEnrichmentHistory(string $resourceId): array
    {
        return $this->request('GET', '/supersearch-enrichment/history/' . urlencode($resourceId));
    }

    /**
     * Update enrichment settings.
     */
    public function updateEnrichmentSettings(string $resourceId, array $data): array
    {
        return $this->request('PATCH', '/supersearch-enrichment/' . urlencode($resourceId) . '/settings', $data);
    }

    // ─── Blocklist ─────────────────────────────────────────────

    /**
     * List blocklist entries.
     */
    public function listBlocklist(array $params = []): array
    {
        return $this->request('GET', '/block-lists-entries', [], $params);
    }

    /**
     * Get a blocklist entry.
     */
    public function getBlocklistEntry(string $id): array
    {
        return $this->request('GET', '/block-lists-entries/' . urlencode($id));
    }

    /**
     * Add to blocklist.
     */
    public function createBlocklistEntry(string $value): array
    {
        return $this->request('POST', '/block-lists-entries', ['bl_value' => $value]);
    }

    /**
     * Update a blocklist entry.
     */
    public function updateBlocklistEntry(string $id, array $data): array
    {
        return $this->request('PATCH', '/block-lists-entries/' . urlencode($id), $data);
    }

    /**
     * Delete a blocklist entry.
     */
    public function deleteBlocklistEntry(string $id): array
    {
        return $this->request('DELETE', '/block-lists-entries/' . urlencode($id));
    }

    // ─── Subsequences ──────────────────────────────────────────

    /**
     * List subsequences.
     */
    public function listSubsequences(array $params): array
    {
        return $this->request('GET', '/subsequences', [], $params);
    }

    /**
     * Create a subsequence.
     */
    public function createSubsequence(array $data): array
    {
        return $this->request('POST', '/subsequences', $data);
    }

    /**
     * Update a subsequence.
     */
    public function updateSubsequence(string $id, array $data): array
    {
        return $this->request('PATCH', '/subsequences/' . urlencode($id), $data);
    }

    /**
     * Delete a subsequence.
     */
    public function deleteSubsequence(string $id): array
    {
        return $this->request('DELETE', '/subsequences/' . urlencode($id));
    }

    /**
     * Duplicate a subsequence.
     */
    public function duplicateSubsequence(string $id, array $data): array
    {
        return $this->request('POST', '/subsequences/' . urlencode($id) . '/duplicate', $data);
    }

    /**
     * Pause a subsequence.
     */
    public function pauseSubsequence(string $id): array
    {
        return $this->request('POST', '/subsequences/' . urlencode($id) . '/pause');
    }

    /**
     * Resume a subsequence.
     */
    public function resumeSubsequence(string $id): array
    {
        return $this->request('POST', '/subsequences/' . urlencode($id) . '/resume');
    }

    /**
     * Get subsequence sending status.
     */
    public function getSubsequenceSendingStatus(string $id, array $params = []): array
    {
        return $this->request('GET', '/subsequences/' . urlencode($id) . '/sending-status', [], $params);
    }

    // ─── Webhooks ──────────────────────────────────────────────

    /**
     * List webhooks.
     */
    public function listWebhooks(array $params = []): array
    {
        return $this->request('GET', '/webhooks', [], $params);
    }

    /**
     * Get a webhook.
     */
    public function getWebhook(string $id): array
    {
        return $this->request('GET', '/webhooks/' . urlencode($id));
    }

    /**
     * Create a webhook.
     */
    public function createWebhook(array $data): array
    {
        return $this->request('POST', '/webhooks', $data);
    }

    /**
     * Update a webhook.
     */
    public function updateWebhook(string $id, array $data): array
    {
        return $this->request('PATCH', '/webhooks/' . urlencode($id), $data);
    }

    /**
     * Delete a webhook.
     */
    public function deleteWebhook(string $id): array
    {
        return $this->request('DELETE', '/webhooks/' . urlencode($id));
    }

    /**
     * Test a webhook.
     */
    public function testWebhook(string $id): array
    {
        return $this->request('POST', '/webhooks/' . urlencode($id) . '/test');
    }

    /**
     * Resume a webhook.
     */
    public function resumeWebhook(string $id): array
    {
        return $this->request('POST', '/webhooks/' . urlencode($id) . '/resume');
    }

    /**
     * List webhook event types.
     */
    public function getWebhookEventTypes(): array
    {
        return $this->request('GET', '/webhooks/event-types');
    }

    // ─── Webhook Events ────────────────────────────────────────

    /**
     * List webhook events.
     */
    public function listWebhookEvents(array $params = []): array
    {
        return $this->request('GET', '/webhook-events', [], $params);
    }

    /**
     * Get a webhook event.
     */
    public function getWebhookEvent(string $id): array
    {
        return $this->request('GET', '/webhook-events/' . urlencode($id));
    }

    /**
     * Get webhook events summary.
     */
    public function getWebhookEventsSummary(array $params = []): array
    {
        return $this->request('GET', '/webhook-events/summary', [], $params);
    }

    /**
     * Get webhook events summary by date.
     */
    public function getWebhookEventsSummaryByDate(array $params = []): array
    {
        return $this->request('GET', '/webhook-events/summary-by-date', [], $params);
    }

    // ─── API Keys ──────────────────────────────────────────────

    /**
     * List API keys.
     */
    public function listApiKeys(array $params = []): array
    {
        return $this->request('GET', '/api-keys', [], $params);
    }

    /**
     * Create an API key.
     */
    public function createApiKey(string $name, array $scopes): array
    {
        return $this->request('POST', '/api-keys', ['name' => $name, 'scopes' => $scopes]);
    }

    /**
     * Delete an API key.
     */
    public function deleteApiKey(string $id): array
    {
        return $this->request('DELETE', '/api-keys/' . urlencode($id));
    }

    // ─── Workspace ─────────────────────────────────────────────

    /**
     * Get current workspace.
     */
    public function getWorkspace(): array
    {
        return $this->request('GET', '/workspaces/current');
    }

    /**
     * Update current workspace.
     */
    public function updateWorkspace(array $data): array
    {
        return $this->request('PATCH', '/workspaces/current', $data);
    }

    /**
     * Change workspace owner.
     */
    public function changeWorkspaceOwner(string $email, string $sec): array
    {
        return $this->request('POST', '/workspaces/current/change-owner', ['email' => $email, 'sec' => $sec]);
    }

    /**
     * Get whitelabel domain.
     */
    public function getWhitelabel(): array
    {
        return $this->request('GET', '/workspaces/current/whitelabel-domain');
    }

    /**
     * Create whitelabel domain.
     */
    public function createWhitelabel(string $domain): array
    {
        return $this->request('POST', '/workspaces/current/whitelabel-domain', ['domain' => $domain]);
    }

    /**
     * Delete whitelabel domain.
     */
    public function deleteWhitelabel(): array
    {
        return $this->request('DELETE', '/workspaces/current/whitelabel-domain');
    }

    // ─── Workspace Members ─────────────────────────────────────

    /**
     * List workspace members.
     */
    public function listWorkspaceMembers(): array
    {
        return $this->request('GET', '/workspace-members');
    }

    /**
     * Get a workspace member.
     */
    public function getWorkspaceMember(string $id): array
    {
        return $this->request('GET', '/workspace-members/' . urlencode($id));
    }

    /**
     * Create a workspace member.
     */
    public function createWorkspaceMember(string $email, string $role): array
    {
        return $this->request('POST', '/workspace-members', ['email' => $email, 'role' => $role]);
    }

    /**
     * Update a workspace member.
     */
    public function updateWorkspaceMember(string $id, array $data): array
    {
        return $this->request('PATCH', '/workspace-members/' . urlencode($id), $data);
    }

    /**
     * Delete a workspace member.
     */
    public function deleteWorkspaceMember(string $id): array
    {
        return $this->request('DELETE', '/workspace-members/' . urlencode($id));
    }

    // ─── Workspace Group Members ───────────────────────────────

    /**
     * List workspace group members.
     */
    public function listWorkspaceGroupMembers(array $params = []): array
    {
        return $this->request('GET', '/workspace-group-members', [], $params);
    }

    /**
     * Get a workspace group member.
     */
    public function getWorkspaceGroupMember(string $id): array
    {
        return $this->request('GET', '/workspace-group-members/' . urlencode($id));
    }

    /**
     * Get admin workspace group members.
     */
    public function getWorkspaceGroupMembersAdmin(): array
    {
        return $this->request('GET', '/workspace-group-members/admin');
    }

    /**
     * Create a workspace group member.
     */
    public function createWorkspaceGroupMember(string $email): array
    {
        return $this->request('POST', '/workspace-group-members', ['email' => $email]);
    }

    /**
     * Delete a workspace group member.
     */
    public function deleteWorkspaceGroupMember(string $id): array
    {
        return $this->request('DELETE', '/workspace-group-members/' . urlencode($id));
    }

    // ─── Workspace Billing ─────────────────────────────────────

    /**
     * Get workspace plan details.
     */
    public function getPlanDetails(): array
    {
        return $this->request('GET', '/workspace-billing/plan-details');
    }

    /**
     * Get workspace subscription details.
     */
    public function getSubscriptionDetails(): array
    {
        return $this->request('GET', '/workspace-billing/subscription-details');
    }

    // ─── Audit Logs ────────────────────────────────────────────

    /**
     * List audit logs.
     */
    public function listAuditLogs(array $params = []): array
    {
        return $this->request('GET', '/audit-logs', [], $params);
    }

    // ─── Background Jobs ───────────────────────────────────────

    /**
     * List background jobs.
     */
    public function listBackgroundJobs(array $params = []): array
    {
        return $this->request('GET', '/background-jobs', [], $params);
    }

    /**
     * Get a background job.
     */
    public function getBackgroundJob(string $id, array $params = []): array
    {
        return $this->request('GET', '/background-jobs/' . urlencode($id), [], $params);
    }

    // ─── Inbox Placement ───────────────────────────────────────

    /**
     * List inbox placement tests.
     */
    public function listInboxPlacementTests(array $params = []): array
    {
        return $this->request('GET', '/inbox-placement-tests', [], $params);
    }

    /**
     * Get an inbox placement test.
     */
    public function getInboxPlacementTest(string $id, array $params = []): array
    {
        return $this->request('GET', '/inbox-placement-tests/' . urlencode($id), [], $params);
    }

    /**
     * Create an inbox placement test.
     */
    public function createInboxPlacementTest(array $data): array
    {
        return $this->request('POST', '/inbox-placement-tests', $data);
    }

    /**
     * Update an inbox placement test.
     */
    public function updateInboxPlacementTest(string $id, array $data): array
    {
        return $this->request('PATCH', '/inbox-placement-tests/' . urlencode($id), $data);
    }

    /**
     * Delete an inbox placement test.
     */
    public function deleteInboxPlacementTest(string $id): array
    {
        return $this->request('DELETE', '/inbox-placement-tests/' . urlencode($id));
    }

    /**
     * Get ESP options for inbox placement tests.
     */
    public function getInboxPlacementEspOptions(): array
    {
        return $this->request('GET', '/inbox-placement-tests/email-service-provider-options');
    }

    // ─── Inbox Placement Analytics ─────────────────────────────

    /**
     * List inbox placement analytics.
     */
    public function listInboxPlacementAnalytics(array $params = []): array
    {
        return $this->request('GET', '/inbox-placement-analytics', [], $params);
    }

    /**
     * Get an inbox placement analytics entry.
     */
    public function getInboxPlacementAnalytics(string $id): array
    {
        return $this->request('GET', '/inbox-placement-analytics/' . urlencode($id));
    }

    /**
     * Get deliverability insights.
     */
    public function getDeliverabilityInsights(array $data): array
    {
        return $this->request('POST', '/inbox-placement-analytics/deliverability-insights', $data);
    }

    /**
     * Get stats by date.
     */
    public function getInboxPlacementStatsByDate(array $data): array
    {
        return $this->request('POST', '/inbox-placement-analytics/stats-by-date', $data);
    }

    /**
     * Get stats by test.
     */
    public function getInboxPlacementStatsByTest(array $data): array
    {
        return $this->request('POST', '/inbox-placement-analytics/stats-by-test-id', $data);
    }

    // ─── Inbox Placement Reports ───────────────────────────────

    /**
     * List inbox placement reports.
     */
    public function listInboxPlacementReports(array $params = []): array
    {
        return $this->request('GET', '/inbox-placement-reports', [], $params);
    }

    /**
     * Get an inbox placement report.
     */
    public function getInboxPlacementReport(string $id): array
    {
        return $this->request('GET', '/inbox-placement-reports/' . urlencode($id));
    }

    // ─── Custom Tags ───────────────────────────────────────────

    /**
     * List custom tags.
     */
    public function listCustomTags(array $params = []): array
    {
        return $this->request('GET', '/custom-tags', [], $params);
    }

    /**
     * Get a custom tag.
     */
    public function getCustomTag(string $id): array
    {
        return $this->request('GET', '/custom-tags/' . urlencode($id));
    }

    /**
     * Create a custom tag.
     */
    public function createCustomTag(array $data): array
    {
        return $this->request('POST', '/custom-tags', $data);
    }

    /**
     * Update a custom tag.
     */
    public function updateCustomTag(string $id, array $data): array
    {
        return $this->request('PATCH', '/custom-tags/' . urlencode($id), $data);
    }

    /**
     * Delete a custom tag.
     */
    public function deleteCustomTag(string $id): array
    {
        return $this->request('DELETE', '/custom-tags/' . urlencode($id));
    }

    /**
     * Toggle custom tags on resources.
     */
    public function toggleCustomTags(array $data): array
    {
        return $this->request('POST', '/custom-tags/toggle-resource', $data);
    }

    // ─── Custom Tag Mappings ───────────────────────────────────

    /**
     * List custom tag mappings.
     */
    public function listCustomTagMappings(array $params = []): array
    {
        return $this->request('GET', '/custom-tag-mappings', [], $params);
    }

    // ─── Custom Prompt Templates ───────────────────────────────

    /**
     * List custom prompt templates.
     */
    public function listCustomPromptTemplates(array $params = []): array
    {
        return $this->request('GET', '/custom-prompt-templates', [], $params);
    }

    /**
     * Get a custom prompt template.
     */
    public function getCustomPromptTemplate(string $id): array
    {
        return $this->request('GET', '/custom-prompt-templates/' . urlencode($id));
    }

    /**
     * Create a custom prompt template.
     */
    public function createCustomPromptTemplate(array $data): array
    {
        return $this->request('POST', '/custom-prompt-templates', $data);
    }

    /**
     * Update a custom prompt template.
     */
    public function updateCustomPromptTemplate(string $id, array $data): array
    {
        return $this->request('PATCH', '/custom-prompt-templates/' . urlencode($id), $data);
    }

    /**
     * Delete a custom prompt template.
     */
    public function deleteCustomPromptTemplate(string $id): array
    {
        return $this->request('DELETE', '/custom-prompt-templates/' . urlencode($id));
    }

    // ─── DFY Orders ────────────────────────────────────────────

    /**
     * List DFY orders.
     */
    public function listDfyOrders(array $params = []): array
    {
        return $this->request('GET', '/dfy-email-account-orders', [], $params);
    }

    /**
     * Create a DFY order.
     */
    public function createDfyOrder(array $data): array
    {
        return $this->request('POST', '/dfy-email-account-orders', $data);
    }

    /**
     * List DFY ordered accounts.
     */
    public function listDfyAccounts(array $params = []): array
    {
        return $this->request('GET', '/dfy-email-account-orders/accounts', [], $params);
    }

    /**
     * Cancel DFY accounts.
     *
     * @param  array<string>  $accounts
     */
    public function cancelDfyAccounts(array $accounts): array
    {
        return $this->request('POST', '/dfy-email-account-orders/accounts/cancel', ['accounts' => $accounts]);
    }

    /**
     * Check domain availability for DFY orders.
     *
     * @param  array<string>  $domains
     */
    public function checkDfyDomains(array $domains): array
    {
        return $this->request('POST', '/dfy-email-account-orders/domains/check', ['domains' => $domains]);
    }

    /**
     * Get pre-warmed up domains.
     */
    public function getPreWarmedDomains(array $data = []): array
    {
        return $this->request('POST', '/dfy-email-account-orders/domains/pre-warmed-up-list', $data);
    }

    /**
     * Get similar domains.
     */
    public function getSimilarDomains(array $data): array
    {
        return $this->request('POST', '/dfy-email-account-orders/domains/similar', $data);
    }

    // ─── CRM Actions ───────────────────────────────────────────

    /**
     * List CRM phone numbers.
     */
    public function listPhoneNumbers(array $params = []): array
    {
        return $this->request('GET', '/crm-actions/phone-numbers', [], $params);
    }

    /**
     * Delete a CRM phone number.
     */
    public function deletePhoneNumber(string $id): array
    {
        return $this->request('DELETE', '/crm-actions/phone-numbers/' . urlencode($id));
    }

    // ─── Sales Flow ────────────────────────────────────────────

    /**
     * List sales flows.
     */
    public function listSalesFlows(array $params = []): array
    {
        return $this->request('GET', '/sales-flows', [], $params);
    }

    /**
     * Get a sales flow.
     */
    public function getSalesFlow(string $id): array
    {
        return $this->request('GET', '/sales-flows/' . urlencode($id));
    }

    /**
     * Create a sales flow.
     */
    public function createSalesFlow(array $data): array
    {
        return $this->request('POST', '/sales-flows', $data);
    }

    /**
     * Update a sales flow.
     */
    public function updateSalesFlow(string $id, array $data): array
    {
        return $this->request('PATCH', '/sales-flows/' . urlencode($id), $data);
    }

    /**
     * Delete a sales flow.
     */
    public function deleteSalesFlow(string $id): array
    {
        return $this->request('DELETE', '/sales-flows/' . urlencode($id));
    }

    // ─── Core HTTP ─────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $body
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $body = [], array $query = []): array
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Instantly API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, array_merge($query, $body)),
                'POST' => $http->post($url, $body ?: $query),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body ?: $query),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $errorBody = $response->body();
                $errorMessage = $errorBody;

                try {
                    $parsed = $response->json();
                    $errorMessage = $parsed['message'] ?? $parsed['error'] ?? $errorBody;
                } catch (\Throwable) {}

                Log::error("Instantly API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                ]);
                throw new \RuntimeException("Instantly API error ({$response->status()}): " . (is_string($errorMessage) ? $errorMessage : json_encode($errorMessage)));
            }

            $json = $response->json();
            return is_array($json) ? $json : [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Instantly API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Instantly API: {$e->getMessage()}");
        }
    }
}
