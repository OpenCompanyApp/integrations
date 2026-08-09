<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftEducation;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftEducation\MicrosoftEducationService;
use OpenCompany\Integrations\MicrosoftEducation\MicrosoftEducationToolProvider;
use OpenCompany\Integrations\MicrosoftEducation\Tools\MicrosoftEducationEducationClassesAssignmentsListSubmissions;
use OpenCompany\Integrations\MicrosoftEducation\Tools\MicrosoftEducationEducationClassesListAssignments;
use OpenCompany\Integrations\MicrosoftEducation\Tools\MicrosoftEducationEducationGetClasses;
use OpenCompany\Integrations\MicrosoftEducation\Tools\MicrosoftEducationEducationListClasses;
use OpenCompany\Integrations\MicrosoftEducation\Tools\MicrosoftEducationEducationListSchools;
use OpenCompany\Integrations\MicrosoftEducation\Tools\MicrosoftEducationEducationListUsers;
use OpenCompany\Integrations\MicrosoftEducation\Tools\MicrosoftEducationEducationUpdateClasses;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Education integration.
 */
final class MicrosoftEducationServiceTest extends TestCase
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

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftEducationToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-education/microsoft-education-openapi-manifest.json'), true);

        self::assertSame(414, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertContains('/education', $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Education', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('microsoft_education_education_list_classes', array_keys($provider->tools()));
        self::assertContains('microsoft_education_education_get_classes', array_keys($provider->tools()));
        self::assertContains('microsoft_education_education_list_users', array_keys($provider->tools()));
        self::assertContains('microsoft_education_education_list_schools', array_keys($provider->tools()));
        self::assertContains('microsoft_education_education_classes_list_assignments', array_keys($provider->tools()));
        self::assertContains('microsoft_education_education_classes_assignments_list_submissions', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_education_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftEducationService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/education/classes/{educationClass-id}', ['educationClass-id' => 'class 1'], ['$select' => 'id,displayName']);
        $service->request(
            'PATCH',
            '/education/classes/{educationClass-id}',
            ['educationClass-id' => 'class 1'],
            [],
            ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation', 'ConsistencyLevel' => 'eventual'],
            ['displayName' => 'Updated Class'],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/education/classes/class%201?%24select=id%2CdisplayName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/education/classes/class%201'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->hasHeader('ConsistencyLevel', 'eventual')
            && $request->data()['displayName'] === 'Updated Class');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftEducationService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftEducationEducationListClasses($service))->execute(['top' => 5, 'select' => 'id,displayName', 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftEducationEducationGetClasses($service))->execute(['education_class_id' => 'class-123', 'select' => 'id,displayName'])->succeeded());
        self::assertTrue((new MicrosoftEducationEducationUpdateClasses($service))->execute(['education_class_id' => 'class-123', 'if_match' => 'W/"etag"', 'body' => ['displayName' => 'Updated']])->succeeded());
        self::assertTrue((new MicrosoftEducationEducationListUsers($service))->execute(['filter' => "startswith(displayName,'Ada')", 'count' => true, 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftEducationEducationListSchools($service))->execute(['top' => 2])->succeeded());
        self::assertTrue((new MicrosoftEducationEducationClassesListAssignments($service))->execute(['education_class_id' => 'class-123', 'select' => 'id,displayName'])->succeeded());
        self::assertTrue((new MicrosoftEducationEducationClassesAssignmentsListSubmissions($service))->execute(['education_class_id' => 'class-123', 'education_assignment_id' => 'assignment-123'])->succeeded());

        $missingPath = (new MicrosoftEducationEducationGetClasses($service))->execute([]);
        $badBody = (new MicrosoftEducationEducationUpdateClasses($service))->execute(['education_class_id' => 'class-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftEducationEducationUpdateClasses($service))->execute(['education_class_id' => 'class-123']);
        $unconfigured = (new MicrosoftEducationEducationGetClasses(new MicrosoftEducationService('', 'https://graph.example.test/v1.0')))->execute(['education_class_id' => 'class-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('education_class_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_education_classes_probe(): void
    {
        Http::fake(['*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftEducationToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/education/classes?$top=1'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            /** @var list<string> */
            public array $seenIntegrations = [];

            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $this->seenIntegrations[] = $integration;

                $values = [
                    'access_token' => $account === 'school' ? 'school-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['school'];
            }
        });

        $resolver = Container::getInstance()->make(CredentialResolver::class);
        $tool = (new MicrosoftEducationToolProvider)->createTool(MicrosoftEducationEducationGetClasses::class, ['account' => 'school']);
        self::assertTrue($tool->execute(['education_class_id' => 'class-123'])->succeeded());

        self::assertSame(['microsoft-education', 'microsoft-education'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer school-token'));
    }
}
