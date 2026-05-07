<?php

namespace OpenCompany\Integrations\OpenLibrary;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryAuthor;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryAuthorWorks;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryBooks;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryCoverUrl;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryEdition;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryIsbn;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryRecentChanges;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibrarySearchAuthors;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibrarySearchBooks;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibrarySubject;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryWork;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryWorkBookshelves;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryWorkEditions;
use OpenCompany\Integrations\OpenLibrary\Tools\OpenLibraryWorkRatings;

/**
 * Tool catalog and metadata for Open Library.
 *
 * Exposes public read-only APIs for book search, work and edition metadata,
 * author records, subjects, recent changes, legacy bibkey lookups, and covers.
 */
class OpenLibraryToolProvider implements ToolProvider, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'none', 'legacy_auth_type' => 'none', 'credential_mode' => 'none', 'setup_flows' => ['none'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['Open Library public read APIs require no credentials.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'open-library';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return ['label' => 'Open Library', 'description' => 'Open book, work, edition, author, subject, ISBN, and cover metadata', 'icon' => 'ph:books', 'logo' => 'ph:books'];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return ['name' => 'Open Library', 'description' => 'Open Library public APIs for book search, author search, works, editions, ISBNs, bibkeys, subjects, covers, and recent changes.', 'icon' => 'ph:books', 'logo' => 'ph:books', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://openlibrary.org/developers/api'];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'open_library_search_books' => ['class' => OpenLibrarySearchBooks::class, 'type' => 'read', 'name' => 'Search Books', 'description' => 'Search books and works.', 'icon' => 'ph:magnifying-glass'],
            'open_library_search_authors' => ['class' => OpenLibrarySearchAuthors::class, 'type' => 'read', 'name' => 'Search Authors', 'description' => 'Search authors.', 'icon' => 'ph:user-list'],
            'open_library_work' => ['class' => OpenLibraryWork::class, 'type' => 'read', 'name' => 'Work', 'description' => 'Get one work by ID.', 'icon' => 'ph:book-open'],
            'open_library_work_editions' => ['class' => OpenLibraryWorkEditions::class, 'type' => 'read', 'name' => 'Work Editions', 'description' => 'List editions for a work.', 'icon' => 'ph:books'],
            'open_library_work_ratings' => ['class' => OpenLibraryWorkRatings::class, 'type' => 'read', 'name' => 'Work Ratings', 'description' => 'Get work ratings.', 'icon' => 'ph:star'],
            'open_library_work_bookshelves' => ['class' => OpenLibraryWorkBookshelves::class, 'type' => 'read', 'name' => 'Work Bookshelves', 'description' => 'Get work bookshelf counts.', 'icon' => 'ph:bookshelf'],
            'open_library_edition' => ['class' => OpenLibraryEdition::class, 'type' => 'read', 'name' => 'Edition', 'description' => 'Get one edition by ID.', 'icon' => 'ph:book'],
            'open_library_isbn' => ['class' => OpenLibraryIsbn::class, 'type' => 'read', 'name' => 'ISBN', 'description' => 'Get an edition by ISBN.', 'icon' => 'ph:barcode'],
            'open_library_books' => ['class' => OpenLibraryBooks::class, 'type' => 'read', 'name' => 'Books API', 'description' => 'Look up books by ISBN, LCCN, OCLC, or OLID bibkeys.', 'icon' => 'ph:identification-card'],
            'open_library_author' => ['class' => OpenLibraryAuthor::class, 'type' => 'read', 'name' => 'Author', 'description' => 'Get one author by ID.', 'icon' => 'ph:user'],
            'open_library_author_works' => ['class' => OpenLibraryAuthorWorks::class, 'type' => 'read', 'name' => 'Author Works', 'description' => 'List works by an author.', 'icon' => 'ph:stack'],
            'open_library_subject' => ['class' => OpenLibrarySubject::class, 'type' => 'read', 'name' => 'Subject', 'description' => 'List works for a subject.', 'icon' => 'ph:tag'],
            'open_library_recent_changes' => ['class' => OpenLibraryRecentChanges::class, 'type' => 'read', 'name' => 'Recent Changes', 'description' => 'List recent Open Library changes.', 'icon' => 'ph:clock-counter-clockwise'],
            'open_library_cover_url' => ['class' => OpenLibraryCoverUrl::class, 'type' => 'read', 'name' => 'Cover URL', 'description' => 'Build a cover image URL.', 'icon' => 'ph:image'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an Open Library tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(OpenLibraryService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/open-library.md';
    }
}
