<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Stability;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Stability\StabilityService;
use OpenCompany\Integrations\Stability\StabilityToolProvider;
use OpenCompany\Integrations\Stability\Tools\StabilityGenerateCore;
use OpenCompany\Integrations\Stability\Tools\StabilityGetVideoResult;
use OpenCompany\Integrations\Stability\Tools\StabilityInpaint;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Stability AI API mapping.
 */
final class StabilityServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(StabilityService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(StabilityService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_docs_are_complete(): void
    {
        $provider = new StabilityToolProvider;

        self::assertSame('stability', $provider->appName());
        self::assertSame('Stability AI', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(13, $provider->tools());
        self::assertArrayHasKey('stability_generate_core', $provider->tools());
        self::assertArrayHasKey('stability_image_to_video', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/stability/src/Tools/' . $shortName . '.php');
        }
    }

    public function test_generation_uses_stability_auth_and_binary_response_normalization(): void
    {
        Http::fake(['*' => Http::response('png-bytes', 200, [
            'Content-Type' => 'image/png',
            'finish-reason' => 'SUCCESS',
            'seed' => '123',
        ])]);

        $result = (new StabilityGenerateCore(new StabilityService('st-key', 'https://api.example.test')))->execute([
            'prompt' => 'A clean product photo',
            'aspect_ratio' => '1:1',
            'output_format' => 'png',
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame('image/png', $result->data['content_type']);
        self::assertSame(base64_encode('png-bytes'), $result->data['body_base64']);
        self::assertSame('SUCCESS', $result->data['finish_reason']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v2beta/stable-image/generate/core'
            && $request->hasHeader('Authorization', 'Bearer st-key')
            && $request->hasHeader('Accept', 'image/*'));
    }

    public function test_multipart_edit_and_video_result_paths_are_mapped(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new StabilityService('st-key', 'https://api.example.test');

        self::assertTrue((new StabilityInpaint($service))->execute([
            'image' => 'image-bytes',
            'mask' => 'mask-bytes',
            'prompt' => 'Replace the sign',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v2beta/stable-image/edit/inpaint');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('video-bytes', 200, ['Content-Type' => 'video/mp4'])]);

        $video = (new StabilityGetVideoResult($service))->execute(['id' => 'job-123']);

        self::assertTrue($video->succeeded());
        self::assertSame('video/mp4', $video->data['content_type']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v2beta/image-to-video/result/job-123'
            && $request->hasHeader('Accept', 'video/*'));
    }

    public function test_multi_account_resolution_uses_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['credits' => 42], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['stability', 'api_key', 'workspace'] => 'account-key',
                    ['stability', 'url', 'workspace'] => 'https://account.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'stability' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'stability' ? ['workspace'] : [];
            }
        });

        $tool = (new StabilityToolProvider)->createTool(\OpenCompany\Integrations\Stability\Tools\StabilityGetBalance::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account.example.test/v1/user/balance'
            && $request->hasHeader('Authorization', 'Bearer account-key'));
    }
}
