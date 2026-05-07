<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Execute a safe relative Drone API GET call. */
class DroneCiApiGet extends AbstractDroneCiTool { protected const NAME = 'drone_ci_api_get'; protected const DESCRIPTION = 'Call a safe relative Drone API GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; protected const REQUIRED = ['path']; protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Drone API path such as /api/user. Full URLs are rejected.'], 'query' => ['type' => 'object', 'description' => 'Query parameters.']]; }
