<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\HuggingFace;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Huggingface\HuggingfaceToolProvider as LegacyHuggingFaceToolProvider;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;
use OpenCompany\Integrations\HuggingFace\HuggingFaceToolProvider;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceApiGet;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceCreateRepo;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListModels;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListTree;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Hugging Face Hub API coverage.
 */
final class HuggingFaceServiceTest extends TestCase
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

    public function test_service_maps_hub_repo_and_inference_endpoints(): void
    {
        Http::fake([
            'https://huggingface.co/api/*' => Http::response(['ok' => true], 200),
            'https://router.huggingface.co/hf-inference/models/*' => Http::response([['generated_text' => 'Hello']], 200),
        ]);

        $service = new HuggingFaceService('hf_test');

        $service->getCurrentUser();
        $service->listModels(['search' => 'bert']);
        $service->getModel('meta-llama/Llama-3.3-70B-Instruct');
        $service->listDatasets(['search' => 'voice']);
        $service->getDataset('mozilla-foundation/common_voice_17_0');
        $service->listSpaces(['search' => 'chat']);
        $service->getSpace('organization/demo-space');
        $service->listCommits('models', 'meta-llama/Llama-3.3-70B-Instruct', 'main');
        $service->listRefs('datasets', 'mozilla-foundation/common_voice_17_0');
        $service->listTree('spaces', 'organization/demo-space', 'main', 'src', ['recursive' => true]);
        $service->getScanStatus('model', 'bert-base-uncased');
        $service->listModelTags();
        $service->listDatasetTags();
        $service->listSpaceHardware();
        $service->createRepo(['name' => 'demo', 'type' => 'model']);
        $service->apiGet('/models-tags-by-type');
        $service->apiPost('/repos/create', ['name' => 'demo', 'type' => 'model']);
        $service->apiPut('/settings/billing/email', ['email' => 'team@example.test']);
        $service->apiDelete('/repos/delete', ['name' => 'demo', 'type' => 'model']);
        $service->inference('facebook/bart-large-cnn', ['inputs' => 'Long text']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer hf_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://huggingface.co/api/whoami-v2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://huggingface.co/api/models/meta-llama/Llama-3.3-70B-Instruct');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://huggingface.co/api/datasets/mozilla-foundation/common_voice_17_0');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://huggingface.co/api/spaces/organization/demo-space');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://huggingface.co/api/models/meta-llama/Llama-3.3-70B-Instruct/commits/main');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://huggingface.co/api/datasets/mozilla-foundation/common_voice_17_0/refs');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://huggingface.co/api/spaces/organization/demo-space/tree/main/src?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://huggingface.co/api/models/bert-base-uncased/scan');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://huggingface.co/api/repos/create');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://huggingface.co/api/settings/billing/email');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://huggingface.co/api/repos/delete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://router.huggingface.co/hf-inference/models/facebook/bart-large-cnn');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://huggingface.co/api/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new HuggingFaceService('hf_test');

        self::assertTrue((new HuggingFaceListTree($service))->execute([
            'repo_type' => 'models',
            'repo_id' => 'bert-base-uncased',
        ])->succeeded());
        self::assertTrue((new HuggingFaceCreateRepo($service))->execute([
            'name' => 'demo',
            'type' => 'model',
        ])->succeeded());
        self::assertTrue((new HuggingFaceApiGet($service))->execute([
            'path' => '/models-tags-by-type',
        ])->succeeded());
        self::assertFalse((new HuggingFaceListTree($service))->execute([
            'repo_type' => 'models',
        ])->succeeded());
        self::assertFalse((new HuggingFaceApiGet($service))->execute([
            'path' => 'https://example.test/models',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://huggingface.co/api/whoami-v2' => Http::response(['name' => 'example-user'], 200),
        ]);

        $provider = new HuggingFaceToolProvider();
        $tools = $provider->tools();
        $composer = json_decode((string) file_get_contents(__DIR__.'/../../packages/hugging-face/composer.json'), true);

        self::assertSame('hugging-face', $provider->appName());
        self::assertSame('Hugging Face', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://huggingface.co/docs/hub/api', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('self.version', $composer['replace']['opencompanyapp/integration-huggingface'] ?? null);
        self::assertArrayHasKey('huggingface_get_dataset', $tools);
        self::assertArrayHasKey('huggingface_get_space', $tools);
        self::assertArrayHasKey('huggingface_list_commits', $tools);
        self::assertArrayHasKey('huggingface_list_tree', $tools);
        self::assertArrayHasKey('huggingface_list_model_tags', $tools);
        self::assertArrayHasKey('huggingface_create_repo', $tools);
        self::assertArrayHasKey('huggingface_api_delete', $tools);
        self::assertSame(20, count($tools));

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }

        self::assertTrue($provider->testConnection([
            'access_token' => 'hf_test',
        ])['success']);
    }

    public function test_legacy_provider_defers_to_canonical_hugging_face_namespace(): void
    {
        $provider = new LegacyHuggingFaceToolProvider;

        self::assertSame('hugging-face', $provider->appName());
        self::assertSame('Hugging Face', $provider->integrationMeta()['name']);
        self::assertCount(20, $provider->tools());
    }

    public function test_multi_account_resolution_supports_legacy_credentials(): void
    {
        Http::fake([
            'https://huggingface.example.test/api/models?search=bert' => Http::response([['id' => 'bert-base-uncased']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'hugging-face') {
                    return '';
                }

                $values = [
                    'access_token' => $account === 'work' ? 'legacy-hf-token' : 'legacy-default-token',
                    'url' => 'https://huggingface.example.test/api',
                    'inference_url' => 'https://router.example.test/models',
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

        $tool = (new HuggingFaceToolProvider)->createTool(HuggingFaceListModels::class, ['account' => 'work']);

        self::assertTrue($tool->execute(['search' => 'bert'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://huggingface.example.test/api/models?search=bert'
            && $request->hasHeader('Authorization', 'Bearer legacy-hf-token'));
    }
}
