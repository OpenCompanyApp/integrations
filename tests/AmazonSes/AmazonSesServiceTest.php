<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AmazonSes;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\AmazonSes\AmazonSesService;
use OpenCompany\Integrations\AmazonSes\AmazonSesToolProvider;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesApiGet;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesListSuppressions;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Amazon SES v2 SigV4 request mapping.
 */
final class AmazonSesServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_core_v2_endpoints_with_sigv4_headers(): void
    {
        Http::fake([
            'https://email.us-east-1.amazonaws.com/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AmazonSesService('AKIA_TEST', 'secret_test', 'us-east-1');

        $service->sendEmail(['FromEmailAddress' => 'hello@example.test']);
        $service->getAccount();
        $service->listTemplates(10, 'next');
        $service->getTemplate('welcome');
        $service->createTemplate(['TemplateName' => 'welcome']);
        $service->updateTemplate('welcome', ['TemplateContent' => ['Subject' => 'Hi']]);
        $service->deleteTemplate('welcome');
        $service->listSuppressions(25, null, 'BOUNCE');
        $service->listIdentities(20);
        $service->getIdentity('example.test');
        $service->listConfigurationSets(10);
        $service->apiGet('/v2/email/configuration-sets/default/event-destinations');
        $service->apiPut('/v2/email/account/suppression', ['SuppressedReasons' => ['BOUNCE']]);
        $service->apiDelete('/v2/email/templates/old');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('authorization') && str_contains($request->header('authorization')[0], 'AWS4-HMAC-SHA256'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('x-amz-date') && $request->hasHeader('x-amz-content-sha256'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://email.us-east-1.amazonaws.com/v2/email/outbound-emails');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://email.us-east-1.amazonaws.com/v2/email/account');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://email.us-east-1.amazonaws.com/v2/email/templates?') && str_contains($request->url(), 'PageSize=10'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://email.us-east-1.amazonaws.com/v2/email/templates/welcome');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://email.us-east-1.amazonaws.com/v2/email/templates/welcome');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://email.us-east-1.amazonaws.com/v2/email/suppression/addresses?') && str_contains($request->url(), 'Reasons=BOUNCE'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://email.us-east-1.amazonaws.com/v2/email/identities?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://email.us-east-1.amazonaws.com/v2/email/identities/example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://email.us-east-1.amazonaws.com/v2/email/configuration-sets?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://email.us-east-1.amazonaws.com/v2/email/configuration-sets/default/event-destinations');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://email.us-east-1.amazonaws.com/v2/email/account/suppression');
    }

    public function test_tools_delegate_to_signed_service_methods(): void
    {
        Http::fake([
            'https://email.us-east-1.amazonaws.com/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AmazonSesService('AKIA_TEST', 'secret_test', 'us-east-1');

        self::assertNull((new AmazonSesApiGet($service))->execute([
            'path' => '/v2/email/account',
        ])->error);
        self::assertNull((new AmazonSesListSuppressions($service))->execute([
            'reason' => 'COMPLAINT',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://email.us-east-1.amazonaws.com/v2/email/account');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'Reasons=COMPLAINT'));
    }

    public function test_provider_exposes_sigv4_catalog_and_allowed_category(): void
    {
        $provider = new AmazonSesToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.aws.amazon.com/ses/latest/APIReference-V2/', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('amazonses_get_account', $tools);
        self::assertArrayHasKey('amazonses_update_template', $tools);
        self::assertArrayHasKey('amazonses_delete_template', $tools);
        self::assertArrayHasKey('amazonses_list_identities', $tools);
        self::assertArrayHasKey('amazonses_api_get', $tools);
        self::assertArrayNotHasKey('amazonses_get_current_user', $tools);
        self::assertSame(15, count($tools));

        self::assertTrue($provider->testConnection([
            'access_key_id' => 'AKIA_TEST',
            'secret_access_key' => 'secret_test',
        ])['success']);
    }
}
