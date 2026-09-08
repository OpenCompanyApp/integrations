<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenLibrary;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\OpenLibrary\OpenLibraryService;
use OpenCompany\Integrations\OpenLibrary\OpenLibraryToolProvider;
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
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Open Library integration.
 */
final class OpenLibraryServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenLibraryService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenLibraryService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new OpenLibraryToolProvider;

        self::assertSame('open-library', $provider->appName());
        self::assertSame('Open Library', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(14, $provider->tools());
    }

    public function test_search_books_and_authors_are_mapped(): void
    {
        $service = new OpenLibraryService(baseUrl: 'https://ol.example.test');

        Http::fake(['*' => Http::response(['num_found' => 1, 'docs' => [['title' => 'Example']]], 200)]);
        self::assertTrue((new OpenLibrarySearchBooks($service))->execute(['q' => 'hobbit', 'fields' => 'key,title', 'limit' => 5])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ol.example.test/search.json?q=hobbit&fields=key%2Ctitle&limit=5');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['numFound' => 1, 'docs' => [['name' => 'J. K. Rowling']]], 200)]);
        self::assertTrue((new OpenLibrarySearchAuthors($service))->execute(['q' => 'rowling', 'limit' => 10])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ol.example.test/search/authors.json?q=rowling&limit=10');
    }

    public function test_work_edition_isbn_books_and_author_paths_are_mapped(): void
    {
        $service = new OpenLibraryService(baseUrl: 'https://ol.example.test');

        $cases = [
            [OpenLibraryWork::class, ['id' => '/works/OL45804W'], 'https://ol.example.test/works/OL45804W.json'],
            [OpenLibraryWorkEditions::class, ['id' => 'OL45804W', 'limit' => 2], 'https://ol.example.test/works/OL45804W/editions.json?limit=2'],
            [OpenLibraryWorkRatings::class, ['id' => 'OL45804W'], 'https://ol.example.test/works/OL45804W/ratings.json'],
            [OpenLibraryWorkBookshelves::class, ['id' => 'OL45804W'], 'https://ol.example.test/works/OL45804W/bookshelves.json'],
            [OpenLibraryEdition::class, ['id' => '/books/OL7353617M'], 'https://ol.example.test/books/OL7353617M.json'],
            [OpenLibraryIsbn::class, ['isbn' => '9780140328721'], 'https://ol.example.test/isbn/9780140328721.json'],
            [OpenLibraryAuthor::class, ['id' => '/authors/OL23919A'], 'https://ol.example.test/authors/OL23919A.json'],
            [OpenLibraryAuthorWorks::class, ['id' => 'OL23919A', 'offset' => 50], 'https://ol.example.test/authors/OL23919A/works.json?offset=50'],
        ];

        foreach ($cases as [$class, $args, $url]) {
            Http::swap(new HttpFactory);
            Http::fake(['*' => Http::response(['key' => 'ok'], 200)]);
            self::assertTrue((new $class($service))->execute($args)->succeeded());
            Http::assertSent(static fn (Request $request): bool => $request->url() === $url);
        }

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['ISBN:0451526538' => ['title' => '1984']], 200)]);
        self::assertTrue((new OpenLibraryBooks($service))->execute(['bibkeys' => 'ISBN:0451526538', 'jscmd' => 'data'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ol.example.test/api/books?bibkeys=ISBN%3A0451526538&format=json&jscmd=data');
    }

    public function test_subject_recent_changes_cover_url_validation_and_provider_creation(): void
    {
        $service = new OpenLibraryService(baseUrl: 'https://ol.example.test', coversBaseUrl: 'https://covers.example.test');

        Http::fake(['*' => Http::response(['name' => 'love', 'works' => []], 200)]);
        self::assertTrue((new OpenLibrarySubject($service))->execute(['subject' => 'Science Fiction', 'details' => true, 'limit' => 3])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ol.example.test/subjects/science_fiction.json?limit=3&details=true');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['kind' => 'merge-authors']], 200)]);
        self::assertTrue((new OpenLibraryRecentChanges($service))->execute(['year' => '2010', 'month' => '08', 'kind' => 'merge-authors', 'bot' => false, 'limit' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ol.example.test/recentchanges/2010/08/merge-authors.json?limit=1&bot=false');

        $cover = (new OpenLibraryCoverUrl($service))->execute(['type' => 'isbn', 'value' => '9780140328721', 'size' => 'L']);
        self::assertTrue($cover->succeeded());
        self::assertSame('https://covers.example.test/b/isbn/9780140328721-L.jpg', $cover->data['url']);

        $missing = (new OpenLibrarySearchBooks($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('q, title, or author is required', (string) $missing->error);

        $badCover = (new OpenLibraryCoverUrl($service))->execute(['type' => 'bad', 'value' => 'x']);
        self::assertFalse($badCover->succeeded());
        self::assertStringContainsString('type must be one of', (string) $badCover->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['error' => 'not found'], 404)]);
        $notFound = (new OpenLibraryWork($service))->execute(['id' => 'missing']);
        self::assertFalse($notFound->succeeded());
        self::assertStringContainsString('not found', (string) $notFound->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['title' => 'Example'], 200)]);
        app()->instance(OpenLibraryService::class, new OpenLibraryService(baseUrl: 'https://ol.example.test'));
        $tool = (new OpenLibraryToolProvider)->createTool(OpenLibraryWork::class);
        self::assertTrue($tool->execute(['id' => 'OL45804W'])->succeeded());
    }
}
