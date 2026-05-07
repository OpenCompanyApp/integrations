<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Wildix;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Wildix\Tools\WildixCallControlHold;
use OpenCompany\Integrations\Wildix\WildixService;
use OpenCompany\Integrations\Wildix\WildixToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Wildix official WMS/PBX API operation coverage.
 */
final class WildixServiceTest extends TestCase
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

    public function test_provider_exposes_official_wms_api_client_surface(): void
    {
        $provider = new WildixToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertStringContainsString('@wildix/wms-api-client', $provider->integrationMeta()['docs_url']);
        self::assertCount(32, $tools);
        self::assertArrayHasKey('wildix_call_control_make_call', $tools);
        self::assertArrayHasKey('wildix_get_pbx_colleagues', $tools);
        self::assertArrayHasKey('wildix_create_pbx_colleague', $tools);
        self::assertArrayHasKey('wildix_get_pbx_o_auth2_clients', $tools);
        self::assertArrayHasKey('wildix_notifications', $tools);
        self::assertArrayNotHasKey('wildix_list_calls', $tools);
        self::assertArrayNotHasKey('wildix_list_users', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], "\\") + 1);
            self::assertFileExists(__DIR__.'/../../packages/wildix/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_path_query_body_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new WildixService('wildix-token', 'example');
        $service->call('wildix_get_colleague_by_id', ['id' => 'user 123']);
        $service->call('wildix_call_control_answer', [
            'user' => '100',
            'sip_call_id' => 'sip-1',
            'device' => 'Web',
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.wildixin.com/api/v1/Colleagues/user%20123'
            && $request->hasHeader('Authorization', 'Bearer wildix-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.wildixin.com/api/v2/call-control/answer?user=100'
            && $request->hasHeader('Authorization', 'Bearer wildix-token')
            && $request['sipCallId'] === 'sip-1'
            && $request['device'] === 'Web');
    }

    public function test_tools_report_missing_required_body_arguments(): void
    {
        $tool = new WildixCallControlHold(new WildixService('wildix-token', 'https://example.test'));
        $result = $tool->execute([]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('sip_call_id is required', (string) $result->error);
    }
}
