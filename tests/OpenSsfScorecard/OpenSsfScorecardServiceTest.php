<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenSsfScorecard;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\OpenSsfScorecard\OpenSsfScorecardService;
use OpenCompany\Integrations\OpenSsfScorecard\OpenSsfScorecardToolProvider;
use OpenCompany\Integrations\OpenSsfScorecard\Tools\OpenSsfScorecardBadge;
use OpenCompany\Integrations\OpenSsfScorecard\Tools\OpenSsfScorecardCheck;
use OpenCompany\Integrations\OpenSsfScorecard\Tools\OpenSsfScorecardResult;
use OpenCompany\Integrations\OpenSsfScorecard\Tools\OpenSsfScorecardViewerUrl;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the OpenSSF Scorecard integration.
 */
final class OpenSsfScorecardServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenSsfScorecardService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenSsfScorecardService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new OpenSsfScorecardToolProvider;

        self::assertSame('openssf-scorecard', $provider->appName());
        self::assertSame('OpenSSF Scorecard', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'openssf_scorecard_result',
            'openssf_scorecard_check',
            'openssf_scorecard_badge',
            'openssf_scorecard_viewer_url',
        ], array_keys($provider->tools()));
    }

    public function test_result_check_badge_and_viewer_paths_are_mapped(): void
    {
        $service = new OpenSsfScorecardService(baseUrl: 'https://scorecard.example.test', viewerBaseUrl: 'https://viewer.example.test/viewer');

        Http::fake(['*' => Http::response($this->resultFixture(), 200)]);
        $result = (new OpenSsfScorecardResult($service))->execute(['uri' => 'github.com/ossf/scorecard', 'commit' => '117f74463c544dc32b6da4bd38db575617334b49']);
        self::assertTrue($result->succeeded());
        self::assertSame(9.1, $result->data['score']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://scorecard.example.test/projects/github.com/ossf/scorecard')
            && str_contains($request->url(), 'commit=117f74463c544dc32b6da4bd38db575617334b49'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response($this->resultFixture(), 200)]);
        $check = (new OpenSsfScorecardCheck($service))->execute(['platform' => 'github.com', 'org' => 'ossf', 'repo' => 'scorecard', 'check' => 'security-policy']);
        self::assertTrue($check->succeeded());
        self::assertSame('Security-Policy', $check->data['name']);
        self::assertSame('github.com/ossf/scorecard', $check->data['repo']['name']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('<svg role="img"></svg>', 200, ['content-type' => 'image/svg+xml'])]);
        $badge = (new OpenSsfScorecardBadge($service))->execute(['uri' => 'github.com/ossf/scorecard', 'style' => 'flat-square']);
        self::assertTrue($badge->succeeded());
        self::assertStringContainsString('<svg', $badge->data['body']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://scorecard.example.test/projects/github.com/ossf/scorecard/badge')
            && str_contains($request->url(), 'style=flat-square'));

        $viewer = (new OpenSsfScorecardViewerUrl($service))->execute(['uri' => 'github.com/ossf/scorecard']);
        self::assertTrue($viewer->succeeded());
        self::assertSame('https://viewer.example.test/viewer/?uri=github.com%2Fossf%2Fscorecard', $viewer->data['url']);
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new OpenSsfScorecardService(baseUrl: 'https://scorecard.example.test');

        $missing = (new OpenSsfScorecardResult($service))->execute(['org' => 'ossf', 'repo' => 'scorecard']);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('platform is required', (string) $missing->error);

        Http::fake(['*' => Http::response($this->resultFixture(), 200)]);
        $missingCheck = (new OpenSsfScorecardCheck($service))->execute(['uri' => 'github.com/ossf/scorecard', 'check' => 'Nope']);
        self::assertFalse($missingCheck->succeeded());
        self::assertStringContainsString('check not found', strtolower((string) $missingCheck->error));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'not found'], 404)]);
        $apiError = (new OpenSsfScorecardResult($service))->execute(['uri' => 'github.com/unknown/repo']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('not found', (string) $apiError->error);
    }

    public function test_provider_creates_tools_with_default_service(): void
    {
        Http::fake(['*' => Http::response($this->resultFixture(), 200)]);

        app()->instance(OpenSsfScorecardService::class, new OpenSsfScorecardService(baseUrl: 'https://scorecard.example.test'));
        $tool = (new OpenSsfScorecardToolProvider)->createTool(OpenSsfScorecardResult::class);
        $result = $tool->execute(['uri' => 'github.com/ossf/scorecard']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://scorecard.example.test/projects/github.com/ossf/scorecard');
    }

    /**
     * Return a fake shape-accurate OpenSSF Scorecard result.
     *
     * @return array<string, mixed>
     */
    private function resultFixture(): array
    {
        return [
            'date' => '2026-05-04T09:50:31Z',
            'repo' => ['name' => 'github.com/ossf/scorecard', 'commit' => '117f74463c544dc32b6da4bd38db575617334b49'],
            'scorecard' => ['version' => 'v5.3.0', 'commit' => 'c22063e786c11f9dd714d777a687ff7c4599b600'],
            'score' => 9.1,
            'checks' => [
                ['name' => 'Maintained', 'score' => 10, 'reason' => '30 commit(s) found', 'details' => null, 'documentation' => ['short' => 'Determines if the project is actively maintained.', 'url' => 'https://example.test/maintained']],
                ['name' => 'Security-Policy', 'score' => 10, 'reason' => 'security policy file detected', 'details' => ['Info: SECURITY.md:1'], 'documentation' => ['short' => 'Determines if the project has a security policy.', 'url' => 'https://example.test/security-policy']],
            ],
        ];
    }
}
