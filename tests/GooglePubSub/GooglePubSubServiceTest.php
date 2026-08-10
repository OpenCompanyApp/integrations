<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GooglePubSub;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GooglePubSub\GooglePubSubService;
use OpenCompany\Integrations\GooglePubSub\GooglePubSubToolProvider;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsPull;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsList;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsPublish;
use PHPUnit\Framework\TestCase;

final class GooglePubSubServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GooglePubSubToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-pubsub/google-pubsub-discovery-manifest.json'), true);

        self::assertSame(46, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Pub/Sub', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-pubsub/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_pubsub_projects_topics_publish', $manifestTools);
        self::assertContains('google_pubsub_projects_subscriptions_pull', $manifestTools);
        self::assertContains('google_pubsub_projects_schemas_validate_message', $manifestTools);
    }

    public function test_service_maps_auth_resource_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GooglePubSubService('token-test', 'https://example.test');
        $service->request('GET', '/v1/{+project}/topics', ['project' => 'projects/project-1'], ['project'], ['pageSize' => 5]);
        $service->request('POST', '/v1/{+topic}:publish', ['topic' => 'projects/project-1/topics/events'], ['topic'], [], ['messages' => [['data' => 'aGVsbG8=']]]);
        $service->request('POST', '/v1/{+subscription}:pull', ['subscription' => 'projects/project-1/subscriptions/worker'], ['subscription'], [], ['maxMessages' => 1]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/projects/project-1/topics?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/projects/project-1/topics/events:publish'
            && $request['messages'][0]['data'] === 'aGVsbG8=');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/projects/project-1/subscriptions/worker:pull'
            && $request['maxMessages'] === 1);
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GooglePubSubService('token-test');

        $list = new GooglePubSubProjectsTopicsList($service);
        $result = $list->execute(['project' => 'projects/project-1', 'pageSize' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://pubsub.googleapis.com/v1/projects/project-1/topics?pageSize=10');

        $missingPath = (new GooglePubSubProjectsTopicsPublish($service))->execute(['body' => ['messages' => []]]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('topic must be', (string) $missingPath->error);

        $missingBody = (new GooglePubSubProjectsSubscriptionsPull($service))->execute(['subscription' => 'projects/project-1/subscriptions/worker']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}