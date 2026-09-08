<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Catalog;

require_once __DIR__.'/../../catalog/src/CatalogLocator.php';

use OpenCompany\IntegrationCatalog\CatalogLocator;
use PHPUnit\Framework\TestCase;

/**
 * Verifies that the published catalog exposes reviewed Ruby script contracts.
 *
 * The catalog is a public boundary consumed by hosts; this test deliberately
 * compares one package entry with its authored script-doc rather than treating
 * a derived tool name as an executable example.
 */
final class MrubyCatalogTest extends TestCase
{
    public function test_catalog_publishes_authored_ruby_script_docs_without_legacy_lua_fields(): void
    {
        $catalog = CatalogLocator::load();
        $integrations = $catalog['integrations'] ?? [];
        self::assertIsArray($integrations);

        $entra = null;
        foreach ($integrations as $integration) {
            if (($integration['slug'] ?? null) === 'microsoft-entra-id') {
                $entra = $integration;
                break;
            }
        }

        self::assertIsArray($entra);
        self::assertSame('ruby', $entra['script_language']);
        self::assertSame(
            trim((string) file_get_contents(__DIR__.'/../../packages/microsoft-entra-id/script-docs/microsoft-entra-id.md')),
            $entra['script_docs'],
        );
        self::assertStringContainsString('```ruby', $entra['script_docs']);
        self::assertStringContainsString(
            "app.call('integrations.microsoft-entra-id.microsoft_entra_id_users_user_list_user'",
            $entra['script_docs'],
        );
        self::assertTrue($entra['quality']['has_script_docs']);
        self::assertTrue($entra['quality']['has_script_docs_file']);
        self::assertTrue($entra['compatibility']['script_supported']);
        self::assertTrue($entra['seo']['script_supported']);
        self::assertContains('microsoft entra id ruby', $entra['seo']['keywords']);

        self::assertArrayNotHasKey('lua_docs', $entra);
        self::assertArrayNotHasKey('has_lua_docs', $entra['quality']);
        self::assertArrayNotHasKey('lua_supported', $entra['compatibility']);
        self::assertArrayNotHasKey('lua_supported', $entra['seo']);
    }
}
