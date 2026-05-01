<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleDataManager;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleDataManager\GoogleDataManagerService;
use OpenCompany\Integrations\GoogleDataManager\GoogleDataManagerToolProvider;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerIngestAudienceMembers;
use PHPUnit\Framework\TestCase;

final class GoogleDataManagerServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_registers_every_declared_tool_file_and_docs(): void
    {
        $provider = new GoogleDataManagerToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-data-manager/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('oauth2', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['setup_supported']);
    }

    public function test_audience_ingestion_requires_confirmation(): void
    {
        $tool = new GoogleDataManagerIngestAudienceMembers(new GoogleDataManagerService(accessToken: 'access-token'));

        $result = $tool->execute([
            'destinations' => [['operatingAccount' => ['product' => 'GOOGLE_ADS', 'accountId' => '1234567890']]],
            'audience_members' => [['userData' => ['emailAddress' => 'person@example.test']]],
        ]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('confirm_execute=true is required', (string) $result->error);
    }

    public function test_audience_ingestion_posts_to_data_manager_endpoint(): void
    {
        Http::fake([
            'https://datamanager.googleapis.com/v1/audienceMembers:ingest' => Http::response(['requestId' => 'request-1'], 200),
        ]);

        $tool = new GoogleDataManagerIngestAudienceMembers(new GoogleDataManagerService(accessToken: 'access-token'));
        $result = $tool->execute([
            'confirm_execute' => true,
            'destinations' => [['operatingAccount' => ['product' => 'GOOGLE_ADS', 'accountId' => '1234567890']]],
            'audience_members' => [['userData' => ['emailAddress' => 'person@example.test']]],
            'consent' => ['adUserData' => 'GRANTED'],
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://datamanager.googleapis.com/v1/audienceMembers:ingest'
                && $request->hasHeader('Authorization', 'Bearer access-token')
                && $request->data()['audienceMembers'][0]['userData']['emailAddress'] === 'person@example.test';
        });
    }
}
