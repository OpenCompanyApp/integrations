<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Mistral;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MistralAI\MistralAIToolProvider as LegacyMistralAIToolProvider;
use OpenCompany\Integrations\Mistral\MistralService;
use OpenCompany\Integrations\Mistral\MistralToolProvider;
use OpenCompany\Integrations\Mistral\Tools\MistralChatCompletions;
use OpenCompany\Integrations\Mistral\Tools\MistralGetAgentVersion;
use OpenCompany\Integrations\Mistral\Tools\MistralListModels;
use OpenCompany\Integrations\Mistral\Tools\MistralRetrieveModel;
use OpenCompany\Integrations\Mistral\Tools\MistralUploadFile;
use PHPUnit\Framework\TestCase;

final class MistralServiceTest extends TestCase
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

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new MistralToolProvider;

        foreach ($provider->tools() as $class) {
            $shortName = substr((string) $class, strrpos((string) $class, '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/mistral/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame('Mistral AI', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
        self::assertGreaterThanOrEqual(140, count($provider->tools()));
    }

    public function test_endpoint_mappings_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MistralService('ms-test');
        $service->request('GET', '/v1/models');
        $service->request('GET', '/v1/models/mistral-small-latest');
        $service->request('POST', '/v1/chat/completions', [], ['model' => 'mistral-small-latest', 'messages' => []]);
        $service->request('POST', '/v1/embeddings', [], ['model' => 'mistral-embed', 'input' => ['hello']]);
        $service->request('POST', '/v1/conversations/conversation-1/restart', [], ['inputs' => []]);
        $service->request('GET', '/v1/agents/agent-1/versions/2');
        $service->request('PATCH', '/v1/fine_tuning/models/model-1', [], ['name' => 'Updated']);
        $service->request('POST', '/v1/batch/jobs/job-1/cancel');
        $service->request('GET', '/v1/libraries/library-1/documents/document-1/status');

        $expected = [
            ['GET', 'https://api.mistral.ai/v1/models'],
            ['GET', 'https://api.mistral.ai/v1/models/mistral-small-latest'],
            ['POST', 'https://api.mistral.ai/v1/chat/completions'],
            ['POST', 'https://api.mistral.ai/v1/embeddings'],
            ['POST', 'https://api.mistral.ai/v1/conversations/conversation-1/restart'],
            ['GET', 'https://api.mistral.ai/v1/agents/agent-1/versions/2'],
            ['PATCH', 'https://api.mistral.ai/v1/fine_tuning/models/model-1'],
            ['POST', 'https://api.mistral.ai/v1/batch/jobs/job-1/cancel'],
            ['GET', 'https://api.mistral.ai/v1/libraries/library-1/documents/document-1/status'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Bearer ms-test'));
        }
    }

    public function test_tools_validate_required_ids_bodies_and_upload_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $chat = new MistralChatCompletions(new MistralService('ms-test'));
        $chatResult = $chat->execute(['body' => ['model' => 'mistral-small-latest', 'messages' => []]]);
        self::assertTrue($chatResult->succeeded());

        $missingBody = $chat->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);

        $missingId = (new MistralRetrieveModel(new MistralService('ms-test')))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('model_id must be', (string) $missingId->error);

        $versionResult = (new MistralGetAgentVersion(new MistralService('ms-test')))->execute([
            'agent_id' => 'agent-1',
            'version' => '2',
        ]);
        self::assertTrue($versionResult->succeeded());

        $upload = new MistralUploadFile(new MistralService('ms-test'));
        $badUpload = $upload->execute(['body' => ['purpose' => 'batch']]);
        self::assertFalse($badUpload->succeeded());
        self::assertStringContainsString('file_path must be', (string) $badUpload->error);
    }

    public function test_legacy_mistralai_package_aliases_canonical_provider_and_credentials(): void
    {
        $canonicalComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/mistral/composer.json'), true);
        $legacyComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/mistralai/composer.json'), true);

        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/integration-mistralai']);
        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/ai-tool-mistralai']);
        self::assertSame('opencompanyapp/integration-mistral', $legacyComposer['abandoned']);

        $legacyProvider = new LegacyMistralAIToolProvider;

        self::assertSame('mistral', $legacyProvider->appName());
        self::assertSame('Mistral AI', $legacyProvider->integrationMeta()['name']);
        self::assertGreaterThanOrEqual(140, count($legacyProvider->tools()));

        Http::fake([
            'https://legacy.mistral.example.test/v1/models' => Http::response(['data' => []], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'mistral') {
                    return '';
                }

                if ($integration === 'mistralai' && $account === 'work') {
                    return match ($key) {
                        'api_key' => 'legacy-ms-token',
                        'url' => 'https://legacy.mistral.example.test/v1',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'mistralai' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'mistralai' ? ['work'] : [];
            }
        });

        $tool = (new MistralToolProvider)->createTool(MistralListModels::class, ['account' => 'work']);

        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy.mistral.example.test/v1/models'
            && $request->hasHeader('Authorization', 'Bearer legacy-ms-token'));
    }
}
