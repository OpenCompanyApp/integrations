<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Braintree;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Braintree\BraintreeService;
use OpenCompany\Integrations\Braintree\BraintreeToolProvider;
use OpenCompany\Integrations\Braintree\Tools\BraintreeNode;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Braintree official GraphQL schema operation coverage.
 */
final class BraintreeServiceTest extends TestCase
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

    public function test_provider_exposes_official_schema_surface(): void
    {
        $provider = new BraintreeToolProvider;
        $tools = $provider->tools();
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertCount(131, $tools);
        self::assertArrayHasKey('braintree_ping', $tools);
        self::assertArrayHasKey('braintree_search_transactions', $tools);
        self::assertArrayHasKey('braintree_report_payment_level_fees', $tools);
        self::assertArrayHasKey('braintree_refund_transaction', $tools);
        self::assertArrayNotHasKey('braintree_list_transactions', $tools);
        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], "\\") + 1);
            self::assertFileExists(__DIR__.'/../../packages/braintree/src/Tools/'.$shortName.'.php');
        }
    }

    public function test_service_builds_root_search_report_and_mutation_documents(): void
    {
        Http::fake(['*' => Http::response(['data' => ['ok' => true]], 200)]);
        $service = new BraintreeService(publicKey: 'public', privateKey: 'private');
        $service->call('braintree_node', ['id' => 'gid://braintree/Transaction/example', 'selection' => 'id __typename']);
        $service->call('braintree_search_transactions', ['input' => [], 'first' => 5, 'selection' => 'edges { node { id } }']);
        $service->call('braintree_refund_transaction', ['input' => ['transactionId' => 'txn'], 'selection' => 'refund { id }']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('public:private'))
            && str_contains((string) $request->data()['query'], 'query BraintreeNode($id: ID!)')
            && str_contains((string) $request->data()['query'], 'node(id: $id) { id __typename }'));
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request->data()['query'], 'search { transactions(input: $input, first: $first) { edges { node { id } } } }')
            && $request->data()['variables']['first'] === 5);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request->data()['query'], 'mutation BraintreeRefundTransaction($input: RefundTransactionInput!)')
            && str_contains((string) $request->data()['query'], 'refundTransaction(input: $input) { refund { id } }'));
    }

    public function test_tools_report_missing_required_arguments(): void
    {
        $tool = new BraintreeNode(new BraintreeService(publicKey: 'public', privateKey: 'private'));
        $result = $tool->execute([]);
        self::assertFalse($result->succeeded());
        self::assertStringContainsString('id is required', (string) $result->error);
    }
}
