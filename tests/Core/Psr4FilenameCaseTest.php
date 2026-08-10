<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Core;

use FilesystemIterator;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * Protects package autoloading on case-sensitive production filesystems.
 *
 * macOS commonly hides filename/class capitalization drift. Composer then
 * installs the same package into Linux, where the declared PSR-4 symbol can no
 * longer be resolved. This repository-wide check keeps that deployment-only
 * failure visible on every development platform without loading package code.
 */
final class Psr4FilenameCaseTest extends TestCase
{
    public function test_package_source_filenames_exactly_match_declared_symbols(): void
    {
        $packagesPath = dirname(__DIR__, 2).'/packages';
        $mismatches = [];
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($packagesPath, FilesystemIterator::SKIP_DOTS),
        );

        /** @var SplFileInfo $file */
        foreach ($files as $file) {
            if (! $file->isFile() || $file->getExtension() !== 'php' || ! str_contains($file->getPathname(), '/src/')) {
                continue;
            }

            $symbol = $this->firstDeclaredSymbol($file->getPathname());

            if ($symbol !== null && $file->getBasename('.php') !== $symbol) {
                $relativePath = substr($file->getPathname(), strlen(dirname(__DIR__, 2)) + 1);
                $mismatches[] = sprintf('%s declares %s', $relativePath, $symbol);
            }
        }

        self::assertSame(
            [],
            $mismatches,
            "PSR-4 filenames must use the exact capitalization of their declared symbol:\n".implode("\n", $mismatches),
        );
    }

    /**
     * Returns the first named class-like declaration without executing the file.
     *
     * Anonymous classes are skipped because they do not participate in PSR-4
     * resolution. Files containing only functions or constants return null.
     */
    private function firstDeclaredSymbol(string $path): ?string
    {
        $source = file_get_contents($path);
        self::assertIsString($source, "Unable to read {$path}");

        $tokens = token_get_all($source);
        $tokenCount = count($tokens);

        for ($index = 0; $index < $tokenCount; $index++) {
            $token = $tokens[$index];

            if (! is_array($token) || ! in_array($token[0], [T_CLASS, T_INTERFACE, T_TRAIT, T_ENUM], true)) {
                continue;
            }

            if ($token[0] === T_CLASS && $this->previousMeaningfulToken($tokens, $index) === T_NEW) {
                continue;
            }

            for ($nameIndex = $index + 1; $nameIndex < $tokenCount; $nameIndex++) {
                $nameToken = $tokens[$nameIndex];

                if (is_array($nameToken) && $nameToken[0] === T_STRING) {
                    return $nameToken[1];
                }
            }
        }

        return null;
    }

    /** @param list<array{int, string, int}|string> $tokens */
    private function previousMeaningfulToken(array $tokens, int $index): ?int
    {
        for ($previous = $index - 1; $previous >= 0; $previous--) {
            $token = $tokens[$previous];

            if (is_array($token) && in_array($token[0], [T_WHITESPACE, T_COMMENT, T_DOC_COMMENT], true)) {
                continue;
            }

            return is_array($token) ? $token[0] : null;
        }

        return null;
    }
}
