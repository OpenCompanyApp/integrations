<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Autopilot;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Autopilot\AutopilotService;
use OpenCompany\Integrations\Autopilot\AutopilotToolProvider;
use OpenCompany\Integrations\Autopilot\Tools\AutopilotGetContact;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Autopilot API Blueprint coverage and request mapping.
 */
final class AutopilotServiceTest extends TestCase
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

    public function test_provider_exposes_official_autopilot_blueprint_surface(): void
    {
        $provider = new AutopilotToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertStringContainsString('autopilotdev.github.io', $provider->integrationMeta()['docs_url']);
        self::assertCount(10, $tools);
        self::assertArrayHasKey('autopilot_create_contact', $tools);
        self::assertArrayHasKey('autopilot_get_contacts_on_list', $tools);
        self::assertArrayHasKey('autopilot_eject_contact_from_journey', $tools);
        self::assertArrayHasKey('autopilot_register_rest_hook', $tools);
        self::assertArrayHasKey('autopilot_list_rest_hooks', $tools);
        self::assertArrayNotHasKey('autopilot_list_contacts', $tools);
        self::assertArrayNotHasKey('autopilot_list_journeys', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__.'/../../packages/autopilot/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_path_json_and_documented_api_key_header(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AutopilotService('auto-token', 'https://api.example.test/v1');
        $service->call('autopilot_get_contact', ['contact_id_or_email' => 'ada@example.test']);
        $service->call('autopilot_register_rest_hook', [
            'payload' => [
                'event' => 'contact_added',
                'target_url' => 'https://example.test/hooks/autopilot',
            ],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v1/contact/ada%40example.test'
            && $request->hasHeader('autopilotapikey', 'auto-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v1/hook'
            && $request->hasHeader('autopilotapikey', 'auto-token')
            && $request['event'] === 'contact_added'
            && $request['target_url'] === 'https://example.test/hooks/autopilot');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new AutopilotGetContact(new AutopilotService('auto-token'));
        $result = $tool->execute([]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('contact_id_or_email is required', (string) $result->error);
    }
}
