<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ElevenLabs;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\Integrations\ElevenLabs\ElevenLabsToolProvider;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsApiGet;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsCreateSoundEffect;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetVoice;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsListVoices;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsTextToSpeech;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsTextToSpeechWithTimestamps;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded ElevenLabs API coverage.
 */
final class ElevenLabsServiceTest extends TestCase
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

    public function test_service_maps_audio_voice_history_dubbing_and_generic_helpers(): void
    {
        Http::fake([
            'https://api.elevenlabs.io/v1/text-to-speech/voice%201' => Http::response('audio-bytes', 200, ['Content-Type' => 'audio/mpeg', 'character-cost' => '11']),
            'https://api.elevenlabs.io/v1/sound-generation*' => Http::response('sound-bytes', 200, ['Content-Type' => 'audio/mpeg']),
            'https://api.elevenlabs.io/v1/history/hist%2F1/audio' => Http::response('history-audio', 200, ['Content-Type' => 'audio/mpeg']),
            'https://api.elevenlabs.io/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ElevenLabsService('xi_test', 'https://api.elevenlabs.io');

        $service->textToSpeech('voice 1', 'Hello', 'eleven_multilingual_v2', ['stability' => 0.5]);
        $service->textToSpeechWithTimestamps('voice 1', ['text' => 'Hello']);
        $service->createSoundEffect(['text' => 'Cinematic hit']);
        $service->listAudioIsolationHistory(['page_size' => 20]);
        $service->listVoices(['show_legacy' => true]);
        $service->getVoiceSettings('voice 1');
        $service->editVoiceSettings('voice 1', ['stability' => 0.6]);
        $service->getHistoryItem('hist/1');
        $service->getHistoryItemAudio('hist/1');
        $service->deleteHistoryItem('hist/1');
        $service->createDubbing(['source_url' => 'https://example.test/video.mp4', 'target_lang' => 'es']);
        $service->listDubbings();
        $service->getDubbing('dub/1');
        $service->getDubbingTranscript('dub/1', 'es', 'json');
        $service->getSubscription();
        $service->apiGet('/voices');
        $service->apiPost('/dubbing', ['source_url' => 'https://example.test/video.mp4', 'target_lang' => 'es']);
        $service->apiDelete('/dubbing/dub_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('xi-api-key', 'xi_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elevenlabs.io/v1/text-to-speech/voice%201');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elevenlabs.io/v1/text-to-speech/voice%201/with-timestamps');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elevenlabs.io/v1/sound-generation');
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/voices?show_legacy=1'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elevenlabs.io/v1/dubbing/dub%2F1/transcripts/es/format/json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elevenlabs.io/v1/user/subscription');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.elevenlabs.io/v1/sound-generation' => Http::response('sound-bytes', 200, ['Content-Type' => 'audio/mpeg']),
            'https://api.elevenlabs.io/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ElevenLabsService('xi_test');

        self::assertTrue((new ElevenLabsTextToSpeechWithTimestamps($service))->execute([
            'voice_id' => 'voice_1',
            'text' => 'Hello',
        ])->succeeded());
        self::assertTrue((new ElevenLabsCreateSoundEffect($service))->execute([
            'text' => 'Cinematic hit',
        ])->succeeded());
        self::assertTrue((new ElevenLabsApiGet($service))->execute([
            'path' => '/voices',
        ])->succeeded());
        self::assertFalse((new ElevenLabsTextToSpeechWithTimestamps($service))->execute([
            'voice_id' => 'voice_1',
            'text' => '',
        ])->succeeded());
        self::assertFalse((new ElevenLabsTextToSpeech($service))->execute([
            'text' => 'Hello',
        ])->succeeded());
        self::assertFalse((new ElevenLabsGetVoice($service))->execute([])->succeeded());
        self::assertFalse((new ElevenLabsApiGet($service))->execute([
            'path' => 'https://example.test/voices',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.elevenlabs.io/v1/user' => Http::response(['first_name' => 'Example'], 200),
        ]);

        $provider = new ElevenLabsToolProvider();
        $tools = $provider->tools();
        $composer = json_decode((string) file_get_contents(__DIR__.'/../../packages/elevenlabs/composer.json'), true);

        self::assertSame('elevenlabs', $provider->appName());
        self::assertSame('ElevenLabs', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://elevenlabs.io/docs/api-reference', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('self.version', $composer['replace']['opencompanyapp/integration-eleven-labs'] ?? null);
        self::assertArrayHasKey('elevenlabs_text_to_speech_with_timestamps', $tools);
        self::assertArrayHasKey('elevenlabs_speech_to_speech', $tools);
        self::assertArrayHasKey('elevenlabs_speech_to_text', $tools);
        self::assertArrayHasKey('elevenlabs_create_sound_effect', $tools);
        self::assertArrayHasKey('elevenlabs_create_dubbing', $tools);
        self::assertArrayHasKey('elevenlabs_api_delete', $tools);
        self::assertSame(28, count($tools));

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }

        self::assertTrue($provider->testConnection([
            'api_key' => 'xi_test',
        ])['success']);
    }

    public function test_multi_account_resolution_supports_legacy_credentials_and_base_url(): void
    {
        Http::fake([
            'https://api.elevenlabs.io/v1/voices' => Http::response(['voices' => []], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'elevenlabs') {
                    return '';
                }

                $values = [
                    'api_key' => $account === 'production' ? 'legacy-prod-key' : 'legacy-default-key',
                    'url' => 'https://api.elevenlabs.io',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['production'];
            }
        });

        $tool = (new ElevenLabsToolProvider)->createTool(ElevenLabsListVoices::class, ['account' => 'production']);

        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elevenlabs.io/v1/voices'
            && $request->hasHeader('xi-api-key', 'legacy-prod-key'));
    }
}
