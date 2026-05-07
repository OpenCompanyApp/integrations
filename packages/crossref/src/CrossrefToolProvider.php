<?php

namespace OpenCompany\Integrations\Crossref;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetFunder;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetJournal;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetMember;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetPrefix;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetType;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetWork;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetWorkAgency;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListFunderWorks;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListFunders;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListJournalWorks;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListJournals;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListLicenses;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListMemberWorks;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListMembers;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListPrefixWorks;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListTypes;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListTypeWorks;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListWorks;

/**
 * Tool catalog and metadata for Crossref.
 *
 * Exposes the documented public REST API endpoints for works, journals,
 * members, prefixes, funders, types, and licenses.
 */
class CrossrefToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['Crossref REST API is public. Pass mailto on list requests to use the polite pool.'],
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
        return 'crossref';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Crossref',
            'description' => 'DOI metadata, journals, members, funders, prefixes, types, and licenses',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:crossref',
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
            'name' => 'Crossref',
            'description' => 'Public Crossref REST API for DOI metadata, works, journals, members, funders, prefixes, work types, and licenses.',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:crossref',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.crossref.org/documentation/retrieve-metadata/rest-api/',
        ];
    }

    public function tools(): array
    {
        return [
            'crossref_list_works' => ['class' => CrossrefListWorks::class, 'type' => 'read', 'name' => 'List Works', 'description' => 'List, search, filter, facet, sample, or page Crossref works.', 'icon' => 'ph:article'],
            'crossref_get_work' => ['class' => CrossrefGetWork::class, 'type' => 'read', 'name' => 'Get Work', 'description' => 'Get one Crossref work by DOI.', 'icon' => 'ph:article'],
            'crossref_get_work_agency' => ['class' => CrossrefGetWorkAgency::class, 'type' => 'read', 'name' => 'Get Work Agency', 'description' => 'Get DOI registration agency.', 'icon' => 'ph:stamp'],
            'crossref_list_journals' => ['class' => CrossrefListJournals::class, 'type' => 'read', 'name' => 'List Journals', 'description' => 'List Crossref journals.', 'icon' => 'ph:book-open'],
            'crossref_get_journal' => ['class' => CrossrefGetJournal::class, 'type' => 'read', 'name' => 'Get Journal', 'description' => 'Get journal details by ISSN.', 'icon' => 'ph:book-open'],
            'crossref_list_journal_works' => ['class' => CrossrefListJournalWorks::class, 'type' => 'read', 'name' => 'Journal Works', 'description' => 'List works in a journal.', 'icon' => 'ph:files'],
            'crossref_list_members' => ['class' => CrossrefListMembers::class, 'type' => 'read', 'name' => 'List Members', 'description' => 'List Crossref members.', 'icon' => 'ph:buildings'],
            'crossref_get_member' => ['class' => CrossrefGetMember::class, 'type' => 'read', 'name' => 'Get Member', 'description' => 'Get member details.', 'icon' => 'ph:building'],
            'crossref_list_member_works' => ['class' => CrossrefListMemberWorks::class, 'type' => 'read', 'name' => 'Member Works', 'description' => 'List works for a member.', 'icon' => 'ph:files'],
            'crossref_get_prefix' => ['class' => CrossrefGetPrefix::class, 'type' => 'read', 'name' => 'Get Prefix', 'description' => 'Get prefix steward.', 'icon' => 'ph:number-circle-one'],
            'crossref_list_prefix_works' => ['class' => CrossrefListPrefixWorks::class, 'type' => 'read', 'name' => 'Prefix Works', 'description' => 'List works for a prefix.', 'icon' => 'ph:files'],
            'crossref_list_funders' => ['class' => CrossrefListFunders::class, 'type' => 'read', 'name' => 'List Funders', 'description' => 'List funders.', 'icon' => 'ph:hand-coins'],
            'crossref_get_funder' => ['class' => CrossrefGetFunder::class, 'type' => 'read', 'name' => 'Get Funder', 'description' => 'Get funder details.', 'icon' => 'ph:hand-coins'],
            'crossref_list_funder_works' => ['class' => CrossrefListFunderWorks::class, 'type' => 'read', 'name' => 'Funder Works', 'description' => 'List works for a funder.', 'icon' => 'ph:files'],
            'crossref_list_types' => ['class' => CrossrefListTypes::class, 'type' => 'read', 'name' => 'List Types', 'description' => 'List work types.', 'icon' => 'ph:list-bullets'],
            'crossref_get_type' => ['class' => CrossrefGetType::class, 'type' => 'read', 'name' => 'Get Type', 'description' => 'Get work type details.', 'icon' => 'ph:list-bullets'],
            'crossref_list_type_works' => ['class' => CrossrefListTypeWorks::class, 'type' => 'read', 'name' => 'Type Works', 'description' => 'List works for a type.', 'icon' => 'ph:files'],
            'crossref_list_licenses' => ['class' => CrossrefListLicenses::class, 'type' => 'read', 'name' => 'List Licenses', 'description' => 'List licenses.', 'icon' => 'ph:certificate'],
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
     * Create a Crossref tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(CrossrefService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/crossref.md';
    }
}
