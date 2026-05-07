<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Execute a safe relative Drone API DELETE call. */
class DroneCiApiDelete extends AbstractDroneCiTool { protected const NAME = 'drone_ci_api_delete'; protected const DESCRIPTION = 'Call a safe relative Drone API DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; protected const REQUIRED = ['path']; protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Drone API path such as /api/repos/acme/web. Full URLs are rejected.'], 'query' => ['type' => 'object', 'description' => 'Query parameters for DELETE endpoints that accept them.']]; }
