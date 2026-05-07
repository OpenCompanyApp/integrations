<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Execute a safe relative Drone API PATCH call. */
class DroneCiApiPatch extends AbstractDroneCiTool { protected const NAME = 'drone_ci_api_patch'; protected const DESCRIPTION = 'Call a safe relative Drone API PATCH path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPatch'; protected const REQUIRED = ['path']; protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Drone API path such as /api/repos/acme/web. Full URLs are rejected.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.']]; }
