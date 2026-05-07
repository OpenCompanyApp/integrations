<?php

namespace OpenCompany\Integrations\Orcid;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Orcid\Tools\OrcidActivities;
use OpenCompany\Integrations\Orcid\Tools\OrcidAddress;
use OpenCompany\Integrations\Orcid\Tools\OrcidCsvSearch;
use OpenCompany\Integrations\Orcid\Tools\OrcidDistinction;
use OpenCompany\Integrations\Orcid\Tools\OrcidDistinctions;
use OpenCompany\Integrations\Orcid\Tools\OrcidEducation;
use OpenCompany\Integrations\Orcid\Tools\OrcidEducations;
use OpenCompany\Integrations\Orcid\Tools\OrcidEmployment;
use OpenCompany\Integrations\Orcid\Tools\OrcidEmployments;
use OpenCompany\Integrations\Orcid\Tools\OrcidExpandedSearch;
use OpenCompany\Integrations\Orcid\Tools\OrcidExternalIdentifiers;
use OpenCompany\Integrations\Orcid\Tools\OrcidFunding;
use OpenCompany\Integrations\Orcid\Tools\OrcidFundings;
use OpenCompany\Integrations\Orcid\Tools\OrcidInvitedPosition;
use OpenCompany\Integrations\Orcid\Tools\OrcidInvitedPositions;
use OpenCompany\Integrations\Orcid\Tools\OrcidKeywords;
use OpenCompany\Integrations\Orcid\Tools\OrcidMembership;
use OpenCompany\Integrations\Orcid\Tools\OrcidMemberships;
use OpenCompany\Integrations\Orcid\Tools\OrcidOtherNames;
use OpenCompany\Integrations\Orcid\Tools\OrcidPeerReview;
use OpenCompany\Integrations\Orcid\Tools\OrcidPeerReviews;
use OpenCompany\Integrations\Orcid\Tools\OrcidPerson;
use OpenCompany\Integrations\Orcid\Tools\OrcidPersonalDetails;
use OpenCompany\Integrations\Orcid\Tools\OrcidQualification;
use OpenCompany\Integrations\Orcid\Tools\OrcidQualifications;
use OpenCompany\Integrations\Orcid\Tools\OrcidRecord;
use OpenCompany\Integrations\Orcid\Tools\OrcidResearcherUrls;
use OpenCompany\Integrations\Orcid\Tools\OrcidSearch;
use OpenCompany\Integrations\Orcid\Tools\OrcidServiceItem;
use OpenCompany\Integrations\Orcid\Tools\OrcidServices;
use OpenCompany\Integrations\Orcid\Tools\OrcidWork;
use OpenCompany\Integrations\Orcid\Tools\OrcidWorks;

/**
 * Tool catalog and metadata for ORCID.
 *
 * Exposes current public ORCID API v3.0 search, expanded search, record, person,
 * activities, affiliation, funding, peer-review, and work endpoints.
 */
class OrcidToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'strategy' => 'none',
                'legacy_auth_type' => 'none',
                'credential_mode' => 'none',
                'setup_flows' => ['none'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Public ORCID data can be read without host setup in current public API behavior. Pass access_token per call when using an ORCID /read-public bearer token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'orcid';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'ORCID',
            'description' => 'Researcher identifiers, public profiles, works, affiliations, funding, and peer reviews',
            'icon' => 'ph:identification-card',
            'logo' => 'simple-icons:orcid',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'ORCID',
            'description' => 'ORCID Public API v3.0 for searching researchers and reading public records, profile sections, activities, works, affiliations, funding, peer reviews, and identifiers.',
            'icon' => 'ph:identification-card',
            'logo' => 'simple-icons:orcid',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://info.orcid.org/documentation/api-tutorials/api-tutorial-read-data-on-a-record/',
        ];
    }

    public function tools(): array
    {
        return [
            'orcid_search' => ['class' => OrcidSearch::class, 'type' => 'read', 'name' => 'Search', 'description' => 'Search the ORCID registry using Solr syntax.', 'icon' => 'ph:magnifying-glass'],
            'orcid_expanded_search' => ['class' => OrcidExpandedSearch::class, 'type' => 'read', 'name' => 'Expanded Search', 'description' => 'Search ORCID and return expanded identity/affiliation fields.', 'icon' => 'ph:user-list'],
            'orcid_csv_search' => ['class' => OrcidCsvSearch::class, 'type' => 'read', 'name' => 'CSV Search', 'description' => 'Search ORCID and return CSV output columns.', 'icon' => 'ph:file-csv'],
            'orcid_record' => ['class' => OrcidRecord::class, 'type' => 'read', 'name' => 'Record', 'description' => 'Read a full public ORCID record summary.', 'icon' => 'ph:identification-card'],
            'orcid_person' => ['class' => OrcidPerson::class, 'type' => 'read', 'name' => 'Person', 'description' => 'Read the public person section.', 'icon' => 'ph:user'],
            'orcid_personal_details' => ['class' => OrcidPersonalDetails::class, 'type' => 'read', 'name' => 'Personal Details', 'description' => 'Read public personal details.', 'icon' => 'ph:user-circle'],
            'orcid_address' => ['class' => OrcidAddress::class, 'type' => 'read', 'name' => 'Address', 'description' => 'Read public address/country data.', 'icon' => 'ph:map-pin'],
            'orcid_keywords' => ['class' => OrcidKeywords::class, 'type' => 'read', 'name' => 'Keywords', 'description' => 'Read public keywords.', 'icon' => 'ph:tag'],
            'orcid_external_identifiers' => ['class' => OrcidExternalIdentifiers::class, 'type' => 'read', 'name' => 'External Identifiers', 'description' => 'Read public external identifiers.', 'icon' => 'ph:link'],
            'orcid_researcher_urls' => ['class' => OrcidResearcherUrls::class, 'type' => 'read', 'name' => 'Researcher URLs', 'description' => 'Read public researcher URLs.', 'icon' => 'ph:globe'],
            'orcid_other_names' => ['class' => OrcidOtherNames::class, 'type' => 'read', 'name' => 'Other Names', 'description' => 'Read public other names.', 'icon' => 'ph:text-aa'],
            'orcid_activities' => ['class' => OrcidActivities::class, 'type' => 'read', 'name' => 'Activities', 'description' => 'Read public activities summary.', 'icon' => 'ph:activity'],
            'orcid_works' => ['class' => OrcidWorks::class, 'type' => 'read', 'name' => 'Works', 'description' => 'Read public works summary groups.', 'icon' => 'ph:article'],
            'orcid_work' => ['class' => OrcidWork::class, 'type' => 'read', 'name' => 'Work', 'description' => 'Read one public work by put code.', 'icon' => 'ph:file-text'],
            'orcid_employments' => ['class' => OrcidEmployments::class, 'type' => 'read', 'name' => 'Employments', 'description' => 'Read public employment summaries.', 'icon' => 'ph:briefcase'],
            'orcid_employment' => ['class' => OrcidEmployment::class, 'type' => 'read', 'name' => 'Employment', 'description' => 'Read one public employment by put code.', 'icon' => 'ph:briefcase'],
            'orcid_educations' => ['class' => OrcidEducations::class, 'type' => 'read', 'name' => 'Educations', 'description' => 'Read public education summaries.', 'icon' => 'ph:graduation-cap'],
            'orcid_education' => ['class' => OrcidEducation::class, 'type' => 'read', 'name' => 'Education', 'description' => 'Read one public education by put code.', 'icon' => 'ph:graduation-cap'],
            'orcid_qualifications' => ['class' => OrcidQualifications::class, 'type' => 'read', 'name' => 'Qualifications', 'description' => 'Read public qualification summaries.', 'icon' => 'ph:certificate'],
            'orcid_qualification' => ['class' => OrcidQualification::class, 'type' => 'read', 'name' => 'Qualification', 'description' => 'Read one public qualification by put code.', 'icon' => 'ph:certificate'],
            'orcid_invited_positions' => ['class' => OrcidInvitedPositions::class, 'type' => 'read', 'name' => 'Invited Positions', 'description' => 'Read public invited-position summaries.', 'icon' => 'ph:chair'],
            'orcid_invited_position' => ['class' => OrcidInvitedPosition::class, 'type' => 'read', 'name' => 'Invited Position', 'description' => 'Read one public invited position by put code.', 'icon' => 'ph:chair'],
            'orcid_distinctions' => ['class' => OrcidDistinctions::class, 'type' => 'read', 'name' => 'Distinctions', 'description' => 'Read public distinction summaries.', 'icon' => 'ph:medal'],
            'orcid_distinction' => ['class' => OrcidDistinction::class, 'type' => 'read', 'name' => 'Distinction', 'description' => 'Read one public distinction by put code.', 'icon' => 'ph:medal'],
            'orcid_memberships' => ['class' => OrcidMemberships::class, 'type' => 'read', 'name' => 'Memberships', 'description' => 'Read public membership summaries.', 'icon' => 'ph:users-three'],
            'orcid_membership' => ['class' => OrcidMembership::class, 'type' => 'read', 'name' => 'Membership', 'description' => 'Read one public membership by put code.', 'icon' => 'ph:users-three'],
            'orcid_services' => ['class' => OrcidServices::class, 'type' => 'read', 'name' => 'Services', 'description' => 'Read public service summaries.', 'icon' => 'ph:handshake'],
            'orcid_service' => ['class' => OrcidServiceItem::class, 'type' => 'read', 'name' => 'Service', 'description' => 'Read one public service by put code.', 'icon' => 'ph:handshake'],
            'orcid_fundings' => ['class' => OrcidFundings::class, 'type' => 'read', 'name' => 'Fundings', 'description' => 'Read public funding summaries.', 'icon' => 'ph:hand-coins'],
            'orcid_funding' => ['class' => OrcidFunding::class, 'type' => 'read', 'name' => 'Funding', 'description' => 'Read one public funding by put code.', 'icon' => 'ph:hand-coins'],
            'orcid_peer_reviews' => ['class' => OrcidPeerReviews::class, 'type' => 'read', 'name' => 'Peer Reviews', 'description' => 'Read public peer-review summaries.', 'icon' => 'ph:check-circle'],
            'orcid_peer_review' => ['class' => OrcidPeerReview::class, 'type' => 'read', 'name' => 'Peer Review', 'description' => 'Read one public peer review by put code.', 'icon' => 'ph:check-circle'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return [];
    }

    /**
     * Create an ORCID tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(OrcidService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/orcid.md';
    }
}
