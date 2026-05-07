<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Tapfiliate;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;
use OpenCompany\Integrations\Tapfiliate\TapfiliateToolProvider;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateCreateConversion;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListAffiliates;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateUpdateProgramAffiliate;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Tapfiliate API v1.6 endpoint coverage and auth.
 */
final class TapfiliateServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_tapfiliate_v16_paths_with_x_api_key_auth(): void
    {
        Http::fake([
            'https://api.tapfiliate.test/1.6/me/' => Http::response(['email' => 'admin@example.test'], 200),
            'https://api.tapfiliate.test/1.6/affiliates/*' => Http::response(['id' => 'aff_123'], 200),
            'https://api.tapfiliate.test/1.6/affiliate-groups/' => Http::response([['id' => 'group_1']], 200),
            'https://api.tapfiliate.test/1.6/conversions/*' => Http::response(['id' => 12345], 200),
            'https://api.tapfiliate.test/1.6/commissions/*' => Http::response(['id' => 98765], 200),
            'https://api.tapfiliate.test/1.6/customers*' => Http::response([['customer_id' => 'cust_1']], 200),
            'https://api.tapfiliate.test/1.6/programs/*' => Http::response(['id' => 'prog_1'], 200),
        ]);

        $service = new TapfiliateService('key_test', 'https://api.tapfiliate.test/1.6');
        $service->getCurrentUser();
        $service->listAffiliates(['email' => 'partner@example.test', 'limit' => 50]);
        $service->getAffiliate('aff_123');
        $service->createAffiliate(['firstname' => 'Ada', 'lastname' => 'Lovelace', 'email' => 'ada@example.test']);
        $service->updateAffiliate('aff_123', ['firstname' => 'Grace']);
        $service->deleteAffiliate('aff_123');
        $service->setAffiliateGroup('aff_123', 'group_1');
        $service->listAffiliateNotes('aff_123');
        $service->listAffiliateGroups();
        $service->listConversions(['affiliate_id' => 'aff_123']);
        $service->getConversion(12345);
        $service->createConversion(['external_id' => 'order_1', 'amount' => 100, 'affiliate_id' => 'aff_123']);
        $service->addConversionCommission(12345, ['conversion_sub_amount' => 25]);
        $service->listCommissions(['status' => 'approved']);
        $service->getCommission(98765);
        $service->listCustomers(['affiliate_id' => 'aff_123']);
        $service->createCustomer(['customer_id' => 'cust_1', 'affiliate_id' => 'aff_123']);
        $service->listPrograms();
        $service->getProgramAffiliate('prog_1', 'aff_123');
        $service->updateProgramAffiliate('prog_1', 'aff_123', ['coupon' => 'PARTNER10']);
        $service->listProgramCommissionTypes('prog_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Api-Key', 'key_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/me/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.tapfiliate.test/1.6/affiliates/?')
            && str_contains($request->url(), 'email=partner%40example.test')
            && str_contains($request->url(), 'limit=50'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/affiliates/aff_123/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.tapfiliate.test/1.6/affiliates/' && $request['email'] === 'ada@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.tapfiliate.test/1.6/affiliates/aff_123/' && $request['firstname'] === 'Grace');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.tapfiliate.test/1.6/affiliates/aff_123/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.tapfiliate.test/1.6/affiliates/aff_123/group/' && $request['group_id'] === 'group_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/affiliates/aff_123/notes/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/affiliate-groups/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.tapfiliate.test/1.6/conversions/?') && str_contains($request->url(), 'affiliate_id=aff_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/conversions/12345/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.tapfiliate.test/1.6/conversions/' && $request['external_id'] === 'order_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.tapfiliate.test/1.6/conversions/12345/commissions/' && $request['conversion_sub_amount'] === 25);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.tapfiliate.test/1.6/commissions/?') && str_contains($request->url(), 'status=approved'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/commissions/98765/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.tapfiliate.test/1.6/customers/?') && str_contains($request->url(), 'affiliate_id=aff_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.tapfiliate.test/1.6/customers/' && $request['customer_id'] === 'cust_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/programs/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/programs/prog_1/affiliates/aff_123/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.tapfiliate.test/1.6/programs/prog_1/affiliates/aff_123/' && $request['coupon'] === 'PARTNER10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.tapfiliate.test/1.6/programs/prog_1/commission-types/');
    }

    public function test_tools_map_agent_arguments_to_tapfiliate_payloads(): void
    {
        Http::fake([
            'https://api.tapfiliate.test/1.6/affiliates/*' => Http::response([['id' => 'aff_123']], 200),
            'https://api.tapfiliate.test/1.6/conversions/' => Http::response(['id' => 12345], 200),
            'https://api.tapfiliate.test/1.6/programs/prog_1/affiliates/aff_123/' => Http::response(['coupon' => 'PARTNER10'], 200),
        ]);

        $service = new TapfiliateService('key_test', 'https://api.tapfiliate.test/1.6');
        self::assertNull((new TapfiliateListAffiliates($service))->execute([
            'email' => 'partner@example.test',
            'referral_code' => 'PARTNER',
        ])->error);
        self::assertNull((new TapfiliateCreateConversion($service))->execute([
            'external_id' => 'order_1',
            'referral_code' => 'PARTNER',
            'amount' => 100,
            'currency' => 'USD',
        ])->error);
        self::assertNull((new TapfiliateUpdateProgramAffiliate($service))->execute([
            'program_id' => 'prog_1',
            'affiliate_id' => 'aff_123',
            'coupon' => 'PARTNER10',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.tapfiliate.test/1.6/affiliates/?') && str_contains($request->url(), 'referral_code=PARTNER'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tapfiliate.test/1.6/conversions/' && $request['referral_code'] === 'PARTNER' && $request['currency'] === 'USD');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tapfiliate.test/1.6/programs/prog_1/affiliates/aff_123/' && $request['coupon'] === 'PARTNER10');
    }

    public function test_provider_exposes_expanded_v16_surface_and_allowed_category(): void
    {
        $provider = new TapfiliateToolProvider();
        $tools = $provider->tools();

        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('https://tapfiliate.com/docs/rest/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://api.tapfiliate.com/1.6', $provider->credentialFields()[1]['default']);
        self::assertArrayHasKey('tapfiliate_create_affiliate', $tools);
        self::assertArrayHasKey('tapfiliate_list_commissions', $tools);
        self::assertArrayHasKey('tapfiliate_create_customer', $tools);
        self::assertArrayHasKey('tapfiliate_list_program_commission_types', $tools);
        self::assertSame(21, count($tools));
    }
}
