<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Registry;

use PHPUnit\Framework\TestCase;

/**
 * Guards generated service providers against importing stale registry namespaces.
 */
final class ServiceProviderRegistryNamespaceTest extends TestCase
{
    public function test_service_providers_use_the_shared_support_registry_namespace(): void
    {
        $badImports = [];

        foreach (glob(__DIR__.'/../../packages/*/src/*ServiceProvider.php') ?: [] as $path) {
            $contents = (string) file_get_contents($path);

            foreach ([
                'use OpenCompany\\IntegrationCore\\ToolProviderRegistry;',
                'use OpenCompany\\IntegrationCore\\Registry\\ToolProviderRegistry;',
            ] as $badImport) {
                if (str_contains($contents, $badImport)) {
                    $badImports[] = str_replace(dirname(__DIR__, 2).'/', '', $path).': '.$badImport;
                }
            }
        }

        self::assertSame([], $badImports);
    }
}
