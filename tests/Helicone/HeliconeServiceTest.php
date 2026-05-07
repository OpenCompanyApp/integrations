<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Helicone;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Helicone\HeliconeService;
use OpenCompany\Integrations\Helicone\HeliconeToolProvider;
use OpenCompany\Integrations\Helicone\Tools\HeliconeGetRequest;
use OpenCompany\Integrations\Helicone\Tools\HeliconeQueryRequests;
use OpenCompany\Integrations\Helicone\Tools\HeliconeSubmitFeedback;
use PHPUnit\Framework\TestCase;

final class HeliconeServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new HeliconeToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/helicone/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('Helicone', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
        self::assertArrayHasKey('helicone_gateway_responses', $provider->tools());
    }

    public function test_endpoint_mappings_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new HeliconeService('hc-test');
        $service->queryRequests(['filter' => [], 'limit' => 10]);
        $service->queryRequestsByIds(['requestIds' => ['request-1']]);
        $service->getRequest('request-1');
        $service->submitFeedback('request-1', ['rating' => true]);
        $service->queryUserMetrics(['filter' => []]);
        $service->queryUserMetricsOverview(['filter' => []]);
        $service->listGatewayModels();
        $service->gatewayChatCompletions(['model' => 'openai/gpt-4o-mini', 'messages' => []]);
        $service->gatewayResponses(['model' => 'openai/gpt-4o-mini', 'input' => 'hi']);

        $expected = [
            ['POST', 'https://api.helicone.ai/v1/request/query-clickhouse'],
            ['POST', 'https://api.helicone.ai/v1/request/query-ids'],
            ['GET', 'https://api.helicone.ai/v1/request/request-1'],
            ['POST', 'https://api.helicone.ai/v1/request/request-1/feedback'],
            ['POST', 'https://api.helicone.ai/v1/user/metrics/query'],
            ['POST', 'https://api.helicone.ai/v1/user/metrics-overview/query'],
            ['GET', 'https://ai-gateway.helicone.ai/v1/models'],
            ['POST', 'https://ai-gateway.helicone.ai/v1/chat/completions'],
            ['POST', 'https://ai-gateway.helicone.ai/v1/responses'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Bearer hc-test'));
        }
    }

    public function test_tools_require_body_or_ids(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $query = new HeliconeQueryRequests(new HeliconeService('hc-test'));
        $queryResult = $query->execute(['body' => ['filter' => [], 'limit' => 5]]);
        self::assertTrue($queryResult->succeeded());

        $missingBody = $query->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);

        $missingId = (new HeliconeGetRequest(new HeliconeService('hc-test')))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('request_id must be', (string) $missingId->error);

        $feedback = new HeliconeSubmitFeedback(new HeliconeService('hc-test'));
        $feedbackResult = $feedback->execute(['request_id' => 'request-1', 'body' => ['rating' => true]]);
        self::assertTrue($feedbackResult->succeeded());
    }
}
