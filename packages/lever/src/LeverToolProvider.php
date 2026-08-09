<?php

namespace OpenCompany\Integrations\Lever;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Lever.
 *
 * Exposes the official Lever Postings API and authenticated Lever Data API.
 */
class LeverToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Public postings reads do not require credentials. Application submission and all Data API tools require a Lever API key with endpoint permissions.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'lever';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Lever',
            'description' => 'Job postings, candidates, requisitions, users, forms, and recruiting records',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:lever',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Lever',
            'description' => 'Lever Postings API plus authenticated Data API coverage for opportunities, postings, users, requisitions, forms, interviews, offers, referrals, files, and webhooks.',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:lever',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://github.com/lever/postings-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Postings API Key', 'placeholder' => 'Lever Postings API key', 'hint' => 'Required only for submitting applications.', 'required' => false],
            ['key' => 'site', 'type' => 'text', 'label' => 'Test Site', 'placeholder' => 'lever', 'hint' => 'Lever site slug used by the connection test.', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.lever.co/v0/postings', 'hint' => 'Use https://api.eu.lever.co/v0/postings for EU Lever sites.', 'default' => 'https://api.lever.co/v0/postings'],
            ['key' => 'data_url', 'type' => 'url', 'label' => 'Data API Base URL', 'placeholder' => 'https://api.lever.co/v1', 'hint' => 'Use https://api.eu.lever.co/v1 for EU Lever accounts.', 'default' => 'https://api.lever.co/v1'],
        ];
    }

    /**
     * Verify Lever connectivity with a lightweight postings list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $site = (string) ($config['site'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.lever.co/v0/postings'), '/');
        if ($site === '') {
            return ['success' => false, 'error' => 'No Lever site provided.'];
        }

        try {
            $response = Http::acceptJson()->timeout(20)->get($baseUrl.'/'.rawurlencode($site), ['mode' => 'json', 'limit' => 1]);

            return $response->successful()
                ? ['success' => true, 'message' => 'Lever postings API reachable.']
                : ['success' => false, 'error' => 'Lever API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string', 'site' => 'nullable|string', 'url' => 'nullable|url', 'data_url' => 'nullable|url'];
    }

    public function tools(): array
    {
        return [
            'lever_list_postings' => [
                'class' => '\\OpenCompany\\Integrations\\Lever\\Tools\\LeverListPostings',
                'type' => 'read',
                'name' => 'List Postings',
                'description' => 'List published Lever job postings for a site.',
                'icon' => 'ph:list-bullets',
            ],
            'lever_get_posting' => [
                'class' => '\\OpenCompany\\Integrations\\Lever\\Tools\\LeverGetPosting',
                'type' => 'read',
                'name' => 'Get Posting',
                'description' => 'Get a single published Lever job posting by ID.',
                'icon' => 'ph:magnifying-glass',
            ],
            'lever_apply_to_posting' => [
                'class' => '\\OpenCompany\\Integrations\\Lever\\Tools\\LeverApplyToPosting',
                'type' => 'write',
                'name' => 'Apply To Posting',
                'description' => 'Submit a candidate application to a Lever posting with a Postings API key.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'lever_data_api_get' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDataApiGet', 'type' => 'read', 'name' => 'Data Api Get', 'description' => 'Call a safe relative Lever Data API path with GET.', 'icon' => 'ph:magnifying-glass'],
            'lever_data_api_post' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDataApiPost', 'type' => 'write', 'name' => 'Data Api Post', 'description' => 'Call a safe relative Lever Data API path with POST.', 'icon' => 'ph:pencil-simple'],
            'lever_data_api_put' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDataApiPut', 'type' => 'write', 'name' => 'Data Api Put', 'description' => 'Call a safe relative Lever Data API path with PUT.', 'icon' => 'ph:pencil-simple'],
            'lever_data_api_delete' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDataApiDelete', 'type' => 'write', 'name' => 'Data Api Delete', 'description' => 'Call a safe relative Lever Data API path with DELETE.', 'icon' => 'ph:trash'],
            'lever_list_data_opportunities' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListDataOpportunities', 'type' => 'read', 'name' => 'List Data Opportunities', 'description' => 'List authenticated Lever opportunities.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_data_opportunity' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetDataOpportunity', 'type' => 'read', 'name' => 'Get Data Opportunity', 'description' => 'Retrieve one authenticated Lever opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_opportunity' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateOpportunity', 'type' => 'write', 'name' => 'Create Opportunity', 'description' => 'Create a Lever opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_list_deleted_opportunities' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListDeletedOpportunities', 'type' => 'read', 'name' => 'List Deleted Opportunities', 'description' => 'List deleted Lever opportunities.', 'icon' => 'ph:magnifying-glass'],
            'lever_update_opportunity_stage' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateOpportunityStage', 'type' => 'write', 'name' => 'Update Opportunity Stage', 'description' => 'Move an opportunity to another stage.', 'icon' => 'ph:pencil-simple'],
            'lever_update_opportunity_archive' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateOpportunityArchive', 'type' => 'write', 'name' => 'Update Opportunity Archive', 'description' => 'Archive or unarchive an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_add_opportunity_tags' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverAddOpportunityTags', 'type' => 'write', 'name' => 'Add Opportunity Tags', 'description' => 'Add tags to an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_remove_opportunity_tags' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverRemoveOpportunityTags', 'type' => 'write', 'name' => 'Remove Opportunity Tags', 'description' => 'Remove tags from an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_add_opportunity_sources' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverAddOpportunitySources', 'type' => 'write', 'name' => 'Add Opportunity Sources', 'description' => 'Add sources to an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_remove_opportunity_sources' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverRemoveOpportunitySources', 'type' => 'write', 'name' => 'Remove Opportunity Sources', 'description' => 'Remove sources from an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_add_opportunity_links' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverAddOpportunityLinks', 'type' => 'write', 'name' => 'Add Opportunity Links', 'description' => 'Add links to an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_remove_opportunity_links' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverRemoveOpportunityLinks', 'type' => 'write', 'name' => 'Remove Opportunity Links', 'description' => 'Remove links from an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_list_opportunity_applications' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityApplications', 'type' => 'read', 'name' => 'List Opportunity Applications', 'description' => 'List applications for an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_application' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityApplication', 'type' => 'read', 'name' => 'Get Opportunity Application', 'description' => 'Retrieve one opportunity application.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_deleted_applications' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListDeletedApplications', 'type' => 'read', 'name' => 'List Deleted Applications', 'description' => 'List deleted applications.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_opportunity_feedback' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityFeedback', 'type' => 'read', 'name' => 'List Opportunity Feedback', 'description' => 'List feedback forms for an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_feedback' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityFeedback', 'type' => 'read', 'name' => 'Get Opportunity Feedback', 'description' => 'Retrieve one opportunity feedback form.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_opportunity_feedback' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateOpportunityFeedback', 'type' => 'write', 'name' => 'Create Opportunity Feedback', 'description' => 'Create feedback for an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_update_opportunity_feedback' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateOpportunityFeedback', 'type' => 'write', 'name' => 'Update Opportunity Feedback', 'description' => 'Update opportunity feedback.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_opportunity_feedback' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteOpportunityFeedback', 'type' => 'write', 'name' => 'Delete Opportunity Feedback', 'description' => 'Delete opportunity feedback.', 'icon' => 'ph:trash'],
            'lever_list_opportunity_notes' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityNotes', 'type' => 'read', 'name' => 'List Opportunity Notes', 'description' => 'List notes for an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_note' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityNote', 'type' => 'read', 'name' => 'Get Opportunity Note', 'description' => 'Retrieve one opportunity note.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_opportunity_note' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateOpportunityNote', 'type' => 'write', 'name' => 'Create Opportunity Note', 'description' => 'Create a note on an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_update_opportunity_note' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateOpportunityNote', 'type' => 'write', 'name' => 'Update Opportunity Note', 'description' => 'Update an opportunity note.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_opportunity_note' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteOpportunityNote', 'type' => 'write', 'name' => 'Delete Opportunity Note', 'description' => 'Delete an opportunity note.', 'icon' => 'ph:trash'],
            'lever_list_opportunity_files' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityFiles', 'type' => 'read', 'name' => 'List Opportunity Files', 'description' => 'List files on an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_file' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityFile', 'type' => 'read', 'name' => 'Get Opportunity File', 'description' => 'Retrieve opportunity file metadata.', 'icon' => 'ph:magnifying-glass'],
            'lever_download_opportunity_file' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDownloadOpportunityFile', 'type' => 'read', 'name' => 'Download Opportunity File', 'description' => 'Download an opportunity file.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_opportunity_file' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateOpportunityFile', 'type' => 'write', 'name' => 'Create Opportunity File', 'description' => 'Attach file metadata to an opportunity.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_opportunity_file' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteOpportunityFile', 'type' => 'write', 'name' => 'Delete Opportunity File', 'description' => 'Delete an opportunity file.', 'icon' => 'ph:trash'],
            'lever_list_opportunity_file_actions' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityFileActions', 'type' => 'read', 'name' => 'List Opportunity File Actions', 'description' => 'List file actions for an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_opportunity_resumes' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityResumes', 'type' => 'read', 'name' => 'List Opportunity Resumes', 'description' => 'List resumes on an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_resume' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityResume', 'type' => 'read', 'name' => 'Get Opportunity Resume', 'description' => 'Retrieve opportunity resume metadata.', 'icon' => 'ph:magnifying-glass'],
            'lever_download_opportunity_resume' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDownloadOpportunityResume', 'type' => 'read', 'name' => 'Download Opportunity Resume', 'description' => 'Download an opportunity resume.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_opportunity_forms' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityForms', 'type' => 'read', 'name' => 'List Opportunity Forms', 'description' => 'List forms on an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_form' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityForm', 'type' => 'read', 'name' => 'Get Opportunity Form', 'description' => 'Retrieve one opportunity form.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_opportunity_form' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateOpportunityForm', 'type' => 'write', 'name' => 'Create Opportunity Form', 'description' => 'Create an opportunity form.', 'icon' => 'ph:pencil-simple'],
            'lever_list_opportunity_interviews' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityInterviews', 'type' => 'read', 'name' => 'List Opportunity Interviews', 'description' => 'List interviews for an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_interview' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityInterview', 'type' => 'read', 'name' => 'Get Opportunity Interview', 'description' => 'Retrieve one opportunity interview.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_opportunity_interview' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateOpportunityInterview', 'type' => 'write', 'name' => 'Create Opportunity Interview', 'description' => 'Create an opportunity interview.', 'icon' => 'ph:pencil-simple'],
            'lever_update_opportunity_interview' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateOpportunityInterview', 'type' => 'write', 'name' => 'Update Opportunity Interview', 'description' => 'Update an opportunity interview.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_opportunity_interview' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteOpportunityInterview', 'type' => 'write', 'name' => 'Delete Opportunity Interview', 'description' => 'Delete an opportunity interview.', 'icon' => 'ph:trash'],
            'lever_list_opportunity_panels' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityPanels', 'type' => 'read', 'name' => 'List Opportunity Panels', 'description' => 'List interview panels for an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_panel' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityPanel', 'type' => 'read', 'name' => 'Get Opportunity Panel', 'description' => 'Retrieve one interview panel.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_opportunity_panel' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateOpportunityPanel', 'type' => 'write', 'name' => 'Create Opportunity Panel', 'description' => 'Create an interview panel.', 'icon' => 'ph:pencil-simple'],
            'lever_update_opportunity_panel' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateOpportunityPanel', 'type' => 'write', 'name' => 'Update Opportunity Panel', 'description' => 'Update an interview panel.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_opportunity_panel' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteOpportunityPanel', 'type' => 'write', 'name' => 'Delete Opportunity Panel', 'description' => 'Delete an interview panel.', 'icon' => 'ph:trash'],
            'lever_list_opportunity_referrals' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityReferrals', 'type' => 'read', 'name' => 'List Opportunity Referrals', 'description' => 'List referrals for an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_opportunity_referral' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetOpportunityReferral', 'type' => 'read', 'name' => 'Get Opportunity Referral', 'description' => 'Retrieve one opportunity referral.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_opportunity_offers' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListOpportunityOffers', 'type' => 'read', 'name' => 'List Opportunity Offers', 'description' => 'List offers for an opportunity.', 'icon' => 'ph:magnifying-glass'],
            'lever_download_opportunity_offer' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDownloadOpportunityOffer', 'type' => 'read', 'name' => 'Download Opportunity Offer', 'description' => 'Download an opportunity offer file.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_data_postings' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListDataPostings', 'type' => 'read', 'name' => 'List Data Postings', 'description' => 'List authenticated Lever postings.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_data_posting' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetDataPosting', 'type' => 'read', 'name' => 'Get Data Posting', 'description' => 'Retrieve one authenticated Lever posting.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_data_posting' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateDataPosting', 'type' => 'write', 'name' => 'Create Data Posting', 'description' => 'Create a Lever posting.', 'icon' => 'ph:pencil-simple'],
            'lever_update_data_posting' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateDataPosting', 'type' => 'write', 'name' => 'Update Data Posting', 'description' => 'Update a Lever posting.', 'icon' => 'ph:pencil-simple'],
            'lever_list_deleted_postings' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListDeletedPostings', 'type' => 'read', 'name' => 'List Deleted Postings', 'description' => 'List deleted postings.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_posting_apply_form' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetPostingApplyForm', 'type' => 'read', 'name' => 'Get Posting Apply Form', 'description' => 'Retrieve a posting application form.', 'icon' => 'ph:magnifying-glass'],
            'lever_apply_data_posting' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverApplyDataPosting', 'type' => 'write', 'name' => 'Apply Data Posting', 'description' => 'Submit an application through the authenticated Lever Data API.', 'icon' => 'ph:paper-plane-tilt'],
            'lever_list_posting_users' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListPostingUsers', 'type' => 'read', 'name' => 'List Posting Users', 'description' => 'List users associated with a posting.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_diversity_survey' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetDiversitySurvey', 'type' => 'read', 'name' => 'Get Diversity Survey', 'description' => 'Retrieve diversity survey questions for a posting.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_users' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListUsers', 'type' => 'read', 'name' => 'List Users', 'description' => 'List Lever users.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_user' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'Retrieve one Lever user.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_user' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateUser', 'type' => 'write', 'name' => 'Create User', 'description' => 'Create a Lever user.', 'icon' => 'ph:pencil-simple'],
            'lever_update_user' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateUser', 'type' => 'write', 'name' => 'Update User', 'description' => 'Update a Lever user.', 'icon' => 'ph:pencil-simple'],
            'lever_deactivate_user' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeactivateUser', 'type' => 'write', 'name' => 'Deactivate User', 'description' => 'Deactivate a Lever user.', 'icon' => 'ph:pencil-simple'],
            'lever_reactivate_user' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverReactivateUser', 'type' => 'write', 'name' => 'Reactivate User', 'description' => 'Reactivate a Lever user.', 'icon' => 'ph:pencil-simple'],
            'lever_get_contact' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetContact', 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Retrieve one Lever contact.', 'icon' => 'ph:magnifying-glass'],
            'lever_update_contact' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateContact', 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update a Lever contact.', 'icon' => 'ph:pencil-simple'],
            'lever_list_archive_reasons' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListArchiveReasons', 'type' => 'read', 'name' => 'List Archive Reasons', 'description' => 'List archive reasons.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_archive_reason' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetArchiveReason', 'type' => 'read', 'name' => 'Get Archive Reason', 'description' => 'Retrieve one archive reason.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_stages' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListStages', 'type' => 'read', 'name' => 'List Stages', 'description' => 'List pipeline stages.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_stage' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetStage', 'type' => 'read', 'name' => 'Get Stage', 'description' => 'Retrieve one pipeline stage.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_disposition_stages' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListDispositionStages', 'type' => 'read', 'name' => 'List Disposition Stages', 'description' => 'List disposition stages.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_sources' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListSources', 'type' => 'read', 'name' => 'List Sources', 'description' => 'List source values.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_tags' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListTags', 'type' => 'read', 'name' => 'List Tags', 'description' => 'List tag values.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_audit_events' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListAuditEvents', 'type' => 'read', 'name' => 'List Audit Events', 'description' => 'List audit events.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_feedback_templates' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListFeedbackTemplates', 'type' => 'read', 'name' => 'List Feedback Templates', 'description' => 'List feedback templates.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_feedback_template' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetFeedbackTemplate', 'type' => 'read', 'name' => 'Get Feedback Template', 'description' => 'Retrieve one feedback template.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_feedback_template' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateFeedbackTemplate', 'type' => 'write', 'name' => 'Create Feedback Template', 'description' => 'Create a feedback template.', 'icon' => 'ph:pencil-simple'],
            'lever_update_feedback_template' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateFeedbackTemplate', 'type' => 'write', 'name' => 'Update Feedback Template', 'description' => 'Update a feedback template.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_feedback_template' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteFeedbackTemplate', 'type' => 'write', 'name' => 'Delete Feedback Template', 'description' => 'Delete a feedback template.', 'icon' => 'ph:trash'],
            'lever_list_form_templates' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListFormTemplates', 'type' => 'read', 'name' => 'List Form Templates', 'description' => 'List form templates.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_form_template' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetFormTemplate', 'type' => 'read', 'name' => 'Get Form Template', 'description' => 'Retrieve one form template.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_form_template' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateFormTemplate', 'type' => 'write', 'name' => 'Create Form Template', 'description' => 'Create a form template.', 'icon' => 'ph:pencil-simple'],
            'lever_update_form_template' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateFormTemplate', 'type' => 'write', 'name' => 'Update Form Template', 'description' => 'Update a form template.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_form_template' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteFormTemplate', 'type' => 'write', 'name' => 'Delete Form Template', 'description' => 'Delete a form template.', 'icon' => 'ph:trash'],
            'lever_list_profile_forms' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListProfileForms', 'type' => 'read', 'name' => 'List Profile Forms', 'description' => 'List profile forms.', 'icon' => 'ph:magnifying-glass'],
            'lever_list_requisitions' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListRequisitions', 'type' => 'read', 'name' => 'List Requisitions', 'description' => 'List requisitions.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_requisition' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetRequisition', 'type' => 'read', 'name' => 'Get Requisition', 'description' => 'Retrieve one requisition.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_requisition' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateRequisition', 'type' => 'write', 'name' => 'Create Requisition', 'description' => 'Create a requisition.', 'icon' => 'ph:pencil-simple'],
            'lever_update_requisition' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateRequisition', 'type' => 'write', 'name' => 'Update Requisition', 'description' => 'Update a requisition.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_requisition' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteRequisition', 'type' => 'write', 'name' => 'Delete Requisition', 'description' => 'Delete a requisition.', 'icon' => 'ph:trash'],
            'lever_list_requisition_fields' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListRequisitionFields', 'type' => 'read', 'name' => 'List Requisition Fields', 'description' => 'List requisition fields.', 'icon' => 'ph:magnifying-glass'],
            'lever_get_requisition_field' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverGetRequisitionField', 'type' => 'read', 'name' => 'Get Requisition Field', 'description' => 'Retrieve one requisition field.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_requisition_field' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateRequisitionField', 'type' => 'write', 'name' => 'Create Requisition Field', 'description' => 'Create a requisition field.', 'icon' => 'ph:pencil-simple'],
            'lever_update_requisition_field' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateRequisitionField', 'type' => 'write', 'name' => 'Update Requisition Field', 'description' => 'Update a requisition field.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_requisition_field' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteRequisitionField', 'type' => 'write', 'name' => 'Delete Requisition Field', 'description' => 'Delete a requisition field.', 'icon' => 'ph:trash'],
            'lever_create_requisition_field_option' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateRequisitionFieldOption', 'type' => 'write', 'name' => 'Create Requisition Field Option', 'description' => 'Create a requisition field option.', 'icon' => 'ph:pencil-simple'],
            'lever_update_requisition_field_options' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateRequisitionFieldOptions', 'type' => 'write', 'name' => 'Update Requisition Field Options', 'description' => 'Update requisition field options.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_requisition_field_options' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteRequisitionFieldOptions', 'type' => 'write', 'name' => 'Delete Requisition Field Options', 'description' => 'Delete requisition field options.', 'icon' => 'ph:trash'],
            'lever_create_upload' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateUpload', 'type' => 'write', 'name' => 'Create Upload', 'description' => 'Create an upload for files used by Lever records.', 'icon' => 'ph:pencil-simple'],
            'lever_list_webhooks' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListWebhooks', 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List webhooks.', 'icon' => 'ph:magnifying-glass'],
            'lever_create_webhook' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverCreateWebhook', 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a webhook.', 'icon' => 'ph:pencil-simple'],
            'lever_update_webhooks' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverUpdateWebhooks', 'type' => 'write', 'name' => 'Update Webhooks', 'description' => 'Update one or more API-created webhooks.', 'icon' => 'ph:pencil-simple'],
            'lever_delete_webhook' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverDeleteWebhook', 'type' => 'write', 'name' => 'Delete Webhook', 'description' => 'Delete a webhook.', 'icon' => 'ph:trash'],
            'lever_list_eeo_responses_pii' => ['class' => 'OpenCompany\Integrations\Lever\Tools\LeverListEeoResponsesPii', 'type' => 'read', 'name' => 'List Eeo Responses Pii', 'description' => 'List EEO response PII records.', 'icon' => 'ph:magnifying-glass'],
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Postings API Key', 'placeholder' => 'Lever Postings API key', 'hint' => 'Required only for submitting applications.', 'required' => false],
            ['key' => 'site', 'type' => 'text', 'label' => 'Test Site', 'placeholder' => 'lever', 'hint' => 'Lever site slug used by the connection test.', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.lever.co/v0/postings', 'hint' => 'Use https://api.eu.lever.co/v0/postings for EU Lever sites.', 'default' => 'https://api.lever.co/v0/postings'],
            ['key' => 'data_url', 'type' => 'url', 'label' => 'Data API Base URL', 'placeholder' => 'https://api.lever.co/v1', 'hint' => 'Use https://api.eu.lever.co/v1 for EU Lever accounts.', 'default' => 'https://api.lever.co/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Lever tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): LeverService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new LeverService(
                apiKey: $creds->get('lever', 'api_key', '', $account),
                baseUrl: $creds->get('lever', 'url', 'https://api.lever.co/v0/postings', $account),
                dataBaseUrl: $creds->get('lever', 'data_url', 'https://api.lever.co/v1', $account),
            );
        }

        return app(LeverService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/lever.md';
    }
}
