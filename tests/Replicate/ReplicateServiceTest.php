<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Replicate;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Replicate\ReplicateOperations;
use OpenCompany\Integrations\Replicate\ReplicateService;
use OpenCompany\Integrations\Replicate\ReplicateToolProvider;
use OpenCompany\Integrations\Replicate\Tools\ReplicateCreateFile;
use OpenCompany\Integrations\Replicate\Tools\ReplicateCreatePrediction;
use OpenCompany\Integrations\Replicate\Tools\ReplicateGetModel;
use OpenCompany\Integrations\Replicate\Tools\ReplicateSearchModels;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Replicate official OpenAPI operation coverage.
 */
final class ReplicateServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ReplicateService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ReplicateService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_official_openapi_surface(): void
    {
        $provider = new ReplicateToolProvider;

        self::assertSame('replicate', $provider->appName());
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://api.replicate.com/openapi.json', $provider->integrationMeta()['source_url']);
        self::assertCount(37, ReplicateOperations::all());
        self::assertCount(37, $provider->tools());
        self::assertArrayHasKey('replicate_get_account', $provider->tools());
        self::assertArrayHasKey('replicate_create_deployment_prediction', $provider->tools());
        self::assertArrayHasKey('replicate_create_file', $provider->tools());
        self::assertArrayHasKey('replicate_search_models', $provider->tools());
        self::assertArrayNotHasKey('replicate_get_current_user', $provider->tools());
    }

    public function test_path_replacement_headers_and_loose_body_arguments(): void
    {
        $service = new ReplicateService('token-123', 'https://api.example.test/v1');

        Http::fake(['*' => Http::response(['owner' => 'black-forest-labs', 'name' => 'flux-schnell'], 200)]);
        self::assertTrue((new ReplicateGetModel($service))->execute([
            'model_owner' => 'black-forest-labs',
            'model_name' => 'flux-schnell',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v1/models/black-forest-labs/flux-schnell'
            && $request->hasHeader('Authorization', 'Bearer token-123'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'prediction-1'], 201)]);
        self::assertTrue((new ReplicateCreatePrediction($service))->execute([
            'version' => 'version-123',
            'input' => ['prompt' => 'hello'],
            'prefer' => 'wait',
            'cancel_after' => '30s',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v1/predictions'
            && $request->hasHeader('Prefer', 'wait')
            && $request->hasHeader('Cancel-After', '30s')
            && $request['version'] === 'version-123'
            && $request['input'] === ['prompt' => 'hello']);
    }

    public function test_query_method_and_multipart_file_upload(): void
    {
        $service = new ReplicateService('token-123', 'https://api.example.test/v1');

        Http::fake(['*' => Http::response(['results' => []], 200)]);
        self::assertTrue((new ReplicateSearchModels($service))->execute([
            'body' => 'image generation',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'QUERY'
            && $request->url() === 'https://api.example.test/v1/models'
            && $request->body() === 'image generation');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'file-1'], 201)]);
        self::assertTrue((new ReplicateCreateFile($service))->execute([
            'body' => [
                'content' => 'file bytes',
                'filename' => 'example.txt',
                'type' => 'text/plain',
                'metadata' => ['source' => 'test'],
            ],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v1/files'
            && str_contains($request->body(), 'file bytes')
            && str_contains($request->body(), 'example.txt'));
    }

    public function test_multi_account_resolution_uses_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['username' => 'workspace'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['replicate', 'api_key', 'workspace'] => 'account-token',
                    ['replicate', 'url', 'workspace'] => 'https://account.example.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'replicate' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'replicate' ? ['workspace'] : [];
            }
        });

        $tool = (new ReplicateToolProvider)->createTool(\OpenCompany\Integrations\Replicate\Tools\ReplicateGetAccount::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account.example.test/v1/account'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
