<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Deepgram;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Deepgram\DeepgramService;
use OpenCompany\Integrations\Deepgram\DeepgramToolProvider;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramListModels;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramTranscribeAudio;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramTranscribeUrl;
use PHPUnit\Framework\TestCase;

final class DeepgramServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new DeepgramToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/deepgram/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('Deepgram', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
        self::assertArrayHasKey('deepgram_transcribe_audio', $provider->tools());
        self::assertArrayHasKey('deepgram_get_usage_breakdown', $provider->tools());
    }

    public function test_official_endpoint_mappings_and_token_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new DeepgramService('dg-test');
        $service->transcribeUrl(['url' => 'https://example.test/audio.wav'], ['model' => 'nova-3', 'smart_format' => true]);
        $service->analyzeText(['text' => 'hello'], ['sentiment' => true]);
        $service->speak(['text' => 'hello'], ['model' => 'aura-2-thalia-en']);
        $service->listModels(['include_outdated' => true]);
        $service->getModel('model-1');
        $service->listProjects();
        $service->getProject('project-1', ['page' => 1]);
        $service->updateProject('project-1', ['name' => 'Example']);
        $service->listProjectKeys('project-1', ['status' => 'active']);
        $service->createProjectKey('project-1', ['scopes' => ['member']]);
        $service->deleteProjectKey('project-1', 'key-1');
        $service->listProjectBalances('project-1');
        $service->getProjectBalance('project-1', 'balance-1');
        $service->getUsageBreakdown('project-1', ['start' => '2026-01-01', 'end' => '2026-01-31', 'endpoint' => 'listen']);
        $service->getProjectRequest('project-1', 'request-1');
        $service->listProjectModels('project-1', ['include_outdated' => true]);
        $service->getProjectModel('project-1', 'model-1');

        $expected = [
            ['POST', 'https://api.deepgram.com/v1/listen?model=nova-3&smart_format=1'],
            ['POST', 'https://api.deepgram.com/v1/read?sentiment=1'],
            ['POST', 'https://api.deepgram.com/v1/speak?model=aura-2-thalia-en'],
            ['GET', 'https://api.deepgram.com/v1/models?include_outdated=1'],
            ['GET', 'https://api.deepgram.com/v1/models/model-1'],
            ['GET', 'https://api.deepgram.com/v1/projects'],
            ['GET', 'https://api.deepgram.com/v1/projects/project-1?page=1'],
            ['PATCH', 'https://api.deepgram.com/v1/projects/project-1'],
            ['GET', 'https://api.deepgram.com/v1/projects/project-1/keys?status=active'],
            ['POST', 'https://api.deepgram.com/v1/projects/project-1/keys'],
            ['DELETE', 'https://api.deepgram.com/v1/projects/project-1/keys/key-1'],
            ['GET', 'https://api.deepgram.com/v1/projects/project-1/balances'],
            ['GET', 'https://api.deepgram.com/v1/projects/project-1/balances/balance-1'],
            ['GET', 'https://api.deepgram.com/v1/projects/project-1/usage/breakdown?start=2026-01-01&end=2026-01-31&endpoint=listen'],
            ['GET', 'https://api.deepgram.com/v1/projects/project-1/requests/request-1'],
            ['GET', 'https://api.deepgram.com/v1/projects/project-1/models?include_outdated=1'],
            ['GET', 'https://api.deepgram.com/v1/projects/project-1/models/model-1'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Token dg-test'));
        }
    }

    public function test_audio_upload_and_speak_binary_response(): void
    {
        Http::fake(['*' => Http::response('audio-bytes', 200, ['Content-Type' => 'audio/mpeg'])]);

        $service = new DeepgramService('dg-test');
        $listen = $service->transcribeAudio('audio-bytes', 'audio/wav', ['model' => 'nova-3']);
        $speak = $service->speak(['text' => 'hello'], ['model' => 'aura-2-thalia-en']);

        self::assertIsArray($listen);
        self::assertIsString($speak['content_type']);
        self::assertIsString($speak['audio_base64']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.deepgram.com/v1/listen?model=nova-3'
            && $request->hasHeader('Content-Type', 'audio/wav'));
    }

    public function test_tools_filter_payloads_and_validate_required_values(): void
    {
        Http::fake(['*' => Http::response(['metadata' => ['request_id' => 'request-1'], 'stt' => []], 200)]);

        $urlTool = new DeepgramTranscribeUrl(new DeepgramService('dg-test'));
        $result = $urlTool->execute([
            'body' => ['url' => 'https://example.test/audio.wav'],
            'model' => 'nova-3',
            'smart_format' => true,
            'unknown' => 'ignored',
        ]);
        self::assertTrue($result->succeeded());

        $audioTool = new DeepgramTranscribeAudio(new DeepgramService('dg-test'));
        $missing = $audioTool->execute(['content' => 'audio']);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('content_type must be', (string) $missing->error);

        $models = new DeepgramListModels(new DeepgramService('dg-test'));
        $modelsResult = $models->execute(['include_outdated' => true, 'unknown' => 'ignored']);
        self::assertTrue($modelsResult->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.deepgram.com/v1/models?include_outdated=1');
    }
}
