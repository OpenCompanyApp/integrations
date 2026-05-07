<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Get the authenticated Gumroad user profile.
 */
class GumroadGetCurrentUser extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_get_current_user';

    protected string $toolDescription = 'Get the authenticated Gumroad user profile.';

    protected string $method = 'GET';

    protected string $path = '/user';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
