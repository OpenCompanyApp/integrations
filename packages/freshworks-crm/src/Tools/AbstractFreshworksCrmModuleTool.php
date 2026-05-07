<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Base class for Freshworks CRM module tools that wrap JSON under a root key.
 */
abstract class AbstractFreshworksCrmModuleTool extends AbstractFreshworksCrmEndpointTool
{
    protected string $bodyRoot = '';

    /**
     * Wrap request body in the module root key Freshworks expects.
     *
     * @param  array<string, mixed>  $body  Picked request body.
     * @return array<string, mixed>
     */
    protected function wrapBody(array $body): array
    {
        if ($body === [] || $this->bodyRoot === '') {
            return $body;
        }

        return [$this->bodyRoot => $body];
    }
}
