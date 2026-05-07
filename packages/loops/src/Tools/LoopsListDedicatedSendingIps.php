<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * List dedicated Loops sending IP addresses.
 *
 * This is intended for rare IP allowlisting workflows.
 */
class LoopsListDedicatedSendingIps extends AbstractLoopsTool
{
    protected const NAME = 'loops_list_dedicated_sending_ips';
    protected const DESCRIPTION = 'List dedicated Loops sending IP addresses for rare allowlisting workflows.';
    protected const METHOD = 'listDedicatedSendingIps';
    protected const PARAMETERS = [];

    /**
     * List dedicated sending IPs.
     *
     * @param  array<string, mixed>  $args  No arguments are required.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listDedicatedSendingIps();
    }
}
