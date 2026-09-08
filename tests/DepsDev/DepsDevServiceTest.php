<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\DepsDev;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\DepsDev\DepsDevService;
use OpenCompany\Integrations\DepsDev\DepsDevToolProvider;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevAdvisory;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevDependencies;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevPackage;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevProject;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevProjectPackageVersions;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevQuery;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevRequirements;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevVersion;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the deps.dev integration.
 */
final class DepsDevServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(DepsDevService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(DepsDevService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new DepsDevToolProvider;

        self::assertSame('deps-dev', $provider->appName());
        self::assertSame('deps.dev', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'deps_dev_package',
            'deps_dev_version',
            'deps_dev_requirements',
            'deps_dev_dependencies',
            'deps_dev_project',
            'deps_dev_project_package_versions',
            'deps_dev_advisory',
            'deps_dev_query',
        ], array_keys($provider->tools()));
    }

    public function test_package_version_requirements_and_dependencies_paths_are_mapped(): void
    {
        $service = new DepsDevService(baseUrl: 'https://deps.example.test/v3');

        Http::fake(['*' => Http::response(['packageKey' => ['system' => 'NPM', 'name' => '@colors/colors'], 'versions' => []], 200)]);
        self::assertTrue((new DepsDevPackage($service))->execute(['system' => 'npm', 'name' => '@colors/colors'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://deps.example.test/v3/systems/NPM/packages/%40colors%2Fcolors');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['versionKey' => ['system' => 'NPM', 'name' => 'react', 'version' => '18.2.0'], 'licenses' => ['MIT']], 200)]);
        self::assertTrue((new DepsDevVersion($service))->execute(['system' => 'NPM', 'name' => 'react', 'version' => '18.2.0'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://deps.example.test/v3/systems/NPM/packages/react/versions/18.2.0');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['npm' => ['dependencies' => ['dependencies' => [['name' => 'loose-envify', 'requirement' => '^1.1.0']]]]], 200)]);
        self::assertTrue((new DepsDevRequirements($service))->execute(['system' => 'NPM', 'name' => 'react', 'version' => '18.2.0'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://deps.example.test/v3/systems/NPM/packages/react/versions/18.2.0:requirements');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['nodes' => [['versionKey' => ['name' => 'react']]], 'edges' => []], 200)]);
        self::assertTrue((new DepsDevDependencies($service))->execute(['system' => 'NPM', 'name' => 'react', 'version' => '18.2.0'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://deps.example.test/v3/systems/NPM/packages/react/versions/18.2.0:dependencies');
    }

    public function test_project_project_package_versions_advisory_and_query_paths_are_mapped(): void
    {
        $service = new DepsDevService(baseUrl: 'https://deps.example.test/v3');

        Http::fake(['*' => Http::response(['projectKey' => ['id' => 'github.com/facebook/react'], 'starsCount' => 1], 200)]);
        self::assertTrue((new DepsDevProject($service))->execute(['id' => 'github.com/facebook/react'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://deps.example.test/v3/projects/github.com%2Ffacebook%2Freact');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['versions' => [['versionKey' => ['system' => 'NPM', 'name' => 'react', 'version' => '18.2.0']]]], 200)]);
        self::assertTrue((new DepsDevProjectPackageVersions($service))->execute(['id' => 'github.com/facebook/react'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://deps.example.test/v3/projects/github.com%2Ffacebook%2Freact:packageversions');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['advisoryKey' => ['id' => 'GHSA-2qrg-x229-3v8q'], 'aliases' => ['CVE-2021-0001']], 200)]);
        self::assertTrue((new DepsDevAdvisory($service))->execute(['id' => 'GHSA-2qrg-x229-3v8q'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://deps.example.test/v3/advisories/GHSA-2qrg-x229-3v8q');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['results' => [['version' => ['versionKey' => ['system' => 'NPM', 'name' => 'react', 'version' => '18.2.0']]]]], 200)]);
        self::assertTrue((new DepsDevQuery($service))->execute(['hash_type' => 'sha1', 'hash_value' => 'abc/=', 'system' => 'npm', 'name' => 'react', 'version' => '18.2.0'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://deps.example.test/v3/query?')
            && str_contains($request->url(), 'hash.type=SHA1')
            && str_contains($request->url(), 'hash.value=abc%2F%3D')
            && str_contains($request->url(), 'versionKey.system=NPM')
            && str_contains($request->url(), 'versionKey.name=react')
            && str_contains($request->url(), 'versionKey.version=18.2.0'));
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new DepsDevService(baseUrl: 'https://deps.example.test/v3');

        $badSystem = (new DepsDevPackage($service))->execute(['system' => 'BAD', 'name' => 'react']);
        self::assertFalse($badSystem->succeeded());
        self::assertStringContainsString('system must be one of', (string) $badSystem->error);

        $missingQuery = (new DepsDevQuery($service))->execute(['system' => 'NPM']);
        self::assertFalse($missingQuery->succeeded());
        self::assertStringContainsString('system, name, and version', (string) $missingQuery->error);

        $badHash = (new DepsDevQuery($service))->execute(['hash_type' => 'SHA1']);
        self::assertFalse($badHash->succeeded());
        self::assertStringContainsString('hash_type and hash_value', (string) $badHash->error);

        Http::fake(['*' => Http::response(['message' => 'not found'], 404)]);
        $apiError = (new DepsDevVersion($service))->execute(['system' => 'NPM', 'name' => 'missing', 'version' => '1.0.0']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('not found', (string) $apiError->error);
    }

    public function test_provider_creates_tools_with_default_service(): void
    {
        Http::fake(['*' => Http::response(['packageKey' => ['system' => 'NPM', 'name' => 'react']], 200)]);

        app()->instance(DepsDevService::class, new DepsDevService(baseUrl: 'https://deps.example.test/v3'));
        $tool = (new DepsDevToolProvider)->createTool(DepsDevPackage::class);
        $result = $tool->execute(['system' => 'NPM', 'name' => 'react']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://deps.example.test/v3/systems/NPM/packages/react');
    }
}
