<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftOneNote;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftOneNote\MicrosoftOneNoteService;
use OpenCompany\Integrations\MicrosoftOneNote\MicrosoftOneNoteToolProvider;
use OpenCompany\Integrations\MicrosoftOneNote\Tools\MicrosoftOneNoteMeOnenoteCreatePages;
use OpenCompany\Integrations\MicrosoftOneNote\Tools\MicrosoftOneNoteMeOnenoteGetNotebooks;
use OpenCompany\Integrations\MicrosoftOneNote\Tools\MicrosoftOneNoteMeOnenoteListNotebooks;
use OpenCompany\Integrations\MicrosoftOneNote\Tools\MicrosoftOneNoteMeOnenoteListPages;
use OpenCompany\Integrations\MicrosoftOneNote\Tools\MicrosoftOneNoteMeOnenoteUpdatePagesContent;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft OneNote integration.
 */
final class MicrosoftOneNoteServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftOneNoteToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-onenote/microsoft-onenote-openapi-manifest.json'), true);

        self::assertSame(795, $manifest['method_count']);
        self::assertSame(30, $manifest['raw_body_operations']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft OneNote', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('microsoft_onenote_me_onenote_list_notebooks', array_keys($provider->tools()));
        self::assertContains('microsoft_onenote_me_onenote_list_pages', array_keys($provider->tools()));
        self::assertContains('microsoft_onenote_me_onenote_update_pages_content', array_keys($provider->tools()));
        self::assertContains('microsoft_onenote_groups_onenote_list_notebooks', array_keys($provider->tools()));
    }

    public function test_service_maps_json_and_raw_content_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftOneNoteService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/me/onenote/notebooks/{notebook-id}', ['notebook-id' => 'note 1'], ['$select' => 'id,displayName']);
        $service->request('POST', '/me/onenote/pages', [], [], ['Prefer' => 'return=representation'], ['title' => 'Launch']);
        $service->request('PUT', '/me/onenote/pages/{onenotePage-id}/content', ['onenotePage-id' => 'page 1'], [], [], ['content' => '<html></html>', 'content_type' => 'text/html'], 'raw');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/onenote/notebooks/note%201?%24select=id%2CdisplayName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/onenote/pages'
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->data()['title'] === 'Launch');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://graph.example.test/v1.0/me/onenote/pages/page%201/content'
            && $request->hasHeader('Content-Type', 'text/html')
            && $request->body() === '<html></html>');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftOneNoteService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftOneNoteMeOnenoteListNotebooks($service))->execute(['top' => 5])->succeeded());
        self::assertTrue((new MicrosoftOneNoteMeOnenoteGetNotebooks($service))->execute(['notebook_id' => 'notebook-123'])->succeeded());
        self::assertTrue((new MicrosoftOneNoteMeOnenoteListPages($service))->execute(['select' => 'id,title'])->succeeded());
        self::assertTrue((new MicrosoftOneNoteMeOnenoteCreatePages($service))->execute(['body' => ['title' => 'Launch']])->succeeded());
        self::assertTrue((new MicrosoftOneNoteMeOnenoteUpdatePagesContent($service))->execute(['onenote_page_id' => 'page-123', 'body' => ['content' => '<html></html>', 'content_type' => 'text/html']])->succeeded());

        $missingPath = (new MicrosoftOneNoteMeOnenoteGetNotebooks($service))->execute([]);
        $badBody = (new MicrosoftOneNoteMeOnenoteCreatePages($service))->execute(['body' => 'not-object']);
        $missingBody = (new MicrosoftOneNoteMeOnenoteCreatePages($service))->execute([]);
        $missingRawContent = (new MicrosoftOneNoteMeOnenoteUpdatePagesContent($service))->execute(['onenote_page_id' => 'page-123', 'body' => ['content_type' => 'text/html']]);
        $unconfigured = (new MicrosoftOneNoteMeOnenoteGetNotebooks(new MicrosoftOneNoteService('', 'https://graph.example.test/v1.0')))->execute(['notebook_id' => 'notebook-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('notebook_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($missingRawContent->succeeded());
        self::assertStringContainsString('body.content must be provided', (string) $missingRawContent->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_notebooks_probe(): void
    {
        Http::fake(['graph.example.test/v1.0/me/onenote/notebooks*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftOneNoteToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/onenote/notebooks?%24top=1'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = (new MicrosoftOneNoteToolProvider)->createTool(MicrosoftOneNoteMeOnenoteGetNotebooks::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['notebook_id' => 'notebook-123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
