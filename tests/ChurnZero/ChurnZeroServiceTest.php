<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ChurnZero;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ChurnZero\ChurnZeroService;
use OpenCompany\Integrations\ChurnZero\ChurnZeroToolProvider;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroIncrementAttribute;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroSendAction;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroSetAttributes;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroTrackEvent;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the ChurnZero action-based HTTP API integration.
 */
final class ChurnZeroServiceTest extends TestCase
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

    public function test_provider_metadata_matches_churnzero_http_api(): void
    {
        $provider = new ChurnZeroToolProvider;

        self::assertSame('ChurnZero', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key_query', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame(['app_key'], $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertCount(6, $provider->tools());
        self::assertSame(['app_key', 'url'], array_column($provider->credentialFields(), 'key'));
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertArrayHasKey('churnzero_set_attributes', $provider->tools());
        self::assertArrayHasKey('churnzero_track_event', $provider->tools());
        self::assertArrayHasKey('churnzero_increment_attribute', $provider->tools());
    }

    public function test_service_sends_app_key_query_actions_to_i_endpoint(): void
    {
        Http::fake(['*' => Http::response(['status' => 'success'], 200)]);

        $service = new ChurnZeroService('app_test', 'https://analytics.example.test');
        $service->setAttribute('account', 'acct_123', null, 'ARR', 12000);
        $service->trackEvent('acct_123', 'Report Exported', 'user_456', 'Monthly report', 2, ['Format' => 'PDF']);
        $service->incrementAttribute('contact', 'acct_123', 'user_456', 'Login Count', 1);
        $service->deleteContact('acct_123', 'user_456');
        $service->deleteAccount('acct_123');

        Http::assertSentCount(5);

        Http::assertSent(function (Request $request): bool {
            $query = $this->query($request);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://analytics.example.test/i?')
                && $query['appKey'] === 'app_test'
                && $query['action'] === 'setAttribute'
                && $query['entity'] === 'account'
                && $query['accountExternalId'] === 'acct_123'
                && $query['name'] === 'ARR'
                && $query['value'] === '12000';
        });

        Http::assertSent(function (Request $request): bool {
            $query = $this->query($request);
            $customFields = json_decode((string) ($query['customfields'] ?? ''), true);

            return $query['action'] === 'trackEvent'
                && $query['eventName'] === 'Report Exported'
                && $query['contactExternalId'] === 'user_456'
                && $query['quantity'] === '2'
                && $customFields === ['Format' => 'PDF'];
        });

        Http::assertSent(fn (Request $request): bool => ($this->query($request)['action'] ?? '') === 'incrementAttribute'
            && ($this->query($request)['entity'] ?? '') === 'contact'
            && ($this->query($request)['name'] ?? '') === 'Login Count');

        Http::assertSent(fn (Request $request): bool => ($this->query($request)['action'] ?? '') === 'deleteContact');
        Http::assertSent(fn (Request $request): bool => ($this->query($request)['action'] ?? '') === 'deleteAccount');
    }

    public function test_set_attributes_tool_maps_multiple_attributes_to_actions(): void
    {
        Http::fake(['*' => Http::response(['status' => 'success'], 200)]);

        $tool = new ChurnZeroSetAttributes(new ChurnZeroService('app_test', 'https://analytics.example.test/i'));
        $result = $tool->execute([
            'entity' => 'contact',
            'account_external_id' => 'acct_123',
            'contact_external_id' => 'user_456',
            'attributes' => [
                'Email' => 'person@example.test',
                'Is Admin' => true,
            ],
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSentCount(2);
        Http::assertSent(fn (Request $request): bool => ($this->query($request)['name'] ?? '') === 'Email'
            && ($this->query($request)['value'] ?? '') === 'person@example.test');
        Http::assertSent(fn (Request $request): bool => ($this->query($request)['name'] ?? '') === 'Is Admin'
            && ($this->query($request)['value'] ?? '') === 'true');
    }

    public function test_tools_validate_configuration_and_raw_action_inputs(): void
    {
        $unconfigured = new ChurnZeroTrackEvent(new ChurnZeroService('', 'https://analytics.example.test/i'));
        $unconfiguredResult = $unconfigured->execute([
            'account_external_id' => 'acct_123',
            'event_name' => 'Login',
        ]);

        self::assertFalse($unconfiguredResult->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfiguredResult->error);

        $badParams = (new ChurnZeroSendAction(new ChurnZeroService('app_test', 'https://analytics.example.test/i')))
            ->execute(['params' => ['appKey' => 'leak', 'action' => 'trackEvent']]);

        self::assertFalse($badParams->succeeded());
        self::assertStringContainsString('Do not pass appKey', (string) $badParams->error);

        $badContact = (new ChurnZeroIncrementAttribute(new ChurnZeroService('app_test', 'https://analytics.example.test/i')))
            ->execute([
                'entity' => 'contact',
                'account_external_id' => 'acct_123',
                'name' => 'Login Count',
                'value' => 1,
            ]);

        self::assertFalse($badContact->succeeded());
        self::assertStringContainsString('contactExternalId is required', (string) $badContact->error);
    }

    public function test_connection_validates_config_without_mutating_api(): void
    {
        Http::fake(['*' => Http::response(['status' => 'success'], 200)]);

        $result = (new ChurnZeroToolProvider)->testConnection([
            'app_key' => 'app_test',
            'url' => 'https://analytics.example.test/i',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('no documented non-mutating test endpoint', (string) $result['message']);
        Http::assertNothingSent();

        $missing = (new ChurnZeroToolProvider)->testConnection([]);

        self::assertFalse($missing['success']);
        self::assertStringContainsString('No ChurnZero app key', (string) $missing['error']);
    }

    /**
     * Extract query parameters from a Laravel HTTP test request.
     *
     * @return array<string, string>
     */
    private function query(Request $request): array
    {
        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

        return $query;
    }
}
