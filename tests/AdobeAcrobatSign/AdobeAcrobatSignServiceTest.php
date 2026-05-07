<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AdobeAcrobatSign;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\AdobeAcrobatSign\AdobeAcrobatSignOperations;
use OpenCompany\Integrations\AdobeAcrobatSign\AdobeAcrobatSignService;
use OpenCompany\Integrations\AdobeAcrobatSign\AdobeAcrobatSignToolProvider;
use OpenCompany\Integrations\AdobeAcrobatSign\Tools\AdobeAcrobatSignAgreementsCreateAgreement;
use OpenCompany\Integrations\AdobeAcrobatSign\Tools\AdobeAcrobatSignAgreementsGetAgreementInfo;
use OpenCompany\Integrations\AdobeAcrobatSign\Tools\AdobeAcrobatSignBaseUrisGetBaseUris;
use OpenCompany\Integrations\AdobeAcrobatSign\Tools\AdobeAcrobatSignTransientDocumentsCreateTransientDocument;
use OpenCompany\Integrations\AdobeAcrobatSign\Tools\AdobeAcrobatSignUsersGetUsers;
use PHPUnit\Framework\TestCase;

final class AdobeAcrobatSignServiceTest extends TestCase
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
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_matches_official_swagger_manifest_and_docs(): void
    {
        $provider = new AdobeAcrobatSignToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/adobe-acrobat-sign/adobe-acrobat-sign-openapi-manifest.json'), true);

        self::assertSame('adobe-acrobat-sign', $provider->appName());
        self::assertSame('Adobe Acrobat Sign', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertStringContainsString('github.com/adobe/acrobat-sign', $provider->integrationMeta()['source_url']);
        self::assertSame(92, $manifest['method_count']);
        self::assertCount($manifest['method_count'], AdobeAcrobatSignOperations::all());
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertArrayHasKey('adobe_acrobat_sign_base_uris_get_base_uris', $provider->tools());
        self::assertArrayHasKey('adobe_acrobat_sign_agreements_create_agreement', $provider->tools());
        self::assertArrayHasKey('adobe_acrobat_sign_transient_documents_create_transient_document', $provider->tools());
        self::assertArrayHasKey('adobe_acrobat_sign_webhooks_create_webhook', $provider->tools());
    }

    public function test_service_maps_bearer_auth_path_query_headers_and_body(): void
    {
        Http::fake([
            'https://sign.example.test/api/rest/v6/agreements/agr%201' => Http::response(['id' => 'agr 1'], 200),
            'https://sign.example.test/api/rest/v6/agreements*' => Http::response(['agreementId' => 'agr-created'], 200),
        ]);

        $service = new AdobeAcrobatSignService('access-token', 'https://sign.example.test/api/rest/v6');

        self::assertSame(['id' => 'agr 1'], $service->request('GET', '/agreements/{agreementId}', ['agreementId' => 'agr 1']));
        self::assertSame(['agreementId' => 'agr-created'], $service->request('POST', '/agreements', [], ['includeDrafts' => true], [
            'x-api-user' => 'email:agent@example.test',
        ], ['name' => 'Example agreement']));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sign.example.test/api/rest/v6/agreements/agr%201'
            && $request->hasHeader('Authorization', 'Bearer access-token'));
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'POST'
                && str_starts_with($request->url(), 'https://sign.example.test/api/rest/v6/agreements?')
                && ($query['includeDrafts'] ?? null) === 'true'
                && $request->hasHeader('x-api-user', 'email:agent@example.test')
                && $request['name'] === 'Example agreement';
        });
    }

    public function test_generated_tools_validate_and_map_arguments(): void
    {
        Http::fake([
            'https://sign.example.test/api/rest/v6/agreements/agr-1' => Http::response(['id' => 'agr-1'], 200),
            'https://sign.example.test/api/rest/v6/agreements' => Http::response(['agreementId' => 'agr-created'], 200),
            'https://sign.example.test/api/rest/v6/transientDocuments' => Http::response(['transientDocumentId' => 'td-1'], 200),
        ]);

        $service = new AdobeAcrobatSignService('access-token', 'https://sign.example.test/api/rest/v6');

        $get = new AdobeAcrobatSignAgreementsGetAgreementInfo($service);
        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('agreement_id must be a non-empty parameter.', $missing->error);

        $success = $get->execute(['agreement_id' => 'agr-1']);
        self::assertTrue($success->succeeded());
        self::assertSame('agr-1', $success->data['id']);

        $created = (new AdobeAcrobatSignAgreementsCreateAgreement($service))->execute(['body' => ['name' => 'Example agreement']]);
        self::assertTrue($created->succeeded());
        self::assertSame('agr-created', $created->data['agreementId']);

        $uploaded = (new AdobeAcrobatSignTransientDocumentsCreateTransientDocument($service))->execute([
            'file_name' => 'contract.pdf',
            'mime_type' => 'application/pdf',
            'file' => ['contents' => 'PDF', 'filename' => 'contract.pdf', 'mime_type' => 'application/pdf'],
        ]);
        self::assertTrue($uploaded->succeeded());
        self::assertSame('td-1', $uploaded->data['transientDocumentId']);
    }

    public function test_provider_connection_and_named_account_resolution(): void
    {
        Http::fake([
            'https://sign.example.test/api/rest/v6/baseUris' => Http::response(['apiAccessPoint' => 'https://sign.example.test/'], 200),
            'https://tenant-sign.example.test/api/rest/v6/users*' => Http::response(['userInfoList' => [['id' => 'user-1']]], 200),
        ]);

        $provider = new AdobeAcrobatSignToolProvider;
        self::assertTrue($provider->testConnection([
            'access_token' => 'direct-token',
            'api_url' => 'https://sign.example.test/api/rest/v6',
        ])['success']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'adobe-acrobat-sign' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-token',
                    'api_url' => 'https://tenant-sign.example.test/api/rest/v6',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'adobe-acrobat-sign' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'adobe-acrobat-sign' ? ['work'] : [];
            }
        });

        $tool = $provider->createTool(AdobeAcrobatSignUsersGetUsers::class, ['account' => 'work']);
        $result = $tool->execute(['page_size' => 10]);

        self::assertTrue($result->succeeded());
        self::assertSame('user-1', $result->data['userInfoList'][0]['id']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://tenant-sign.example.test/api/rest/v6/users?')
            && $request->hasHeader('Authorization', 'Bearer tenant-token'));
    }
}
