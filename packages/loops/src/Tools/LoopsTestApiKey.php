<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Test the configured Loops API key.
 *
 * Returns the team name associated with a valid API key.
 */
class LoopsTestApiKey extends AbstractLoopsTool
{
    protected const NAME = 'loops_test_api_key';
    protected const DESCRIPTION = 'Test the configured Loops API key and return the team name.';
    protected const METHOD = 'testApiKey';
    protected const PARAMETERS = [];

    /**
     * Test the key.
     *
     * @param  array<string, mixed>  $args  No arguments are required.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->testApiKey();
    }
}
